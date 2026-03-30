<?php

namespace App\Http\Controllers;

use App\Models\Estadias;
use App\Models\Reservas;
use App\Models\Quartos;
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
            'status' => 'required|in:ativa,concluida,cancelada',
            'valor_estadia' => 'required|numeric|min:0',
            'observacoes'   => 'nullable|string|max:1000',
        ], [
            'reserva_id.required'    => 'Selecione uma reserva.',
            'reserva_id.exists'      => 'Reserva inválida.',
            'quarto_id.required'     => 'Selecione um quarto.',
            'quarto_id.exists'       => 'Quarto inválido.',
            'data_checkin.required'  => 'Informe a data de check-in.',
            'data_checkin.date'      => 'Data de check-in inválida.',
            'data_checkout.required' => 'Informe a data de check-out.',
            'data_checkout.date'     => 'Data de check-out inválida.',
            'data_checkout.after'    => 'O check-out deve ser após o check-in.',
            'status.required'        => 'Selecione o status.',
            'status.in'              => 'Status inválido.',
            'valor_estadia.required' => 'Informe o valor da estadia.',
            'valor_estadia.numeric'  => 'O valor deve ser numérico.',
            'valor_estadia.min'      => 'O valor não pode ser negativo.',
        ]);

        Estadias::create($request->only([
            'reserva_id', 'quarto_id', 'data_checkin',
            'data_checkout', 'status', 'valor_estadia', 'observacoes',
        ]));

        return redirect()->route('estadias.index')
            ->with('success', 'Estadia criada com sucesso!');
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
            'status'        => 'required|in:em_andamento,concluida,cancelada,pendente',
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
}