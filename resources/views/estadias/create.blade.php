@extends('layout')

@section('conteudo')

<div style="max-width: 760px; margin: 120px auto 60px; padding: 0 24px;">

    {{-- Cabeçalho --}}
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('estadias.index') }}" style="font-size: 0.78rem; font-weight: 700; color: #aaa; text-decoration: none; letter-spacing: 1px; text-transform: uppercase; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 1rem;">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <p style="font-size: 0.75rem; font-weight: 700; letter-spacing: 2px; color: var(--secundaria); text-transform: uppercase; margin-bottom: 4px;">Gerenciamento</p>
        <h2 style="font-size: 2.4rem; font-weight: 800; color: var(--escuro); margin: 0; line-height: 1.1;">Nova Estadia</h2>
    </div>

    {{-- Erros de validação --}}
    @if($errors->any())
        <div style="background: #fef2f2; border: 1.5px solid #fca5a5; color: #991b1b; border-radius: 10px; padding: 0.9rem 1.2rem; margin-bottom: 1.5rem; font-size: 0.88rem;">
            <div style="display: flex; align-items: center; gap: 8px; font-weight: 700; margin-bottom: 0.5rem;">
                <i class="bi bi-exclamation-circle-fill"></i> Corrija os erros abaixo:
            </div>
            <ul style="margin: 0; padding-left: 1.2rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulário --}}
    <div style="background: white; border-radius: 14px; border: 2px solid var(--primaria); overflow: hidden;">

        <div style="padding: 1.2rem 1.5rem; border-bottom: 1.5px solid var(--primaria); background: #fafafa;">
            <p style="font-size: 0.78rem; font-weight: 700; color: #999; letter-spacing: 1px; text-transform: uppercase; margin: 0;">Informações da Estadia</p>
        </div>

        <form action="{{ route('estadias.store') }}" method="POST" style="padding: 1.8rem 1.5rem;">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; margin-bottom: 1.2rem;">

                {{-- Reserva --}}
                <div style="grid-column: 1 / -1;">
                    <label style="display: block; font-size: 0.72rem; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">
                        Reserva <span style="color: var(--primaria);">*</span>
                    </label>
                    <select name="reserva_id" required style="width: 100%; padding: 0.65rem 0.9rem; border-radius: 9px; border: 1.5px solid {{ $errors->has('reserva_id') ? '#fca5a5' : '#e5e7eb' }}; font-size: 0.92rem; color: var(--escuro); background: white; outline: none; cursor: pointer;">
                        <option value="">Selecione uma reserva...</option>
                        @foreach($reservas as $reserva)
                            <option value="{{ $reserva->id }}" {{ old('reserva_id', request('reserva_id')) == $reserva->id ? 'selected' : '' }}>
                                Reserva #{{ $reserva->id }}
                                @if($reserva->hospede)
                                    — {{ $reserva->hospede->nome ?? '' }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Quarto --}}
                <div style="grid-column: 1 / -1;">
                    <label style="display: block; font-size: 0.72rem; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">
                        Quarto <span style="color: var(--primaria);">*</span>
                    </label>
                    <select name="quarto_id" required style="width: 100%; padding: 0.65rem 0.9rem; border-radius: 9px; border: 1.5px solid {{ $errors->has('quarto_id') ? '#fca5a5' : '#e5e7eb' }}; font-size: 0.92rem; color: var(--escuro); background: white; outline: none; cursor: pointer;">
                        <option value="">Selecione um quarto...</option>
                        @foreach($quartos as $quarto)
                            <option value="{{ $quarto->id }}" {{ old('quarto_id', request('quarto_id')) == $quarto->id ? 'selected' : '' }}>
                                Quarto #{{ $quarto->numero }}
                                @if($quarto->tipo)
                                    — {{ $quarto->tipo }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Check-in --}}
                <div>
                    <label style="display: block; font-size: 0.72rem; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">
                        Data de Check-in <span style="color: var(--primaria);">*</span>
                    </label>
                    <input type="date" name="data_checkin" value="{{ old('data_checkin', request('data_checkin')) }}" required
                           style="width: 100%; padding: 0.65rem 0.9rem; border-radius: 9px; border: 1.5px solid {{ $errors->has('data_checkin') ? '#fca5a5' : '#e5e7eb' }}; font-size: 0.92rem; color: var(--escuro); outline: none; box-sizing: border-box;">
                </div>

                {{-- Check-out --}}
                <div>
                    <label style="display: block; font-size: 0.72rem; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">
                        Data de Check-out <span style="color: var(--primaria);">*</span>
                    </label>
                    <input type="date" name="data_checkout" value="{{ old('data_checkout', request('data_checkout')) }}" required
                           style="width: 100%; padding: 0.65rem 0.9rem; border-radius: 9px; border: 1.5px solid {{ $errors->has('data_checkout') ? '#fca5a5' : '#e5e7eb' }}; font-size: 0.92rem; color: var(--escuro); outline: none; box-sizing: border-box;">
                </div>

                {{-- Status — padrão "em_andamento" quando vindo de uma reserva --}}
                <div>
                    <label style="display: block; font-size: 0.72rem; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">
                        Status <span style="color: var(--primaria);">*</span>
                    </label>
                    <select name="status" required style="width: 100%; padding: 0.65rem 0.9rem; border-radius: 9px; border: 1.5px solid {{ $errors->has('status') ? '#fca5a5' : '#e5e7eb' }}; font-size: 0.92rem; color: var(--escuro); background: white; outline: none; cursor: pointer;">
                        <option value="">Selecione...</option>
                        <option value="ativa"      {{ old('status', request('status', 'ativa')) == 'ativa'      ? 'selected' : '' }}>Ativa</option>
