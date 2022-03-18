@extends('layouts.app')
@section('title', $title)

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">
    {{ $title }}
    <a href="{{ route('comments.index', $user->id) }}" class="bg-blue-900 rounded-full text-white px-4 py-1 text-sm">voltar</a>
</h1>

@include('includes.validations-form')

<form action="{{ route('comments.store', $user->id) }}" method="post">
    @include('users.comments._partials.form')
</form>

@endsection
