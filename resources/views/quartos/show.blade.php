@extends('layout')

@section('conteudo')

<div class="container py-5" style="max-width: 900px; margin: 120px auto 60px; padding: 50px 100px;">
    <h2 style="color: var(--escuro); font-weight: 700; font-size: 2.2rem; margin-bottom: 20px;">Detalhes do Quarto #{{ $quarto->numero }}</h2>
    
    <div class="quarto-detalhes-card shadow-sm p-4" style="padding-bottom: 100px">
        <div class="quarto-detalhes-info mb-4">
            <div class="quarto-detalhes-item">
                <span class="label-detalhes">Número do Quarto</span>
                <strong>#{{ $quarto->numero }}</strong>
            </div>
            <div class="quarto-detalhes-item">
                <span class="label-detalhes">Tipo de Quarto</span>
                <span class="badge-tipo">{{ $quarto->tipo }}</span>
            </div>
            <div class="quarto-detalhes-item">
                <span class="label-detalhes">Preço da Diária</span>
                <span class="valor-detalhes">R$ {{ number_format($quarto->preco_diaria, 2, ',', '.') }}</span>
            </div>
        </div>
        <a href="{{ route('quartos.edit', $quarto->id) }}" class="btn-primary" style="padding: 10px; font-size: 1rem; display: inline-block; margin-top: 20px;">
            <i class="bi bi-pencil-square"></i> Editar Quarto
        </a>

        <form action="{{ route('quartos.destroy', $quarto->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn" style="width: 117px; " onclick="return confirm('Tem certeza que deseja excluir?')" title="Excluir">
                <i class="bi bi-trash" style="font-size: 18px;"> Excluir</i>
            </button>
        </form>
    </div>
</div>
@endsection