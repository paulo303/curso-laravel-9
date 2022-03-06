@extends('layouts.app')
@section('title', "Editar o Usuário {$user->name}")

@section('content')
<h1>Editar o Usuário {{ $user->name }}</h1>

<p>
    <a href="{{ route('users.index') }}">Listagem</a>
</p>

<form action="{{ route('users.update', $user->id) }}" method="post">
    @method('PUT')
    @csrf

    <input type="text" name="name" id="name" placeholder="Nome:" value="{{ $user->name }}">
    <input type="text" name="email" id="email" placeholder="Email:" value="{{ $user->email }}">
    <input type="password" name="password" id="password" placeholder="Senha:">
    <button type="submit">Salvar</button>
</form>

@if ($errors->any())
    <ul class="errors">
        @foreach ($errors->all() as $error)
            <li class="error">{{ $error }}</li>
        @endforeach
    </ul>
@endif
@endsection
