@extends('layout')

@section('conteudo')
<div class="reserva-container">
    <div class="reserva-header">
        <h1>Cadastrar Novo Quarto</h1>
        <p>Preencha os detalhes abaixo para disponibilizar uma nova acomodação</p>
    </div>

    <div class="reserva-form-wrapper">
        <form action="{{ route('quartos.create') }}" method="POST" enctype="multipart/form-data" class="reserva-form">
            @csrf
            
            <div class="form-section">
                <h2>Informações da Acomodação</h2>
                <div class="dados-grid" style="align-content: center; align-items:center; justify-content:center">
                
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select id="categoria" name="categoria" required>
                            <option value="padrao">Padrão</option>
                            <option value="deluxe">Deluxe</option>
                            <option value="premium">Suíte Premium</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="form-buttons">
                    <button type="submit" class="btn-primary btn-submit">Salvar Novo Quarto</button>
                    <a href="{{ route('quartos.index') }}" class="btn-secondary">Voltar para Listagem</a>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* Reaproveitando seus estilos e adicionando ajustes administrativos */
    @import url('suas-variaveis-de-cor.css'); /* Certifique-se que as variáveis --primaria, etc, estejam acessíveis */

    .reserva-container { max-width: 900px; margin: 50px auto; padding: 2rem 5%; }
    .reserva-form-wrapper { background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); padding: 2.5rem; }
    
    .helper-text { font-size: 0.85rem; color: #888; margin-top: 0.3rem; }
    
    .file-input {
        border: 2px dashed #ddd !important;
        padding: 1.5rem !important;
        text-align: center;
        cursor: pointer;
    }

    .form-section h2 { border-left: 4px solid var(--primaria); padding-left: 15px; border-bottom: none; }

    /* Ajustes nas Grids para modo Edição */
    .dados-grid, .hospedes-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .full-width { grid-column: 1 / -1; }

    input, select, textarea {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .btn-submit {
        background-color: var(--primaria);
        color: white;
        border: none;
        font-weight: bold;
        transition: opacity 0.3s;
    }

    .btn-submit:hover { opacity: 0.9; cursor: pointer; }
</style>

@endsection