@extends('layout')

@section('titulo', 'Perfil do Cliente')

@section('conteudo')

<div class="container-lista py-5">
    <div class="page-header">
        <div class="page-header-title">
            <h2>Perfil de {{ $cliente->name }}</h2>
            <p>Informações e histórico do cliente.</p>
        </div>
        <div class="page-actions">
            <a href="{{ route('clientes.edit', $cliente) }}" class="btn-admin btn-editar" title="Editar">
                <i class="bi bi-pencil-square"></i> <span>Editar</span>
            </a>
            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" onsubmit="return confirm('Excluir este cliente?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-excluir-show" title="Excluir" style="margin-bottom: 20px;">
                    <i class="bi bi-trash"></i> Excluir
                </button>
            </form>
        </div>
    </div>

    <div class="panel-card panel-group">
        <div class="form-grupo">
            <span class="panel-label">Nome</span>
            <span class="panel-value">{{ $cliente->name }}</span>
        </div>
        <div class="form-grupo">
            <span class="panel-label">Email</span>
            <span class="panel-value">{{ $cliente->email }}</span>
        </div>
        <div class="form-grupo">
            <span class="panel-label">Criado em</span>
            <span class="panel-value">{{ optional($cliente->created_at)->format('d/m/Y H:i') ?? '—' }}</span>
        </div>
        <div class="form-grupo">
            <span class="panel-label">Reservas</span>
            <span class="panel-value">{{ $reservas->count() }}</span>
        </div>
        <div class="form-grupo">
            <span class="panel-label">Estadias Ativas</span>
            <span class="panel-value">{{ $estadiasAtivas }}</span>
        </div>
    </div>

    <div class="panel-card">
        <h3 class="dp-titulo">Reservas do cliente</h3>
        <table class="table-list">
            <thead>
                <tr>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Status</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservas as $reserva)
                @php
                    $badges = [
                        'pendente' => ['Pendente', '#d97706', '#fff8e1'],
                        'confirmada' => ['Confirmada', '#16a34a', '#e8f7ef'],
                        'cancelada' => ['Cancelada', '#dc2626', '#fdecea'],
                        'concluida' => ['Concluída', '#2563eb', '#e8f4ff'],
                    ];
                    [$label, $color, $bg] = $badges[$reserva->status] ?? ['Pendente', '#d97706', '#fff8e1'];
                @endphp
                <tr>
                    <td>{{ optional($reserva->data_inicio ? \Carbon\Carbon::parse($reserva->data_inicio) : null)->format('d/m/Y') }}</td>
                    <td>{{ optional($reserva->data_fim ? \Carbon\Carbon::parse($reserva->data_fim) : null)->format('d/m/Y') }}</td>
                    <td><span class="tb-badge" style="color:{{ $color }}; background:{{ $bg }};">{{ $label }}</span></td>
                    <td>R$ {{ number_format($reserva->valor_total ?? 0, 2, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="dash-vazio">Nenhuma reserva encontrada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
