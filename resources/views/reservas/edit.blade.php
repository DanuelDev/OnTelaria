@extends('layout')

@section('conteudo')

<div class="container-lista py-5" style="max-width: 700px; margin: 120px auto 60px; padding: 0 20px;">

    <div style="margin-bottom: 2.5rem;">
        <a href="{{ route('reservas.index') }}" class="btn-voltar">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <h2 style="color: var(--escuro); font-weight: 700; font-size: 2.2rem; margin: 0.5rem 0 0;">Editar Reserva <span style="color: var(--primaria);">#{{ $reserva->id }}</span></h2>
        <p style="color: var(--secundaria); margin: 0;">Atualize os dados da hospedagem</p>
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

    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-card">

            <div class="form-grupo">
                <label class="label-admin" for="hospede_id">HÓSPEDE</label>
                <select name="hospede_id" id="hospede_id" class="input-admin @error('hospede_id') is-invalid @enderror" required>
                    <option value="">Selecione um hóspede...</option>
                    @foreach($hospedes as $hospede)
                        <option value="{{ $hospede->id }}">
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
                           value="{{ old('data_inicio', $reserva->data_inicio) }}" required>
                    @error('data_inicio')
                        <span class="erro-msg">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-grupo">
                    <label class="label-admin" for="data_fim">CHECK-OUT</label>
                    <input type="date" name="data_fim" id="data_fim"
                           class="input-admin @error('data_fim') is-invalid @enderror"
                           value="{{ old('data_fim', $reserva->data_fim) }}" required>
                    @error('data_fim')
                        <span class="erro-msg">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-linha">
                <div class="form-grupo">
                    <label class="label-admin" for="status">STATUS</label>
                    <select name="status" id="status" class="input-admin @error('status') is-invalid @enderror" required>
                        @foreach(['pendente' => 'Pendente', 'confirmada' => 'Confirmada', 'cancelada' => 'Cancelada', 'concluida' => 'Concluída'] as $val => $label)
                            <option value="{{ $val }}" {{ old('status', $reserva->status) == $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <span class="erro-msg">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-grupo">
                    <label class="label-admin" for="valor_total">VALOR TOTAL (R$)</label>
                    <input type="number" name="valor_total" id="valor_total" step="0.01" min="0"
                           class="input-admin @error('valor_total') is-invalid @enderror"
                           value="{{ old('valor_total', $reserva->valor_total) }}" required>
                    @error('valor_total')
                        <span class="erro-msg">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-grupo">
                <label class="label-admin" for="observacoes">OBSERVAÇÕES</label>
                <textarea name="observacoes" id="observacoes" rows="4"
                          class="input-admin @error('observacoes') is-invalid @enderror"
                          placeholder="Informações adicionais sobre a reserva...">{{ old('observacoes', $reserva->observacoes) }}</textarea>
                @error('observacoes')
                    <span class="erro-msg">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="form-acoes">
            <a href="{{ route('reservas.index') }}" class="btn-cancelar">Cancelar</a>
            <button type="submit" class="btn-salvar">
                <i class="bi bi-check-lg"></i> Atualizar Reserva
            </button>
        </div>

    </form>
</div>
<script>
    document.getElementById('hospede_id').addEventListener('change', function() {
    document.getElementById('hospede_nome').value = 
        this.options[this.selectedIndex].dataset.nome;
});
</script>

@endsection