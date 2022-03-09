@extends('layouts.app')
@section('title', $title)

@section('content')
<h1>Listagem dos usuários</h1>

<p>
    <a href="{{ route('users.create') }}">Criar novo usuário</a>
</p>

<form action="" method="get">
    <input type="text" name="search" id="search" placeholder="Pesquisar">
    <button type="submit">Pesquisar</button>
</form>

@forelse ($users as $user)
    <p>
        {{ $user->name }} -
        {{ $user->email }} |
        <a href="{{ route('users.edit', $user->id) }}">Editar</a>
        <a href="{{ route('users.show', $user->id) }}">Detalhes</a>
    </p>
@empty
    <p>
        Nenhum resultado
    </p>
@endforelse
@endsection
