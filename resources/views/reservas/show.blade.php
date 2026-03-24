@extends('layout')

@section('conteudo')

<div class="container-lista py-5" style="max-width: 700px; margin: 120px auto 60px; padding: 0 20px;">

    <div style="margin-bottom: 2.5rem;">
        <a href="{{ route('reservas.index') }}" class="btn-voltar">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:1rem; margin-top: 0.5rem;">
            <div>
                <h2 style="color: var(--escuro); font-weight: 700; font-size: 2.2rem; margin: 0;">Reserva <span style="color: var(--primaria);">#{{ $reserva->id }}</span></h2>
                <p style="color: var(--secundaria); margin: 0;">Detalhes completos da hospedagem</p>
            </div>
            <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn-primary" style="padding: 0.6rem 1.3rem; font-size: 0.95rem;">
                <i class="bi bi-pencil-square"></i> Editar
            </a>
        </div>
    </div>

    <div class="form-card">

        {{-- Hóspede destaque --}}
        <div style="display:flex; align-items:center; gap:1rem; padding-bottom:1.5rem; border-bottom: 1px solid var(--bege); margin-bottom:1.5rem;">
            <div style="width:52px; height:52px; border-radius:50%; background:var(--clara); border:2px solid var(--primaria); display:flex; align-items:center; justify-content:center;">
                <i class="bi bi-person" style="font-size:1.4rem; color:var(--primaria);"></i>
            </div>
            <div>
                <span class="label-admin">HÓSPEDE</span>
                <p style="font-size:1.2rem; font-weight:700; color:var(--escuro); margin:0;">{{ $reserva->hospede->nome }}</p>
            </div>
            @php
                $badges = [
                    'confirmada' => ['bg' => '#eaf5ea', 'color' => '#2e7d32', 'border' => '#a5d6a7'],
                    'pendente'   => ['bg' => '#fff8e1', 'color' => '#f57f17', 'border' => '#ffe082'],
                    'cancelada'  => ['bg' => '#fdecea', 'color' => '#c62828', 'border' => '#ef9a9a'],
                    'concluida'  => ['bg' => 'var(--clara)', 'color' => 'var(--secundaria)', 'border' => 'var(--bege)'],
                ];
                $b = $badges[$reserva->status] ?? $badges['concluida'];
            @endphp
            <span class="badge-status ms-auto" style="background:{{ $b['bg'] }}; color:{{ $b['color'] }}; border-color:{{ $b['border'] }}; padding:6px 18px; border-radius:20px; font-weight:600; font-size:0.9rem; border:1px solid;">
                {{ ucfirst($reserva->status) }}
            </span>
        </div>

        {{-- Datas --}}
        <div class="show-linha" style="margin-bottom:1.5rem;">
            <div class="show-grupo">
                <span class="label-admin">CHECK-IN</span>
                <p class="show-valor">
                    <i class="bi bi-calendar-check" style="color:var(--primaria);"></i>
                    {{ \Carbon\Carbon::parse($reserva->data_inicio)->format('d/m/Y') }}
                </p>
            </div>
            <div class="show-seta">
                <i class="bi bi-arrow-right" style="color:var(--secundaria); font-size:1.2rem;"></i>
            </div>
            <div class="show-grupo">
                <span class="label-admin">CHECK-OUT</span>
                <p class="show-valor">
                    <i class="bi bi-calendar-x" style="color:var(--primaria);"></i>
                    {{ \Carbon\Carbon::parse($reserva->data_fim)->format('d/m/Y') }}
                </p>
            </div>
            <div class="show-grupo" style="text-align:center;">
                <span class="label-admin">DURAÇÃO</span>
                <p class="show-valor" style="color:var(--primaria);">
                    {{ \Carbon\Carbon::parse($reserva->data_inicio)->diffInDays($reserva->data_fim) }} noites
                </p>
            </div>
        </div>

        {{-- Valor --}}
        <div style="background:var(--clara); border:1px solid var(--bege); border-radius:10px; padding:1rem 1.5rem; margin-bottom:1.5rem; display:flex; justify-content:space-between; align-items:center;">
            <span class="label-admin" style="margin:0;">VALOR TOTAL DA HOSPEDAGEM</span>
            <span style="font-size:1.6rem; font-weight:700; color:var(--primaria);">
                R$ {{ number_format($reserva->valor_total, 2, ',', '.') }}
            </span>
        </div>

        {{-- Observações --}}
        @if($reserva->observacoes)
        <div>
            <span class="label-admin">OBSERVAÇÕES</span>
            <p style="color:var(--escuro); margin:0.4rem 0 0; line-height:1.6; font-size:0.95rem; background:var(--clara); padding:1rem; border-radius:8px; border-left:3px solid var(--primaria);">
                {{ $reserva->observacoes }}
            </p>
        </div>
        @endif

    </div>

    {{-- Ações de rodapé --}}
    <div class="form-acoes" style="margin-top:1.5rem;">
        <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST"
              onsubmit="return confirm('Tem certeza que deseja excluir esta reserva?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-excluir-show">
                <i class="bi bi-trash"></i> Excluir Reserva
            </button>
        </form>
        <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn-salvar">
            <i class="bi bi-pencil-square"></i> Editar Reserva
        </a>
    </div>

</div>

@endsection