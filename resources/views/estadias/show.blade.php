@extends('layout')

@section('conteudo')

<div style="max-width: 760px; margin: 120px auto 60px; padding: 0 24px;">

    {{-- Cabeçalho --}}
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('estadias.index') }}" style="font-size: 0.78rem; font-weight: 700; color: #aaa; text-decoration: none; letter-spacing: 1px; text-transform: uppercase; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 1rem;">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <p style="font-size: 0.75rem; font-weight: 700; letter-spacing: 2px; color: var(--secundaria); text-transform: uppercase; margin-bottom: 4px;">Gerenciamento</p>
        <h2 style="font-size: 2.4rem; font-weight: 800; color: var(--escuro); margin: 0; line-height: 1.1;">
            Estadia <span style="color: #bbb; font-size: 1.6rem;">#{{ $estadia->id }}</span>
        </h2>
    </div>

    {{-- Alertas --}}
    @if(session('success'))
        <div style="background: #f0fdf4; border: 1.5px solid #86efac; color: #166534; border-radius: 10px; padding: 0.9rem 1.2rem; margin-bottom: 1.5rem; font-size: 0.92rem; display: flex; align-items: center; gap: 8px;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Status badge grande --}}
    @php
        $statusConfig = [
            'em_andamento' => ['bg' => '#eff6ff', 'color' => '#3b82f6', 'label' => 'Em Andamento',  'icon' => 'arrow-right-circle'],
            'concluida'    => ['bg' => '#f0fdf4', 'color' => '#22c55e', 'label' => 'Concluída',      'icon' => 'check-circle'],
            'cancelada'    => ['bg' => '#fef2f2', 'color' => '#ef4444', 'label' => 'Cancelada',      'icon' => 'x-circle'],
            'pendente'     => ['bg' => '#fffbeb', 'color' => '#f59e0b', 'label' => 'Pendente',       'icon' => 'clock'],
        ];
        $cfg = $statusConfig[$estadia->status] ?? ['bg' => '#f5f5f5', 'color' => '#888', 'label' => ucfirst($estadia->status), 'icon' => 'circle'];

        $dias = \Carbon\Carbon::parse($estadia->data_checkin)->diffInDays(\Carbon\Carbon::parse($estadia->data_checkout));
    @endphp

    {{-- Cards rápidos --}}
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
        <div style="background: white; border-radius: 12px; padding: 1.2rem 1.4rem; border: 1.5px solid #eee; text-align: center;">
            <p style="font-size: 0.68rem; font-weight: 700; letter-spacing: 1px; color: #999; text-transform: uppercase; margin: 0 0 4px;">Duração</p>
            <p style="font-size: 1.8rem; font-weight: 800; color: var(--escuro); margin: 0; line-height: 1;">{{ $dias }}</p>
            <p style="font-size: 0.75rem; color: #aaa; margin: 2px 0 0;">{{ $dias == 1 ? 'dia' : 'dias' }}</p>
        </div>
        <div style="background: white; border-radius: 12px; padding: 1.2rem 1.4rem; border: 1.5px solid #eee; text-align: center;">
            <p style="font-size: 0.68rem; font-weight: 700; letter-spacing: 1px; color: #999; text-transform: uppercase; margin: 0 0 4px;">Valor Total</p>
            <p style="font-size: 1.4rem; font-weight: 800; color: var(--primaria); margin: 0; line-height: 1;">R$ {{ number_format($estadia->valor_estadia, 2, ',', '.') }}</p>
        </div>
        <div style="background: {{ $cfg['bg'] }}; border-radius: 12px; padding: 1.2rem 1.4rem; border: 1.5px solid #eee; text-align: center;">
            <p style="font-size: 0.68rem; font-weight: 700; letter-spacing: 1px; color: #999; text-transform: uppercase; margin: 0 0 4px;">Status</p>
            <p style="font-size: 1rem; font-weight: 800; color: {{ $cfg['color'] }}; margin: 0; line-height: 1; display: flex; align-items: center; justify-content: center; gap: 6px;">
                <i class="bi bi-{{ $cfg['icon'] }}"></i> {{ $cfg['label'] }}
            </p>
        </div>
    </div>

    {{-- Detalhes --}}
    <div style="background: white; border-radius: 14px; border: 2px solid var(--primaria); overflow: hidden; margin-bottom: 1.5rem;">

        <div style="padding: 1.2rem 1.5rem; border-bottom: 1.5px solid var(--primaria); background: #fafafa;">
            <p style="font-size: 0.78rem; font-weight: 700; color: #999; letter-spacing: 1px; text-transform: uppercase; margin: 0;">Detalhes da Estadia</p>
        </div>

        <div style="padding: 1.5rem;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.4rem;">

                <div>
                    <p style="font-size: 0.68rem; font-weight: 700; color: #bbb; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 4px;">Reserva</p>
                    <p style="font-size: 1rem; font-weight: 700; color: var(--escuro); margin: 0;">
                        <a href="{{ route('reservas.show', $estadia->reserva_id) }}" style="color: var(--secundaria); text-decoration: none;">
                            Reserva #{{ $estadia->reserva_id }}
                        </a>
                    </p>
                </div>

                <div>
                    <p style="font-size: 0.68rem; font-weight: 700; color: #bbb; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 4px;">Quarto</p>
                    <p style="font-size: 1rem; font-weight: 700; color: var(--escuro); margin: 0;">
                        Quarto #{{ $estadia->quarto_id }}
                        @if($estadia->quarto && $estadia->quarto->tipo)
                            <span style="font-size: 0.82rem; color: #999; font-weight: 500;">— {{ $estadia->quarto->tipo }}</span>
                        @endif
                    </p>
                </div>

                <div>
                    <p style="font-size: 0.68rem; font-weight: 700; color: #bbb; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 4px;">Check-in</p>
                    <p style="font-size: 1rem; font-weight: 600; color: var(--escuro); margin: 0;">
                        {{ \Carbon\Carbon::parse($estadia->data_checkin)->format('d/m/Y') }}
                    </p>
                </div>

                <div>
                    <p style="font-size: 0.68rem; font-weight: 700; color: #bbb; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 4px;">Check-out</p>
                    <p style="font-size: 1rem; font-weight: 600; color: var(--escuro); margin: 0;">
                        {{ \Carbon\Carbon::parse($estadia->data_checkout)->format('d/m/Y') }}
                    </p>
                </div>

                @if($estadia->observacoes)
                <div style="grid-column: 1 / -1;">
                    <p style="font-size: 0.68rem; font-weight: 700; color: #bbb; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 6px;">Observações</p>
                    <p style="font-size: 0.92rem; color: #555; margin: 0; background: #fafafa; border-radius: 8px; padding: 0.75rem 1rem; border: 1px solid #f0f0f0; line-height: 1.6;">
                        {{ $estadia->observacoes }}
                    </p>
                </div>
                @endif

            </div>
        </div>
    </div>

    {{-- Ações --}}
    <div style="display: flex; gap: 0.8rem; justify-content: flex-end;">
        <a href="{{ route('estadias.edit', $estadia->id) }}"
           style="padding: 0.65rem 1.4rem; border-radius: 9px; background: var(--primaria); color: white; font-size: 0.88rem; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <form action="{{ route('estadias.destroy', $estadia->id) }}" method="POST" onsubmit="return confirm('Deseja excluir esta estadia?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    style="padding: 0.65rem 1.4rem; border-radius: 9px; background: #fef2f2; color: #ef4444; font-size: 0.88rem; font-weight: 700; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                <i class="bi bi-trash"></i> Excluir
            </button>
        </form>
    </div>

</div>
@endsection