@extends('layout')

@section('conteudo')

<div style="max-width: 860px; margin: 120px auto 60px; padding: 0 5%;">

    {{-- Breadcrumb / Voltar --}}
    <a href="{{ route('quartos.index') }}" class="btn-voltar" style="display: inline-flex; align-items: center; gap: 6px; margin-bottom: 2rem;">
        <i class="bi bi-arrow-left"></i> Voltar para Quartos
    </a>

    {{-- Cabeçalho da página --}}
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem;">
        <div>
            <p style="font-size: 0.78rem; font-weight: 700; letter-spacing: 1.5px; color: var(--secundaria); text-transform: uppercase; margin-bottom: 4px;">Detalhes do Quarto</p>
            <h2 style="font-size: 2.4rem; font-weight: 800; color: var(--escuro); line-height: 1.1; margin: 0;">
                Quarto <span style="color: var(--primaria);">#{{ $quarto->numero }}</span>
            </h2>
        </div>

        {{-- Ações --}}
        <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
            <a href="{{ route('quartos.edit', $quarto->id) }}" class="btn-salvar">
                <i class="bi bi-pencil-square"></i> Editar Quarto
            </a>

            <form action="{{ route('quartos.destroy', $quarto->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-excluir-show" onclick="return confirm('Tem certeza que deseja excluir este quarto?')">
                    <i class="bi bi-trash"></i> Excluir
                </button>
            </form>
        </div>
    </div>

    {{-- Cards de Status - Agora no topo --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.2rem; margin-bottom: 2rem;">

        <div style="background: white; border-radius: 12px; padding: 1.4rem 1.6rem; border: 1.5px solid var(--bege); display: flex; align-items: center; gap: 1rem;">
            <div style="width: 44px; height: 44px; background: rgba(191,70,70,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="bi bi-hash" style="color: var(--primaria); font-size: 1.3rem;"></i>
            </div>
            <div>
                <p style="font-size: 0.72rem; font-weight: 700; letter-spacing: 1px; color: #aaa; text-transform: uppercase; margin: 0 0 2px;">Número</p>
                <p style="font-size: 1.3rem; font-weight: 800; color: var(--escuro); margin: 0;">#{{ $quarto->numero }}</p>
            </div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 1.4rem 1.6rem; border: 1.5px solid var(--bege); display: flex; align-items: center; gap: 1rem;">
            <div style="width: 44px; height: 44px; background: rgba(126,172,181,0.12); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="bi bi-door-open" style="color: var(--secundaria); font-size: 1.3rem;"></i>
            </div>
            <div>
                <p style="font-size: 0.72rem; font-weight: 700; letter-spacing: 1px; color: #aaa; text-transform: uppercase; margin: 0 0 2px;">Tipo</p>
                <p style="font-size: 1.1rem; font-weight: 700; color: var(--escuro); margin: 0;">{{ $quarto->tipo }}</p>
            </div>
        </div>

        <div style="background: var(--primaria); border-radius: 12px; padding: 1.4rem 1.6rem; display: flex; align-items: center; gap: 1rem;">
            <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.18); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="bi bi-cash-coin" style="color: white; font-size: 1.3rem;"></i>
            </div>
            <div>
                <p style="font-size: 0.72rem; font-weight: 700; letter-spacing: 1px; color: rgba(255,255,255,0.7); text-transform: uppercase; margin: 0 0 2px;">Diária</p>
                <p style="font-size: 1.3rem; font-weight: 800; color: white; margin: 0;">R$ {{ number_format($quarto->preco_diaria, 2, ',', '.') }}</p>
            </div>
        </div>

    </div>

    {{-- Card de Informações - Agora mostra apenas a descrição --}}
    <div class="form-card">
        <p style="font-size: 0.78rem; font-weight: 700; letter-spacing: 1.5px; color: #aaa; text-transform: uppercase; margin-bottom: 1.5rem;">Descrição do Quarto</p>
        
        <div style="padding: 1rem 0;">
            <p style="font-size: 1.05rem; line-height: 1.7; color: var(--escuro);">
                {{ $quarto->descricao ?? 'Nenhuma descrição cadastrada para este quarto.' }}
            </p>
        </div>
    </div>

</div>

@endsection