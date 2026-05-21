@extends('layout')

@section('titulo', 'Clientes')

@section('conteudo')

<div class="container-lista py-5">
    <div class="page-header">
        <div class="page-header-title">
            <h2>Clientes</h2>
            <p>Gerencie contas de clientes e visualize perfis.</p>
        </div>
        <div class="search-bar">
            <input id="search" type="search" placeholder="&#x1F50D; Procurar pelo nome..." />
        </div>
        <a href="{{ route('clientes.create') }}" class="btn-primary-admin">
            <i class="bi bi-plus-lg"></i> Novo Cliente
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @forelse($clientes as $cliente)
    <div class="admin-card shadow-sm mb-4">
        <div class="card-body-admin">
            <div class="info-grid">
                <div>
                    <span class="label-admin">NOME</span>
                    <strong>{{ $cliente->name }}</strong>
                </div>
                <div>
                    <span class="label-admin">EMAIL</span>
                    <span class="badge-tipo badge-secondary">{{ $cliente->email }}</span>
                </div>
                <div>
                    <span class="label-admin">RESERVAS</span>
                    <strong>{{ $cliente->reservas()->count() }}</strong>
                </div>
                <div>
                    <span class="label-admin">CRIADO EM</span>
                    <strong>{{ optional($cliente->created_at)->format('d/m/Y') ?? '—' }}</strong>
                </div>
            </div>

            <div class="quarto-acoes">
                <a href="{{ route('clientes.show', $cliente) }}" class="btn-admin btn-ver" title="Visualizar">
                    <i class="bi bi-eye"></i> <span>Ver</span>
                </a>
                <a href="{{ route('clientes.edit', $cliente) }}" class="btn-admin btn-editar" title="Editar">
                    <i class="bi bi-pencil-square"></i> <span>Editar</span>
                </a>
                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-admin btn-excluir" style="margin-bottom: -20px;" onclick="return confirm('Tem certeza que deseja excluir este cliente?')" title="Excluir">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="panel-card">
        <p class="dash-vazio">Nenhum cliente encontrado.</p>
    </div>
    @endforelse
</div>

<script src="{{ asset('js/clientes_index.js') }}"></script>
@endsection