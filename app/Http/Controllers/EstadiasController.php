<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Estadias;
use App\Models\Reservas;
use App\Models\Quartos;
use App\Models\Hospede;
use Illuminate\Http\Request;

class EstadiasController extends Controller
{
    public function index(Request $request)
    {
        $query = Estadias::with(['reserva', 'quarto']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $estadias = $query->orderBy('id', 'desc')->get();

        return view('estadias.index', compact('estadias'));
    }

    public function create()
    {
        $reservas = Reservas::orderBy('id', 'desc')->get();
        $quartos  = Quartos::orderBy('numero')->get();

        return view('estadias.create', compact('reservas', 'quartos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reserva_id'    => 'required|exists:reservas,id',
            'quarto_id'     => 'required|exists:quartos,id',
            'data_checkin'  => 'required|date',
            'data_checkout' => 'required|date|after:data_checkin',
            'status'        => 'required|in:ativa,concluida,cancelada',
            'observacoes'   => 'nullable|string|max:1000',
        ], [
            // ... suas mensagens de erro personalizadas ...
        ]);

        $checkin = Carbon::parse($request->data_checkin);
        $checkout = Carbon::parse($request->data_checkout);

        // Calcular a diferença em dias
        $quantidadeDias = $checkin->diffInDays($checkout);
        $quantidadeDias = $quantidadeDias <= 0 ? 1 : $quantidadeDias;

        // Buscar o valor da diária do quarto no banco
        $quarto = Quartos::findOrFail($request->quarto_id);
        $valorTotal = $quantidadeDias * $quarto->preco_diaria;

        // 1. Criar a Estadia (salva como valor_estadia)
        $estadia = Estadias::create([
            'reserva_id'    => $request->reserva_id,
            'quarto_id'     => $request->quarto_id,
            'data_checkin'  => $request->data_checkin,
            'data_checkout' => $request->data_checkout,
            'status'        => $request->status,
            'valor_estadia' => $valorTotal,
            'observacoes'   => $request->observacoes,
        ]);

        // 2. Atualizar a Reserva (salva como valor_total e muda o status)
        // Isso garante que o seu Dashboard leia o valor correto da tabela reservas
        $estadia->reserva()->update([
            'status'      => 'confirmada',
            'valor_total' => $valorTotal 
        ]);

        // 3. Atualizar status do quarto
        $quarto->update([
            'status' => 'indisponivel'
        ]);

        return redirect()->route('estadias.index')
            ->with('success', 'Estadia criada e valor da reserva atualizado com sucesso!');
    }

    public function show(Estadias $estadia)
    {
        $estadia->load(['reserva', 'quarto']);
        return view('estadias.show', compact('estadia'));
    }

    public function edit(Estadias $estadia)
    {
        $reservas = Reservas::orderBy('id', 'desc')->get();
        $quartos  = Quartos::orderBy('numero')->get();

        return view('estadias.edit', compact('estadia', 'reservas', 'quartos'));
    }

    public function update(Request $request, Estadias $estadia)
    {
        $request->validate([
            'reserva_id'    => 'required|exists:reservas,id',
            'quarto_id'     => 'required|exists:quartos,id',
            'data_checkin'  => 'required|date',
            'data_checkout' => 'required|date|after:data_checkin',
            'status' => 'required|in:ativa,concluida,cancelada',
            'valor_estadia' => 'required|numeric|min:0',
            'observacoes'   => 'nullable|string|max:1000',
        ], [
            'data_checkout.after' => 'O check-out deve ser após o check-in.',
            'valor_estadia.min'   => 'O valor não pode ser negativo.',
        ]);

        $estadia->update($request->only([
            'reserva_id', 'quarto_id', 'data_checkin',
            'data_checkout', 'status', 'valor_estadia', 'observacoes',
        ]));

        return redirect()->route('estadias.index')
            ->with('success', 'Estadia atualizada com sucesso!');
    }

    public function destroy(Estadias $estadia)
    {
        $estadia->delete();

        return redirect()->route('estadias.index')
            ->with('success', 'Estadia excluída com sucesso!');
    }

    public function confirmar(Reservas $reserva)
    {
        if ($reserva->estadias()->exists()) {
            return redirect()->route('reservas.index')
                ->with('error', "Já existe uma estadia para a Reserva #{$reserva->id}.");
        }

        if ($reserva->status === 'cancelada') {
            return redirect()->route('reservas.index')
                ->with('error', "Não é possível confirmar uma reserva cancelada.");
        }

        return redirect()->route('estadias.create', [
            'reserva_id'    => $reserva->id,
            'status' => 'ativa',
            'data_checkin'  => $reserva->data_inicio,
            'data_checkout' => $reserva->data_fim,
            'valor_estadia' => $reserva->valor_total,
        ]);
    }

    public function cancelar(Estadias $estadia)
    {
        if ($estadia->status === 'cancelada') {
            return redirect()->route('estadias.index')
                ->with('error', 'Esta estadia já está cancelada.');
        }

        $estadia->update(['status' => 'cancelada']);

        $estadia->reserva()->update(['status' => 'cancelada']);

        $estadia->quarto()->update(['status' => 'disponivel']);


        return redirect()->route('estadias.index')
            ->with('success', 'Estadia cancelada com sucesso.');
    }
}