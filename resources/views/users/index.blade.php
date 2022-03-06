@extends('layouts.app')
@section('title', $title)

@section('content')
<h1>Listagem dos usuários</h1>

<p>
    <a href="{{ route('users.create') }}">Criar novo usuário</a>
</p>

<ul>
    @foreach ($users as $user)
        <li>
            {{ $user->name }} -
            {{ $user->email }} |
            <a href="{{ route('users.edit', $user->id) }}">Editar</a>
            <a href="{{ route('users.show', $user->id) }}">Detalhes</a>
        </li>
    @endforeach
</ul>
@endsection
