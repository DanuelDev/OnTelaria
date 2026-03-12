@extends('layout')

@section('conteudo')
<div class="reserva-container">
    <div class="reserva-header">
        <h1>Fazer Reserva</h1>
        <p>Escolha seu quarto e defina as datas da sua estadia</p>
    </div>

    <div class="reserva-form-wrapper">
        <form action="#" method="POST" class="reserva-form">
            @csrf
            
            <!-- Seleção de Quarto -->
            <div class="form-section">
                <h2>Selecione seu Quarto</h2>
                <div class="quartos-grid">
                    <label class="quarto-card">
                        <input type="radio" name="quarto_id" value="1" required class="card-radio">
                        <div class="quarto-imagem" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                        <div class="quarto-info">
                            <h3>Quarto Padrão</h3>
                            <p class="quarto-desc">Confortável e espaçoso</p>
                            <p class="quarto-preco">R$ 150,00 <span>/noite</span></p>
                            <div class="radio-option">
                                <span class="radio-custom"></span>
                                Selecionar
                            </div>
                        </div>
                    </label>

                    <label class="quarto-card">
                        <input type="radio" name="quarto_id" value="2" required class="card-radio">
                        <div class="quarto-imagem" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);"></div>
                        <div class="quarto-info">
                            <h3>Quarto Deluxe</h3>
                            <p class="quarto-desc">Luxuoso com vista panorâmica</p>
                            <p class="quarto-preco">R$ 250,00 <span>/noite</span></p>
                            <div class="radio-option">
                                <span class="radio-custom"></span>
                                Selecionar
                            </div>
                        </div>
                    </label>

                    <label class="quarto-card">
                        <input type="radio" name="quarto_id" value="3" required class="card-radio">
                        <div class="quarto-imagem" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);"></div>
                        <div class="quarto-info">
                            <h3>Suite Premium</h3>
                            <p class="quarto-desc">Máximo conforto e privacidade</p>
                            <p class="quarto-preco">R$ 400,00 <span>/noite</span></p>
                            <div class="radio-option">
                                <span class="radio-custom"></span>
                                Selecionar
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Datas da Reserva -->
            <div class="form-section">
                <h2>Datas da Estadia</h2>
                <div class="datas-grid">
                    <div class="form-group">
                        <label for="checkin">Data de Check-in</label>
                        <input 
                            type="date" 
                            id="checkin" 
                            name="data_checkin" 
                            required
                            min="{{ date('Y-m-d') }}"
                        >
                    </div>
                    <div class="form-group">
                        <label for="checkout">Data de Check-out</label>
                        <input 
                            type="date" 
                            id="checkout" 
                            name="data_checkout" 
                            required
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                        >
                    </div>
                </div>
            </div>

            <!-- Hóspedes -->
            <div class="form-section">
                <h2>Hóspedes</h2>
                <div class="hospedes-grid">
                    <div class="form-group">
                        <label for="adultos">Adultos</label>
                        <select id="adultos" name="adultos" required>
                            <option value="">Selecione...</option>
                            <option value="1">1 Adulto</option>
                            <option value="2">2 Adultos</option>
                            <option value="3">3 Adultos</option>
                            <option value="4">4 Adultos</option>
                            <option value="5">5+ Adultos</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="criancas">Crianças</label>
                        <select id="criancas" name="criancas" required>
                            <option value="">Selecione...</option>
                            <option value="0">Nenhuma</option>
                            <option value="1">1 Criança</option>
                            <option value="2">2 Crianças</option>
                            <option value="3">3+ Crianças</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Informações do Hóspede -->
            <div class="form-section">
                <h2>Seus Dados</h2>
                <div class="dados-grid">
                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input 
                            type="text" 
                            id="nome" 
                            name="nome_hospede" 
                            placeholder="João da Silva"
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="seu@email.com"
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input 
                            type="tel" 
                            id="telefone" 
                            name="telefone" 
                            placeholder="(11) 99999-9999"
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label for="documento">CPF/Passport</label>
                        <input 
                            type="text" 
                            id="documento" 
                            name="documento" 
                            placeholder="000.000.000-00"
                            required
                        >
                    </div>
                </div>
            </div>

            <!-- Observações -->
            <div class="form-section">
                <h2>Observações Adicionais</h2>
                <div class="form-group full-width">
                    <label for="observacoes">Deixe suas observações (opcional)</label>
                    <textarea 
                        id="observacoes" 
                        name="observacoes" 
                        rows="4" 
                        placeholder="Cama extra, disposição da sala, preferências, etc..."
                    ></textarea>
                </div>
            </div>

            <!-- Resumo e Confirmação -->
            <div class="form-section resumo-section">
                <h2>Resumo da Reserva</h2>
                <div class="resumo-info">
                    <div class="resumo-item">
                        <span>Quarto:</span>
                        <strong id="resumo-quarto">Selecione um quarto</strong>
                    </div>
                    <div class="resumo-item">
                        <span>Período:</span>
                        <strong id="resumo-periodo">Selecione as datas</strong>
                    </div>
                    <div class="resumo-item">
                        <span>Noites:</span>
                        <strong id="resumo-noites">0</strong>
                    </div>
                    <div class="resumo-item resumo-total">
                        <span>Total:</span>
                        <strong id="resumo-total">R$ 0,00</strong>
                    </div>
                </div>
            </div>

            <!-- Termos e Botões -->
            <div class="form-section">
                <label class="checkbox-option">
                    <input type="checkbox" name="aceita_termos" required>
                    <span>Aceito os termos e condições de reserva</span>
                </label>
                
                <div class="form-buttons">
                    <button type="submit" class="btn-primary btn-submit">Confirmar Reserva</button>
                    <a href="/index" class="btn-secondary">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* =============================================
       Estilos específicos da página de reserva
       ============================================= */

    .reserva-container {
        max-width: 1000px;
        margin: 100px auto;
        padding: 2rem 5%;
        min-height: 100vh;
    }

    .reserva-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .reserva-header h1 {
        font-size: 2.5rem;
        color: var(--primaria);
        margin-bottom: 0.5rem;
    }

    .reserva-header p {
        font-size: 1.1rem;
        color: var(--cinza);
    }

    .reserva-form-wrapper {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        padding: 2rem;
    }

    .form-section {
        margin-bottom: 2.5rem;
    }

    .form-section h2 {
        font-size: 1.3rem;
        color: var(--primaria);
        margin-bottom: 1.5rem;
        padding-bottom: 0.8rem;
        border-bottom: 2px solid var(--bege);
    }

    /* Grid de Quartos */
    .quartos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .quarto-card {
        border: 2px solid #eee;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative; /* allows absolute radio overlay */
    }

    .quarto-card:hover {
        border-color: var(--primaria);
        box-shadow: 0 4px 12px rgba(191, 70, 70, 0.15);
    }

    .quarto-card input[type="radio"]:checked + .quarto-info {
        background: rgba(191, 70, 70, 0.05);
        border-top: 3px solid var(--primaria);
    }

    /* when using card-radio overlay structure */
    .quarto-card .card-radio:checked ~ .quarto-info {
        background: rgba(191, 70, 70, 0.05);
        border-top: 3px solid var(--primaria);
    }

    .quarto-imagem {
        width: 100%;
        height: 180px;
        background-size: cover;
    }

    .quarto-info {
        padding: 1.2rem;
    }

    .quarto-info h3 {
        font-size: 1.2rem;
        margin-bottom: 0.3rem;
        color: var(--escuro);
    }

    .quarto-desc {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 0.8rem;
    }

    .quarto-preco {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primaria);
        margin-bottom: 1rem;
    }

    .quarto-preco span {
        font-size: 0.9rem;
        font-weight: 400;
        color: #666;
    }

    .radio-option {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        cursor: pointer;
        font-weight: 600;
        color: var(--primaria);
        
    }

    .radio-option input[type="radio"] {
        appearance: none;
        width: 16px;
        height: 16px;
        border: 2px solid var(--primaria);
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.2s;
    }

    .radio-option input[type="radio"]:checked {
        background: var(--primaria);
        box-shadow: inset 0 0 0 3px white;
    }

    .card-radio {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 2;
    }

    .radio-option .radio-custom {
        width: 14px;
        height: 14px;
        display: inline-block;
        border: 2px solid var(--primaria);
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 0.5rem;
        transition: background 0.2s;
    }

    /* fill bullet when corresponding card radio is selected */
    .quarto-card .card-radio:checked ~ .quarto-info .radio-custom {
        background: var(--primaria);
    }

    /* Datas */
    .datas-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .hospedes-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .dados-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--escuro);
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="tel"],
    .form-group input[type="date"],
    .form-group select,
    .form-group textarea {
        padding: 0.8rem 1rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-family: inherit;
        font-size: 1rem;
        transition: all 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primaria);
        box-shadow: 0 0 0 3px rgba(191, 70, 70, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        font-family: inherit;
    }

    /* Resumo */
    .resumo-section {
        background: linear-gradient(135deg, rgba(191, 70, 70, 0.05) 0%, rgba(126, 172, 181, 0.05) 100%);
        padding: 1.5rem;
        border-radius: 8px;
        border-left: 4px solid var(--primaria);
    }

    .resumo-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .resumo-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.8rem 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .resumo-item:last-child {
        border-bottom: none;
    }

    .resumo-item span {
        color: #666;
        font-weight: 500;
    }

    .resumo-item strong {
        color: var(--escuro);
        font-size: 1.1rem;
    }

    .resumo-item.resumo-total {
        grid-column: 1 / -1;
        font-size: 1.3rem;
        padding: 1rem 0;
        border-top: 2px solid rgba(0, 0, 0, 0.1);
        border-bottom: none;
    }

    .resumo-item.resumo-total strong {
        color: var(--primaria);
        font-size: 1.5rem;
    }

    /* Termos, Botões */
    .checkbox-option {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1.5rem;
        cursor: pointer;
        font-weight: 500;
    }

    .checkbox-option input[type="checkbox"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
        accent-color: var(--primaria);
    }

    .form-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 2rem;
    }

    .btn-submit {
        flex: 1;
        max-width: 300px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
    }

    .btn-secondary {
        flex: 1;
        max-width: 300px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        background: #eee;
        color: var(--escuro);
        border-radius: 6px;
        text-decoration: none;
        text-align: center;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-secondary:hover {
        background: #ddd;
    }

    /* Responsivo */
    @media (max-width: 768px) {
        .reserva-container {
            margin-top: 80px;
        }

        .reserva-header h1 {
            font-size: 1.8rem;
        }

        .reserva-form-wrapper {
            padding: 1.5rem;
        }

        .quartos-grid {
            grid-template-columns: 1fr;
        }

        .datas-grid,
        .hospedes-grid {
            grid-template-columns: 1fr;
        }

        .dados-grid {
            grid-template-columns: 1fr;
        }

        .resumo-info {
            grid-template-columns: 1fr;
        }

        .form-buttons {
            flex-direction: column;
        }

        .btn-secondary,
        .btn-submit {
            max-width: none;
        }
    }
</style>

<script>
    // Atualizar resumo em tempo real
    const precos = {
        1: 150,
        2: 250,
        3: 400
    };

    const nomes = {
        1: 'Quarto Padrão',
        2: 'Quarto Deluxe',
        3: 'Suite Premium'
    };

    function atualizarResumo() {
        const quartoId = document.querySelector('input[name="quarto_id"]:checked')?.value;
        const dataCheckin = document.getElementById('checkin').value;
        const dataCheckout = document.getElementById('checkout').value;

        // Atualizar quarto
        if (quartoId) {
            document.getElementById('resumo-quarto').textContent = nomes[quartoId];
        }

        // Atualizar período e calcular noites
        if (dataCheckin && dataCheckout) {
            const inicio = new Date(dataCheckin);
            const fim = new Date(dataCheckout);
            const noites = Math.floor((fim - inicio) / (1000 * 60 * 60 * 24));

            if (noites > 0) {
                const dataInicio = inicio.toLocaleDateString('pt-BR');
                const dataFim = fim.toLocaleDateString('pt-BR');
                document.getElementById('resumo-periodo').textContent = `${dataInicio} até ${dataFim}`;
                document.getElementById('resumo-noites').textContent = noites;

                // Calcular total
                if (quartoId) {
                    const total = precos[quartoId] * noites;
                    document.getElementById('resumo-total').textContent = 
                        `R$ ${total.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}`;
                }
            }
        }
    }

    // Event listeners
    document.querySelectorAll('input[name="quarto_id"]').forEach(radio => {
        radio.addEventListener('change', atualizarResumo);
    });

    document.getElementById('checkin').addEventListener('change', atualizarResumo);
    document.getElementById('checkout').addEventListener('change', atualizarResumo);

    // Inicializar resumo
    atualizarResumo();
</script>

@endsection