<option value="concluida"  {{ old('status', request('status')) == 'concluida'            ? 'selected' : '' }}>Concluída</option>
<option value="cancelada"  {{ old('status', request('status')) == 'cancelada'            ? 'selected' : '' }}>Cancelada</option>
                    </select>
                </div>

                {{-- Valor --}}
                <div>
                    <label style="display: block; font-size: 0.72rem; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">
                        Valor da Estadia (R$) <span style="color: var(--primaria);">*</span>
                    </label>
                    <input type="number" name="valor_estadia" value="{{ old('valor_estadia', request('valor_estadia')) }}" required min="0" step="0.01" placeholder="0,00"
                           style="width: 100%; padding: 0.65rem 0.9rem; border-radius: 9px; border: 1.5px solid {{ $errors->has('valor_estadia') ? '#fca5a5' : '#e5e7eb' }}; font-size: 0.92rem; color: var(--escuro); outline: none; box-sizing: border-box;">
                </div>

                {{-- Observações --}}
                <div style="grid-column: 1 / -1;">
                    <label style="display: block; font-size: 0.72rem; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">
                        Observações
                    </label>
                    <textarea name="observacoes" rows="3" placeholder="Alguma observação sobre a estadia..."
                              style="width: 100%; padding: 0.65rem 0.9rem; border-radius: 9px; border: 1.5px solid #e5e7eb; font-size: 0.92rem; color: var(--escuro); outline: none; resize: vertical; box-sizing: border-box; font-family: inherit;">{{ old('observacoes') }}</textarea>
                </div>
            </div>

            {{-- Botões --}}
            <div style="display: flex; gap: 0.8rem; justify-content: flex-end; padding-top: 1rem; border-top: 1.5px solid #f0f0f0;">
                <a href="{{ route('estadias.index') }}"
                   style="padding: 0.65rem 1.4rem; border-radius: 9px; background: #f5f5f5; color: #666; font-size: 0.88rem; font-weight: 700; text-decoration: none;">
                    Cancelar
                </a>
                <button type="submit"
                        style="padding: 0.65rem 1.6rem; border-radius: 9px; background: var(--primaria); color: white; font-size: 0.88rem; font-weight: 700; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="bi bi-check-lg"></i> Criar Estadia
                </button>
            </div>
        </form>
    </div>

</div>
@endsection