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
    public function edit(Quartos $quartos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
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
