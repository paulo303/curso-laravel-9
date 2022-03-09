@extends('layouts.app')
@section('title', $title)

@section('content')
<h1>Dados do usuário {{ $user->name }}</h1>

<p>
    <a href="{{ route('users.index') }}">Listagem</a>
</p>

<ul>
    <li>{{ $user->name }}</li>
    <li>{{ $user->email }}</li>
    <li>{{ $user->criado_em }}</li>
    <li>{{ $user->atualizado_em }}</li>
</ul>

<form action="{{ route('users.destroy', $user->id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit">Deletar</button>
</form>
@endsection
