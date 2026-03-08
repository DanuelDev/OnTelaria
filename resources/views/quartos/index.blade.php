@extends('layout')

@section('conteudo')

<h1>Lista de Quartos</h1>

<div class="container">
<table class="table table-striped">
    <thead>
        <tr>
            <th class="p-3">Número</th>
            <th class="p-3">Tipo</th>
            <th class="p-3">Preço</th>
        </tr>
    </thead>
    <tbody>
        @foreach($quartos as $quarto)
        <tr>
            <td class="p-3">{{ $quarto->numero }}</td>
            <td class="p-3">{{ $quarto->tipo }}</td>
            <td class="p-3">{{ $quarto->preco_diaria }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection