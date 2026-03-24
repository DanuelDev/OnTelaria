<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use App\Models\Hospede;
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
        $hospedes = Hospede::orderBy('nome')->get();
        return view('reservas.create', compact('hospedes'));
    }

    public function store(Request $request)
{
    $reserva = new Reservas();

    $reserva->hospede_id  = $request->hospede_id;
    $reserva->data_inicio = $request->data_inicio;
    $reserva->data_fim    = $request->data_fim;
    $reserva->status      = $request->status;
    $reserva->valor_total = $request->valor_total;
    $reserva->observacoes = $request->observacoes;

    $reserva->save();

    return redirect()->route('reservas.index')->with('success', 'Reserva criada com sucesso!');
}

    public function show($id)
    {
        $reserva = Reservas::with('hospede')->findOrFail($id);
        return view('reservas.show', compact('reserva'));
    }

    public function edit($id)
    {
        $reserva  = Reservas::findOrFail($id);
        $hospedes = Hospede::orderBy('nome')->get();
        return view('reservas.edit', compact('reserva', 'hospedes'));
    }

    public function update(Request $request, $id)
    {
        try {
            $reserva = Reservas::findOrFail($id);

            $reserva->hospede_id  = $request->hospede_id;
            $reserva->data_inicio = $request->data_inicio;
            $reserva->data_fim    = $request->data_fim;
            $reserva->status      = $request->status;
            $reserva->valor_total = $request->valor_total;
            $reserva->observacoes = $request->observacoes;

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