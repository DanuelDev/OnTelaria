@extends('layout')

@section('conteudo')

<div style="max-width: 860px; margin: 120px auto 60px; padding: 0 5%;">

    {{-- Breadcrumb / Voltar --}}
    <a href="{{ route('quartos.index') }}" class="btn-voltar" style="display: inline-flex; align-items: center; gap: 6px; margin-bottom: 2rem;">
        <i class="bi bi-arrow-left"></i> Voltar para Quartos
    </a>

    {{-- Cabeçalho --}}
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 2.5rem;">
        <div>
            <p style="font-size: 0.78rem; font-weight: 700; letter-spacing: 1.5px; color: var(--secundaria); text-transform: uppercase; margin-bottom: 4px;">Edição de Quarto</p>
            <h2 style="font-size: 2.4rem; font-weight: 800; color: var(--escuro); line-height: 1.1; margin: 0;">
                Quarto <span style="color: var(--primaria);">#{{ $quarto->numero }}</span>
            </h2>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="form-card">

        <form action="{{ route('quartos.update', $quarto->id) }}" method="POST">
            @csrf
            @method('PUT')

            <p style="font-size: 0.78rem; font-weight: 700; letter-spacing: 1.5px; color: #aaa; text-transform: uppercase; margin-bottom: 1.8rem;">
                Informações do Quarto
            </p>

            <div class="show-linha" style="margin-bottom: 2rem;">
                
                {{-- Número do Quarto --}}
                <div class="show-grupo" style="flex: 1;">
                    <span class="label-admin">Número do Quarto</span>
                    <input type="text" 
                           name="numero" 
                           value="{{ old('numero', $quarto->numero) }}" 
                           class="input-admin" 
                           required>
                </div>

                {{-- Tipo de Quarto --}}
                <div class="show-grupo" style="flex: 1;">
                    <span class="label-admin">Tipo de Quarto</span>
                    <input type="text" 
                           name="tipo" 
                           value="{{ old('tipo', $quarto->tipo) }}" 
                           class="input-admin" 
                           placeholder="Ex: Standard, Luxo, Suíte" 
                           required>
                </div>

            </div>

            <div class="show-linha" style="margin-bottom: 2rem;">

                {{-- Preço da Diária --}}
                <div class="show-grupo" style="flex: 1;">
                    <span class="label-admin">Preço da Diária</span>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--primaria); font-weight: 600;">R$</span>
                        <input type="number" 
                               name="preco_diaria" 
                               value="{{ old('preco_diaria', $quarto->preco_diaria) }}" 
                               step="0.01" 
                               class="input-admin" 
                               style="padding-left: 42px;"
                               required>
                    </div>
                </div>

                {{-- Capacidade --}}
                <div class="show-grupo" style="flex: 1;">
                    <span class="label-admin">Capacidade (pessoas)</span>
                    <input type="number" 
                           name="capacidade" 
                           value="{{ old('capacidade', $quarto->capacidade) }}" 
                           min="1" 
                           class="input-admin" 
                           required>
                </div>

            </div>

            {{-- Status --}}
            <div class="show-grupo" style="margin-bottom: 2rem;">
                <span class="label-admin">Status do Quarto</span>
                <select name="status" class="input-admin" required>
                    <option value="disponivel" {{ old('status', $quarto->status) == 'disponivel' ? 'selected' : '' }}>Disponível</option>
                    <option value="indisponivel" {{ old('status', $quarto->status) == 'indisponivel' ? 'selected' : '' }}>indisponivel</option>
                    <option value="manutencao" {{ old('status', $quarto->status) == 'manutencao' ? 'selected' : '' }}>Em Manutenção</option>
                </select>
            </div>

            {{-- Descrição --}}
            <div class="show-grupo" style="margin-bottom: 2rem;">
                <span class="label-admin">Descrição do Quarto</span>
                <textarea name="descricao" 
                          class="input-admin" 
                          rows="6" 
                          style="resize: vertical; font-size: 1.02rem; line-height: 1.6;"
                          placeholder="Descreva as características do quarto...">{{ old('descricao', $quarto->descricao) }}</textarea>
            </div>

            {{-- Botões de Ação --}}
            <div style="display: flex; gap: 1rem; margin-top: 2.5rem; flex-wrap: wrap;">
                <button type="submit" class="btn-salvar" style="padding: 14px 32px; font-size: 1.05rem;">
                    <i class="bi bi-check-circle"></i> Salvar Alterações
                </button>
                
                <a href="{{ route('quartos.show', $quarto->id) }}" 
                   class="btn-voltar" 
                   style="padding: 14px 28px; font-size: 1.05rem; text-decoration: none;">
                    <i class="bi bi-x-circle"></i> Cancelar
                </a>
            </div>

        </form>

    </div>

</div>

@endsection