<h1>Novo Quarto</h1>

<form action="{{ route('quartos.store') }}" method="POST">
    @csrf

    Número:
    <input type="text" name="numero">

    <button type="submit">Salvar</button>
</form>