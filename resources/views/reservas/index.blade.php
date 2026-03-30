@extends('layout')

@section('conteudo')

<div class="container-lista py-5" style="max-width: 1000px; margin: 120px auto 60px; padding: 0 20px;">

    <div class="d-flex justify-content-between align-items-center mb-5">
        <div style="margin-bottom: 20px">
            <h2 style="color: var(--escuro); font-weight: 700; font-size: 2.2rem; margin: 0;">Gerenciar Reservas</h2>
            <p style="color: var(--secundaria); margin: 0;">Painel administrativo de controle de hospedagens</p>
            @if(session('success'))
                <div class="alert alert-success mt-3" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <a href="{{ route('reservas.create') }}" class="btn-primary" style="padding: 0.7rem 1.5rem; font-size: 1rem;">
            <i class="bi bi-plus-lg"></i> Nova Reserva
        </a>
    </div>

    @forelse($reservas as $reserva)
    <div class="reserva-admin-card shadow-sm mb-4">
        <div class="card-body-admin">

            <div class="reserva-info">
                <div class="reserva-id">
                    <span class="label-admin">RESERVA</span>
                    <strong>#{{ $reserva->id }}</strong>
                </div>
                <div class="reserva-hospede">
                    <span class="label-admin">HÓSPEDE</span>
                    <span class="nome-hospede">{{ $reserva->hospede->nome }}</span>
                </div>
                <div>
                    <span class="label-admin">CHECK-IN</span>
                    <span class="valor-data">{{ \Carbon\Carbon::parse($reserva->data_inicio)->format('d/m/Y') }}</span>
                </div>
                <div>
                    <span class="label-admin">CHECK-OUT</span>
                    <span class="valor-data">{{ \Carbon\Carbon::parse($reserva->data_fim)->format('d/m/Y') }}</span>
                </div>
                <div>
                    <span class="label-admin">TOTAL</span>
                    <span class="valor-admin">R$ {{ number_format($reserva->valor_total, 2, ',', '.') }}</span>
                </div>
                <div>
                    <span class="label-admin">STATUS</span>
                    @php
                        $badges = [
                            'confirmada' => ['bg' => '#eaf5ea', 'color' => '#2e7d32', 'border' => '#a5d6a7'],
                            'pendente'   => ['bg' => '#fff8e1', 'color' => '#f57f17', 'border' => '#ffe082'],
                            'cancelada'  => ['bg' => '#fdecea', 'color' => '#c62828', 'border' => '#ef9a9a'],
                            'concluida'  => ['bg' => 'var(--clara)', 'color' => 'var(--secundaria)', 'border' => 'var(--bege)'],
                        ];
                        $b = $badges[$reserva->status] ?? $badges['concluida'];
                    @endphp
                    <span class="badge-status" style="background:{{ $b['bg'] }}; color:{{ $b['color'] }}; border-color:{{ $b['border'] }};">
                        {{ ucfirst($reserva->status) }}
                    </span>
                </div>
            </div>

            <div class="reserva-acoes">
                <form action="{{ route('estadias.confirmar', $reserva->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit"
                            class="btn-admin btn-confirmar"
                            onclick="return confirm('Deseja confirmar a estadia para a Reserva #{{ $reserva->id }}?')"
                            title="Confirmar Estadia"
                            @if($reserva->status === 'cancelada' || $reserva->estadias()->exists()) disabled @endif>
                        <i class="bi bi-house-check"></i> <span>Confirmar</span>
                    </button>
                </form>
 
                <a href="{{ route('reservas.show', $reserva->id) }}" class="btn-admin btn-ver" title="Visualizar">
                    <i class="bi bi-eye"></i> <span>Ver</span>
                </a>
                <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn-admin btn-editar" title="Editar">
                    <i class="bi bi-pencil-square"></i> <span>Editar</span>
                </a>
                <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-admin btn-excluir" style="margin: 0; padding: 8px 10px;"
                            onclick="return confirm('Tem certeza que deseja excluir esta reserva?')" title="Excluir">
                        <i class="bi bi-trash" style="font-size: 22px;"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
@empty
    <div style="text-align:center; padding: 4rem 0; color: var(--secundaria);">
        <i class="bi bi-calendar-x" style="font-size: 3rem; display:block; margin-bottom: 1rem;"></i>
        Nenhuma reserva cadastrada.
    </div>
@endforelse

</div>

<style>
    
</style>

@endsection+