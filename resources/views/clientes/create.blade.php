@extends('layout')

@section('titulo', 'Novo Cliente')

@section('conteudo')

<div class="container-lista py-5">
    <div class="page-header">
        <div class="page-header-title">
            <h2>Criar Cliente</h2>
            <p>Cadastre uma nova conta de cliente.</p>
        </div>
        <a href="{{ route('clientes.index') }}" class="btn-voltar">Voltar</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="form-card">
            <div class="form-grupo">
                <label class="label-admin" for="name">Nome</label>
                <input type="text" name="name" id="name" class="input-admin @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <span class="erro-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-grupo">
                <label class="label-admin" for="email">Email</label>
                <input type="email" name="email" id="email" class="input-admin @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email')
                    <span class="erro-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-grupo">
                <label class="label-admin" for="password">Senha</label>
                <input type="password" name="password" id="password" class="input-admin @error('password') is-invalid @enderror" required>
                @error('password')
                    <span class="erro-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-grupo">
                <label class="label-admin" for="password_confirmation">Confirmar Senha</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="input-admin" required>
            </div>
        </div>

        <div class="form-acoes">
            <a href="{{ route('clientes.index') }}" class="btn-cancelar" title="Voltar sem salvar">Cancelar</a>
            <button type="submit" class="btn-salvar"><i class="bi bi-check-lg" aria-hidden="true"></i> <span>Salvar Cliente</span></button>
        </div>
    </form>
</div>

@endsection
