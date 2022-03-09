@extends('layouts.app')
@section('title', $title)

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">
    Dados do usuário {{ $user->name }}
    <a href="{{ route('users.index') }}" class="bg-blue-900 rounded-full text-white px-4 py-1 text-sm">voltar</a>
</h1>

<ul>
    <li>{{ $user->name }}</li>
    <li>{{ $user->email }}</li>
    <li>{{ $user->criado_em }}</li>
    <li>{{ $user->atualizado_em }}</li>
</ul>

<form action="{{ route('users.destroy', $user->id) }}" method="post" class="py-12">
    @csrf
    @method('DELETE')
    <button type="submit" class="rounded-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Deletar</button>
</form>
@endsection
