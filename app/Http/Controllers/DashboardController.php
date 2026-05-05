<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $user = auth()->user();
    $isFuncionario = $user->role !== 'client';

    $data = [
        'reservasRecentes' => \App\Models\Reservas::with(['hospede'])
                ->when(!$isFuncionario, fn($q) => $q->where('hospede_id', $user->id))
                ->orderBy('data_inicio', 'desc')
                ->take(8)
                ->get(),
    ];

    if ($isFuncionario) {
        $data += [
            'reservasHoje'       => \App\Models\Reservas::whereDate('data_inicio', today())->count(),
            'quartosDisponiveis' => \App\Models\Quartos::where('status', 'disponivel')->count(),
            'totalQuartos'       => \App\Models\Quartos::count(),
            'hospedesAtivos'     => \App\Models\Estadias::where('status', 'ativa')->count(),
            'receitaMes'         => \App\Models\Reservas::whereMonth('data_inicio', now()->month)->sum('valor_total'),
            'totalClientes'      => \App\Models\Hospede::count(),
            'reservasAbertas'    => \App\Models\Reservas::whereIn('status', ['pendente','confirmada'])->count(),
            'receitaTotal'       => \App\Models\Reservas::where('status', 'concluida')->sum('valor_total'),
            'reservasPorStatus'  => \App\Models\Reservas::selectRaw('status, count(*) as total')
                                    ->groupBy('status')->pluck('total', 'status'),
            'clientesAtivos'     => \App\Models\Reservas::with(['hospede', 'quarto'])
                                    ->where('status', 'ativa')->get(),
        ];
    } else {
        $data += [
            'minhasReservas'      => \App\Models\Reservas::where('hospede_id', $user->id)->count(),
            'estadiasConfirmadas' => \App\Models\Estadias::where('hospede_id', $user->id)->where('status', 'ativa')->count(),
            'historicoEstadias'   => \App\Models\Estadias::where('hospede_id', $user->id)->where('status', 'concluida')->count(),
        ];
    }

    return view('dashboard', $data);
}
}
