@extends('layout')

@section('title', 'Lista de Tarefas')

@section('content')
<h1>Lista de Tarefas</h1>

<a href="{{ route('tarefas.create') }}" class="btn btn-primary mb-3">Criar Nova Tarefa</a>

<ul class="list-group">

    @foreach($tarefas as $tarefa)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        {{ $tarefa->titulo }}
        <div>
            <a href="{{ route('tarefas.show', $tarefa->id) }}" class="btn btn-sm btn-info">Ver</a>

            <a href="{{ route('tarefas.edit', $tarefa->id) }}" class="btn btn-sm btn-
            warning">Editar</a>

            <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST"
            style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
            </form>
        </div>
    </li>
    @endforeach
</ul>
@endsection