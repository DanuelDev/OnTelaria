@extends('layout')

@section('conteudo')
<div class="reserva-container">
    <div class="reserva-header">
        <h1>Cadastrar Novo Quarto</h1>
        <p>Preencha os detalhes abaixo para disponibilizar uma nova acomodação</p>
    </div>

    <div class="reserva-form-wrapper">
        <form action="{{ route('quartos.store') }}" method="POST" enctype="multipart/form-data" class="reserva-form">
            @csrf
            
            <div class="form-section">
                <h2>Informações da Acomodação</h2>
                <div class="dados-grid">
                
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select id="categoria" name="categoria" required>
                            <option value="" disabled selected>Selecione..</option>
                            <option value="suite">Suite</option>
                            <option value="luxoduplo">Luxo Duplo</option>
                            <option value="luxotriplo">Luxo Triplo</option>
                            <option value="luxocasal">Luxo Casal</option>
                            <option value="suiteconjugada">Suíte Cojugada</option>
                            <option value="apartamentomini">Apartamento Mini</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2>Capacidade e Estrutura</h2>
                <div class="hospedes-grid">
                    <div class="form-group">
                        <label for="max_adultos">Máximo de Adultos</label>
                        <input type="number" id="max_adultos" name="max_adultos" min="1" value="0" required>
                    </div>
                    <div class="form-group">
                        <label for="max_criancas">Máximo de Crianças</label>
                        <input type="number" id="max_criancas" name="max_criancas" min="0" value="0" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status Inicial</label>
                        <select id="status" name="status">
                            <option value="disponivel">Disponível</option>
                            <option value="manutencao">Em Manutenção</option>
                            <option value="indisponivel">Indisponível</option>
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
    @import url('/public/css/app.css'); /* Certifique-se que as variáveis --primaria, etc, estejam acessíveis */

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Mapeamento das regras por categoria
    const regrasCategorias = {
        'suite': { adultos: 2, criancas: 1 },
        'luxoduplo': { adultos: 2, criancas: 0 },
        'luxotriplo': { adultos: 3, criancas: 0 },
        'luxocasal': { adultos: 2, criancas: 0 },
        'suiteconjugada': { adultos: 4, criancas: 2 },
        'apartamentomini': { adultos: 1, criancas: 0 }
    };

    // 2. Seleção dos elementos
    const selectCategoria = document.getElementById('categoria');
    const inputAdultos = document.getElementById('max_adultos');
    const inputCriancas = document.getElementById('max_criancas');

    // 3. Função que atualiza os campos
    function atualizarCapacidade() {
        const categoriaSelecionada = selectCategoria.value;
        const dados = regrasCategorias[categoriaSelecionada];

        if (dados) {
            inputAdultos.value = dados.adultos;
            inputCriancas.value = dados.criancas;
            
            // Feedback visual opcional: destaca os campos que mudaram
            [inputAdultos, inputCriancas].forEach(el => {
                el.style.backgroundColor = '#fff9c4'; // Amarelo claro
                setTimeout(() => el.style.backgroundColor = '', 500);
            });
        }
    }

    // 4. Escuta a mudança no Select
    selectCategoria.addEventListener('change', atualizarCapacidade);
    
    // Executa uma vez ao carregar caso já venha algo selecionado
    atualizarCapacidade();
});
</script>

@endsection