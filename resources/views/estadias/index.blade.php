@extends('layout')

@section('conteudo')

<div style="max-width: 1100px; margin: 120px auto 60px; padding: 0 24px;">

    {{-- Cabeçalho --}}
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <p style="font-size: 0.75rem; font-weight: 700; letter-spacing: 2px; color: var(--secundaria); text-transform: uppercase; margin-bottom: 4px;">Gerenciamento</p>
            <h2 style="font-size: 2.4rem; font-weight: 800; color: var(--escuro); margin: 0; line-height: 1.1;">Estadias</h2>
        </div>
    </div>

    {{-- Alertas --}}
    @if(session('success'))
        <div style="background: #f0fdf4; border: 1.5px solid #86efac; color: #166534; border-radius: 10px; padding: 0.9rem 1.2rem; margin-bottom: 1.5rem; font-size: 0.92rem; display: flex; align-items: center; gap: 8px;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #fef2f2; border: 1.5px solid #fca5a5; color: #991b1b; border-radius: 10px; padding: 0.9rem 1.2rem; margin-bottom: 1.5rem; font-size: 0.92rem; display: flex; align-items: center; gap: 8px;">
            <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
        </div>
    @endif

    {{-- Cards de Resumo --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
        <div style="background: white; border-radius: 12px; padding: 1.2rem 1.4rem; border: 1.5px solid #eee; display: flex; align-items: center; gap: 1rem;">
            <div style="width: 44px; height: 44px; border-radius: 10px; background: #fff4ea; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; color: var(--primaria);">
                <i class="bi bi-house-door"></i>
            </div>
            <div>
                <p style="font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; color: #999; text-transform: uppercase; margin: 0;">Total</p>
                <p style="font-size: 1.8rem; font-weight: 800; color: var(--escuro); margin: 0; line-height: 1;">{{ $estadias->count() }}</p>
            </div>
        </div>
        <div style="background: white; border-radius: 12px; padding: 1.2rem 1.4rem; border: 1.5px solid #eee; display: flex; align-items: center; gap: 1rem;">
            <div style="width: 44px; height: 44px; border-radius: 10px; background: #eff6ff; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; color: #3b82f6;">
                <i class="bi bi-arrow-right-circle"></i>
            </div>
            <div>
                <p style="font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; color: #999; text-transform: uppercase; margin: 0;">Em Andamento</p>
                <p style="font-size: 1.8rem; font-weight: 800; color: var(--escuro); margin: 0; line-height: 1;">{{ $estadias->where('status', 'em_andamento')->count() }}</p>
            </div>
        </div>
        <div style="background: white; border-radius: 12px; padding: 1.2rem 1.4rem; border: 1.5px solid #eee; display: flex; align-items: center; gap: 1rem;">
            <div style="width: 44px; height: 44px; border-radius: 10px; background: #f0fdf4; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; color: #22c55e;">
                <i class="bi bi-check-circle"></i>
            </div>
            <div>
                <p style="font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; color: #999; text-transform: uppercase; margin: 0;">Concluídas</p>
                <p style="font-size: 1.8rem; font-weight: 800; color: var(--escuro); margin: 0; line-height: 1;">{{ $estadias->where('status', 'concluida')->count() }}</p>
            </div>
        </div>
        <div style="background: white; border-radius: 12px; padding: 1.2rem 1.4rem; border: 1.5px solid #eee; display: flex; align-items: center; gap: 1rem;">
            <div style="width: 44px; height: 44px; border-radius: 10px; background: #fef2f2; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; color: var(--primaria);">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div>
                <p style="font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; color: #999; text-transform: uppercase; margin: 0;">Receita Total</p>
                <p style="font-size: 1.4rem; font-weight: 800; color: var(--escuro); margin: 0; line-height: 1;">R$ {{ number_format($estadias->sum('valor_estadia'), 2, ',', '.') }}</p>
            </div>
        </div>
    </div>

    {{-- Tabela --}}
    <div style="background: white; border-radius: 14px; border: 2px solid var(--primaria); overflow: hidden;">

        {{-- Filtro / Busca --}}
        <div style="padding: 1.2rem 1.5rem; border-bottom: 1.5px solid var(--primaria); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
            <p style="font-size: 0.8rem; color: #999; margin: 0;">{{ $estadias->count() }} estadia(s) encontrada(s)</p>
            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                <a href="{{ route('estadias.index') }}" style="font-size: 0.8rem; padding: 0.4rem 0.9rem; border-radius: 20px; text-decoration: none; font-weight: 600; background: var(--primaria); color: white;">Todas</a>
                <a href="{{ route('estadias.index', ['status' => 'em_andamento']) }}" style="font-size: 0.8rem; padding: 0.4rem 0.9rem; border-radius: 20px; text-decoration: none; font-weight: 600; background: #eff6ff; color: #3b82f6;">Em Andamento</a>
                <a href="{{ route('estadias.index', ['status' => 'concluida']) }}" style="font-size: 0.8rem; padding: 0.4rem 0.9rem; border-radius: 20px; text-decoration: none; font-weight: 600; background: #f0fdf4; color: #22c55e;">Concluídas</a>
                <a href="{{ route('estadias.index', ['status' => 'cancelada']) }}" style="font-size: 0.8rem; padding: 0.4rem 0.9rem; border-radius: 20px; text-decoration: none; font-weight: 600; background: #fef2f2; color: #ef4444;">Canceladas</a>
            </div>
        </div>

        @if($estadias->isEmpty())
            <div style="text-align: center; padding: 4rem 2rem; color: #aaa;">
                <i class="bi bi-house-slash" style="font-size: 3rem; display: block; margin-bottom: 1rem;"></i>
                <p style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.3rem; color: #777;">Nenhuma estadia encontrada</p>
                <p style="font-size: 0.9rem;">Crie uma nova estadia para começar.</p>
            </div>
        @else
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #fafafa; border-bottom: 1.5px solid #f0f0f0;">
                            <th style="padding: 0.85rem 1.2rem; text-align: left; font-size: 0.68rem; font-weight: 700; color: #999; letter-spacing: 1px; text-transform: uppercase;">#</th>
                            <th style="padding: 0.85rem 1.2rem; text-align: left; font-size: 0.68rem; font-weight: 700; color: #999; letter-spacing: 1px; text-transform: uppercase;">Reserva</th>
                            <th style="padding: 0.85rem 1.2rem; text-align: left; font-size: 0.68rem; font-weight: 700; color: #999; letter-spacing: 1px; text-transform: uppercase;">Quarto</th>
                            <th style="padding: 0.85rem 1.2rem; text-align: left; font-size: 0.68rem; font-weight: 700; color: #999; letter-spacing: 1px; text-transform: uppercase;">Check-in</th>
                            <th style="padding: 0.85rem 1.2rem; text-align: left; font-size: 0.68rem; font-weight: 700; color: #999; letter-spacing: 1px; text-transform: uppercase;">Check-out</th>
                            <th style="padding: 0.85rem 1.2rem; text-align: left; font-size: 0.68rem; font-weight: 700; color: #999; letter-spacing: 1px; text-transform: uppercase;">Status</th>
                            <th style="padding: 0.85rem 1.2rem; text-align: left; font-size: 0.68rem; font-weight: 700; color: #999; letter-spacing: 1px; text-transform: uppercase;">Valor</th>
                            <th style="padding: 0.85rem 1.2rem; text-align: center; font-size: 0.68rem; font-weight: 700; color: #999; letter-spacing: 1px; text-transform: uppercase;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estadias as $estadia)
                        <tr style="border-bottom: 1px solid #f5f5f5; transition: background 0.15s;" onmouseover="this.style.background='#fafafa'" onmouseout="this.style.background='white'">

                            {{-- ID --}}
                            <td style="padding: 1rem 1.2rem;">
                                <span style="font-size: 0.8rem; font-weight: 700; color: #bbb;">#{{ $estadia->id }}</span>
                            </td>

                            {{-- Reserva --}}
                            <td style="padding: 1rem 1.2rem;">
                                <span style="font-size: 0.9rem; font-weight: 600; color: var(--escuro);">
                                    Reserva #{{ $estadia->reserva_id }}
                                </span>
                            </td>

                            {{-- Quarto --}}
                            <td style="padding: 1rem 1.2rem;">
                                <span style="font-size: 0.9rem; color: #555;">
                                    Quarto #{{ $estadia->quarto_id }}
                                </span>
                            </td>

                            {{-- Check-in --}}
                            <td style="padding: 1rem 1.2rem;">
                                <span style="font-size: 0.88rem; color: #555;">
                                    {{ \Carbon\Carbon::parse($estadia->data_checkin)->format('d/m/Y') }}
                                </span>
                            </td>

                            {{-- Check-out --}}
                            <td style="padding: 1rem 1.2rem;">
                                <span style="font-size: 0.88rem; color: #555;">
                                    {{ \Carbon\Carbon::parse($estadia->data_checkout)->format('d/m/Y') }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td style="padding: 1rem 1.2rem;">
                                @php
                                    $statusConfig = [
                                        'ativa'     => ['bg' => '#eff6ff', 'color' => '#3b82f6', 'label' => 'Ativa'],
                                        'concluida' => ['bg' => '#f0fdf4', 'color' => '#22c55e', 'label' => 'Concluída'],
                                        'cancelada' => ['bg' => '#fef2f2', 'color' => '#ef4444', 'label' => 'Cancelada'],
                                    ];
                                    $cfg = $statusConfig[$estadia->status] ?? ['bg' => '#f5f5f5', 'color' => '#888', 'label' => ucfirst($estadia->status)];
                                @endphp
                                <span style="background: {{ $cfg['bg'] }}; color: {{ $cfg['color'] }}; font-size: 0.75rem; font-weight: 700; padding: 0.3rem 0.75rem; border-radius: 20px; letter-spacing: 0.5px;">
                                    {{ $cfg['label'] }}
                                </span>
                            </td>

                            {{-- Valor --}}
                            <td style="padding: 1rem 1.2rem;">
                                <span style="font-size: 0.95rem; font-weight: 700; color: var(--primaria);">
                                    R$ {{ number_format($estadia->valor_estadia, 2, ',', '.') }}
                                </span>
                            </td>

                            {{-- Ações --}}
                            <td style="padding: 1rem 1.2rem; text-align: center;">
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="{{ route('estadias.show', $estadia->id) }}"
                                       style="width: 32px; height: 32px; border-radius: 8px; background: #f5f5f5; color: #555; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; font-size: 0.9rem; transition: all 0.2s;"
                                       title="Ver detalhes"
                                       onmouseover="this.style.background='var(--secundaria)';this.style.color='white'"
                                       onmouseout="this.style.background='#f5f5f5';this.style.color='#555'">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('estadias.edit', $estadia->id) }}"
                                       style="width: 32px; height: 32px; border-radius: 8px; background: #f5f5f5; color: #555; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; font-size: 0.9rem; transition: all 0.2s;"
                                       title="Editar"
                                       onmouseover="this.style.background='var(--primaria)';this.style.color='white'"
                                       onmouseout="this.style.background='#f5f5f5';this.style.color='#555'">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('estadias.destroy', $estadia->id) }}" method="POST" onsubmit="return confirm('Deseja excluir esta estadia?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                style="width: 32px; height: 32px; border-radius: 8px; background: #f5f5f5; color: #555; border: none; cursor: pointer; font-size: 0.9rem; transition: all 0.2s;"
                                                title="Excluir"
                                                onmouseover="this.style.background='#fef2f2';this.style.color='#ef4444'"
                                                onmouseout="this.style.background='#f5f5f5';this.style.color='#555'">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>

@endsection