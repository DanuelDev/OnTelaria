<?php

namespace App\Http\Controllers;

use App\Models\Quartos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class QuartosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quartos = Quartos::all(); // Equivalente -> SELECT * FROM quartos;
        return view('quartos.index', compact('quartos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quartos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $precosPorCategoria = [
            'suite' => 100.00,
            'luxoduplo' => 200.00,
            'luxotriplo' => 300.00,
            'luxocasal' => 50.00,
            'suiteconjugada' => 600.00,
            'apartamentomini' => 1000.00,
        ];

        $precoDiaria = $precosPorCategoria[$request->categoria];

        $quarto = new Quartos();

        $quarto->tipo = $request->categoria;
        $quarto->status = $request->status;
        $quarto->preco_diaria = $precoDiaria;

        $quarto->capacidade = $request->max_adultos + $request->max_criancas;

        $quarto->numero = 'Q-' . rand(100, 999);

        $quarto->save();

        return redirect()->route('quartos.index')->with('success', 'Quarto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $quarto = Quartos::findOrFail($id);
        return view('quartos.show', compact('quarto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $quarto = Quartos::findOrFail($id);
        return view('quartos.edit', compact('quarto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        try{
            $quartos = Quartos::findOrFail($id);
            $quartos->update($request->all());
        } catch(Exception $e){
            Log::error('Erro ao alterar quarto: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString()
            ]);
        }
        return redirect()->route('quartos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Quartos::destroy($id);
        return redirect()->route('quartos.index')->with('success', 'Quarto excluído com sucesso!');
    }
}
