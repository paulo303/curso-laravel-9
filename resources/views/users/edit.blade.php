@extends('layouts.app')
@section('title', "Editar o Usuário {$user->name}")

@section('content')
<h1>Editar o Usuário {{ $user->name }}</h1>

<p>
    <a href="{{ route('users.index') }}">Listagem</a>
</p>

<form action="{{ route('users.update', $user->id) }}" method="post">
    @method('PUT')
    @include('users._partials.form')
</form>

@include('includes.validations-form')

@endsection
