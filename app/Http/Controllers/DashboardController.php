<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas;
use App\Models\Quartos;
use App\Models\Estadias;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $isFuncionario = $user->role !== 'client';

        // 1. Reservas Recentes (Lógica comum a ambos)
        $data = [
            'reservasRecentes' => Reservas::with(['hospede'])
                ->when(!$isFuncionario, fn($q) => $q->where('hospede_id', $user->id))
                ->orderBy('data_inicio', 'desc')
                ->take(8)
                ->get(),
        ];

        if ($isFuncionario) {
            // 2. Estatísticas Administrativas
            $data += [
                'reservasHoje'       => Reservas::whereDate('data_inicio', today())->count(),
                'quartosDisponiveis' => Quartos::where('status', 'disponivel')->count(),
                'totalQuartos'       => Quartos::count(),
                'hospedesAtivos'     => Estadias::where('status', 'ativa')->count(),
                'receitaMes'         => Reservas::whereMonth('data_inicio', now()->month)
                                          ->where('status', '!=', 'cancelada')
                                          ->sum('valor_total'),
                'totalClientes'      => User::where('role', 'client')->count(),
                'reservasAbertas'    => Reservas::whereIn('status', ['pendente','confirmada'])->count(),
                'receitaTotal'       => Reservas::where('status', 'concluida')->sum('valor_total'),
                'reservasPorStatus'  => Reservas::selectRaw('status, count(*) as total')
                                          ->groupBy('status')->pluck('total', 'status'),
                'clientesAtivos'     => Reservas::with(['hospede', 'quarto'])
                                          ->where('status', 'ativa')->get(),
            ];
        } else {
            // 3. Estatísticas do Cliente
            // Nota: Verifique se 'hospede_id' existe em Estadias, 
            // caso contrário use whereHas('reserva', fn($q) => $q->where('hospede_id', $user->id))
            $data += [
                'minhasReservas'      => Reservas::where('hospede_id', $user->id)->count(),
                'estadiasConfirmadas' => Estadias::where('hospede_id', $user->id)->where('status', 'ativa')->count(),
                'historicoEstadias'   => Estadias::where('hospede_id', $user->id)->where('status', 'concluida')->count(),
            ];
        }

        return view('dashboard', $data);
    }
}