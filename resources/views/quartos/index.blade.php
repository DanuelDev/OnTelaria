@extends('layout')

@section('conteudo')

<div class="container-lista py-5" style="max-width: 1000px; margin: 120px auto 60px; padding: 0 20px;">
    
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div style="margin-bottom: 20px">
            <h2 style="color: var(--escuro); font-weight: 700; font-size: 2.2rem; margin: 0;">Gerenciar Quartos</h2>
            <p style="color: var(--secundaria); margin: 0;">Painel administrativo de controle de inventário</p>
            @if(session('success')){
                <div class="alert alert-success mt-3" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                    {{ session('success') }}
                </div>
            }
            @endif
        </div>
        <a href="{{ route('quartos.create') }}" class="btn-primary" style="padding: 0.7rem 1.5rem; font-size: 1rem;">
            <i class="bi bi-plus-lg"></i> Novo Quarto
        </a>
    </div>

    @foreach($quartos as $quarto)
    <div class="quarto-admin-card shadow-sm mb-4">
        <div class="card-body-admin">
            
            <div class="quarto-info">
                <div class="quarto-numero">
                    <span class="label-admin">NÚMERO</span>
                    <strong>#{{ $quarto->numero }}</strong>
                </div>
                <div class="quarto-tipo">
                    <span class="label-admin">CATEGORIA</span>
                    <span class="badge-tipo">{{ $quarto->tipo }}</span>
                </div>
                <div class="quarto-preco-admin">
                    <span class="label-admin">DIÁRIA</span>
                    <span class="valor-admin">R$ {{ number_format($quarto->preco_diaria, 2, ',', '.') }}</span>
                </div>
            </div>

            <div class="quarto-acoes">
                <a href="{{ route('quartos.show', $quarto->id) }}" class="btn-admin btn-ver" title="Visualizar">
                    <i class="bi bi-eye"></i> <span>Ver</span>
                </a>

                <a href="{{ route('quartos.edit', $quarto->id) }}" class="btn-admin btn-editar" title="Editar">
                    <i class="bi bi-pencil-square"></i> <span>Editar</span>
                </a>

                <form action="{{ route('quartos.destroy', $quarto->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-admin btn-excluir" onclick="return confirm('Tem certeza que deseja excluir?')" title="Excluir">
                        <i class="bi bi-trash" style="font-size: 25px;"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
    @endforeach

</div>

<style>
    /* Estilos Adicionais para integrar com seu CSS principal */
    .quarto-admin-card {
        margin: 15px 0;
        background: white;
        border-radius: 12px;
        border: 2px solid var(--primaria);
        transition: transform 0.3s ease;
        overflow: hidden;
    }

    .card-body-admin {
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .quarto-info {
        display: flex;
        gap: 3rem;
        flex-wrap: wrap;
    }

    .label-admin {
        display: block;
        font-size: 0.7rem;
        font-weight: 700;
        color: #999;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .quarto-numero strong {
        font-size: 1.3rem;
        color: var(--escuro);
    }

    .badge-tipo {
        background: var(--clara);
        color: var(--secundaria);
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        border: 1px solid var(--bege);
    }

    .valor-admin {
        color: var(--primaria);
        font-weight: 700;
        font-size: 1.2rem;
    }

    /* Botões de Ação Personalizados */
    .quarto-acoes {
        display: flex;
        gap: 0.8rem;
    }

    .btn-primary {
        background: var(--primaria);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
    }

    .btn-admin {
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        border: 1px solid transparent;
        cursor: pointer;
    }

    .btn-ver {
        background: white;
        color: var(--secundaria);
        border-color: var(--secundaria);
    }

    .btn-ver:hover {
        background: var(--secundaria);
        color: white;
    }

    .btn-editar {
        background: white;
        color: #e67e22; /* Laranja suave para manter harmonia */
        border-color: #e67e22;
    }

    .btn-editar:hover {
        background: #e67e22;
        color: white;
    }

    .btn-excluir {
        background: white;
        color: var(--primaria);
        padding: 8px 8px;
        margin: 0%;
    }

    .btn-excluir:hover {
        color: white;
        font-size: 30px;
    }

    @media (max-width: 768px) {
        .quarto-info { gap: 1.5rem; }
        .quarto-acoes { width: 100%; justify-content: space-between; }
        .btn-admin span { display: none; } /* Esconde o texto no mobile, mantém ícone */
        .btn-admin { padding: 10px 20px; flex: 1; justify-content: center; }
    }
</style>

@endsection