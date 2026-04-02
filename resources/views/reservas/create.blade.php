@extends('layout')

@section('conteudo')

<div class="container-lista py-5" style="max-width: 700px; margin: 120px auto 60px; padding: 0 20px;">

    <div style="margin-bottom: 2.5rem;">
        <a href="{{ route('reservas.index') }}" class="btn-voltar">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <h2 style="color: var(--escuro); font-weight: 700; font-size: 2.2rem; margin: 0.5rem 0 0;">Nova Reserva</h2>
        <p style="color: var(--secundaria); margin: 0;">Preencha os dados para registrar uma nova hospedagem</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger mb-4" style="border-radius: 10px; font-size: 0.9rem;">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservas.store') }}" method="POST">
        @csrf

        <div class="form-card">

            <div class="form-grupo">
                <label class="label-admin" for="hospede_id">HÓSPEDE</label>
                <select name="hospede_id" id="hospede_id" class="input-admin @error('hospede_id') is-invalid @enderror" required>
                    <option value="">Selecione um hóspede...</option>
                    @foreach($hospedes as $hospede)
                        <option value="{{ $hospede->id }}" {{ old('hospede_id') == $hospede->id ? 'selected' : '' }}>
                            {{ $hospede->nome }}
                        </option>
                    @endforeach
                </select>
                @error('hospede_id')
                    <span class="erro-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-linha">
                <div class="form-grupo">
                    <label class="label-admin" for="data_inicio">CHECK-IN</label>
                    <input type="date" name="data_inicio" id="data_inicio"
                           class="input-admin @error('data_inicio') is-invalid @enderror"
                           value="{{ old('data_inicio') }}" required>
                    @error('data_inicio')
                        <span class="erro-msg">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-grupo">
                    <label class="label-admin" for="data_fim">CHECK-OUT</label>
                    <input type="date" name="data_fim" id="data_fim"
                           class="input-admin @error('data_fim') is-invalid @enderror"
                           value="{{ old('data_fim') }}" required>
                    @error('data_fim')
                        <span class="erro-msg">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-grupo">
                <label class="label-admin" for="observacoes">OBSERVAÇÕES</label>
                <textarea name="observacoes" id="observacoes" rows="4"
                          class="input-admin @error('observacoes') is-invalid @enderror"
                          placeholder="Informações adicionais sobre a reserva...">{{ old('observacoes') }}</textarea>
                @error('observacoes')
                    <span class="erro-msg">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="form-acoes">
            <a href="{{ route('reservas.index') }}" class="btn-cancelar">Cancelar</a>
            <button type="submit" class="btn-salvar">
                <i class="bi bi-check-lg"></i> Salvar Reserva
            </button>
        </div>

    </form>
</div>


@endsection