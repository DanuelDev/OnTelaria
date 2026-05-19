<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ReservasController extends Controller
{
    public function index()
    {
        $reservas = Reservas::with('hospede')->get();
        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        $user = auth()->user();

        if ($user && $user->role === 'client') {
            $users = collect([$user]);
        } else {
            $users = User::where('role', 'client')->orderBy('name')->get();
        }

        return view('reservas.create', compact('users'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if ($user && $user->role === 'client') {
            $hospedeId = $user->id;
            $hospede = $user;
        } else {
            $hospedeId = $request->hospede_id;
            $hospede = User::findOrFail($hospedeId);
        }

        $reserva = new Reservas();
        $reserva->hospede_id    = $hospedeId;
        $reserva->nome_completo = $hospede->name;
        $reserva->data_inicio   = $request->data_inicio;
        $reserva->data_fim      = $request->data_fim;
        $reserva->status        = 'pendente';
        $reserva->observacoes   = $request->observacoes;
        $reserva->save();

        $successMessage = 'Reserva feita com sucesso!';

        if ($user && $user->role === 'client') {
            return redirect()->route('index')->with('success', $successMessage);
        }

        return redirect()->route('reservas.index')->with('success', $successMessage);
    }

    public function show($id)
    {
        $reserva = Reservas::with('hospede')->findOrFail($id);
        return view('reservas.show', compact('reserva'));
    }

    public function edit($id)
    {
        $reserva = Reservas::findOrFail($id);
        $users   = User::where('role', 'client')->orderBy('name')->get();
        return view('reservas.edit', compact('reserva', 'users'));
    }

    public function update(Request $request, $id)
    {
        try {
            $reserva = Reservas::findOrFail($id);
            $user    = User::findOrFail($request->hospede_id);

            $reserva->hospede_id    = $request->hospede_id;
            $reserva->nome_completo = $user->name;
            $reserva->data_inicio   = $request->data_inicio;
            $reserva->data_fim      = $request->data_fim;
            $reserva->status        = $request->status ?? 'confirmada';
            $reserva->valor_total   = $request->valor_total;
            $reserva->observacoes   = $request->observacoes;
            $reserva->save();

        } catch (Exception $e) {
            Log::error('Erro ao atualizar reserva: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString()
            ]);
        }

        return redirect()->route('reservas.index')->with('success', 'Reserva atualizada com sucesso!');
    }

    public function destroy($id)
    {
        Reservas::destroy($id);
        return redirect()->route('reservas.index')->with('success', 'Reserva excluída com sucesso!');
    }
}