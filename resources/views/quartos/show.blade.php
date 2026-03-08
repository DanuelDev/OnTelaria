@extends('layout')

@section('conteudo')

<div></div>
    <h1>Tipo: {{ $quarto->nome }}</h1>
    <p>{{ $quarto->descricao }}</p>
</div>

@endsection