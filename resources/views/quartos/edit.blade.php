<h1>Editar Quarto</h1>

<form action="{{ route('quartos.update', $quarto->id) }}" method="POST">
    @csrf
    @method('PUT')

    Número:
    <input type="text" name="numero" value="{{ $quarto->numero }}">

    <button type="submit">Atualizar</button>
</form>