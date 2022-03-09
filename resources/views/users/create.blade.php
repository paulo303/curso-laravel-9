@extends('layouts.app')
@section('title', $title)

@section('content')
<h1>Novo Usuário</h1>

<p>
    <a href="{{ route('users.index') }}">Listagem</a>
</p>

<form action="{{ route('users.store') }}" method="post">
    @include('users._partials.form')
</form>

@include('includes.validations-form')

@endsection
