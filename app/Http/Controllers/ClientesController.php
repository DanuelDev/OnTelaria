<?php

namespace App\Http\Controllers;

use App\Models\Estadias;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = User::where('role', 'client')->orderBy('name')->get();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'client',
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso!');
    }

    public function show(User $cliente)
    {
        if ($cliente->role !== 'client') {
            abort(404);
        }

        $reservas = $cliente->reservas()->orderBy('data_inicio', 'desc')->get();
        $estadiasAtivas = Estadias::whereIn('reserva_id', $reservas->pluck('id'))
            ->where('status', 'ativa')
            ->count();

        return view('clientes.show', compact('cliente', 'reservas', 'estadiasAtivas'));
    }

    public function edit(User $cliente)
    {
        if ($cliente->role !== 'client') {
            abort(404);
        }

        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, User $cliente)
    {
        if ($cliente->role !== 'client') {
            abort(404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $cliente->id],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        $cliente->name = $validated['name'];
        $cliente->email = $validated['email'];

        if (!empty($validated['password'])) {
            $cliente->password = Hash::make($validated['password']);
        }

        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(User $cliente)
    {
        if ($cliente->role !== 'client') {
            abort(404);
        }

        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }
}
