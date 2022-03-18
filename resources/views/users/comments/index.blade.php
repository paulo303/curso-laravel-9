@extends('layouts.app')
@section('title', $title)

@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2">
    {{ $title }}
    <a href="{{ route('comments.create', $user->id) }}" class="bg-blue-900 rounded-full text-white px-4 text-sm">+</a>
    <a href="{{ route('users.index') }}" class="bg-blue-900 rounded-full text-white px-4 py-1 text-sm">voltar</a>
</h1>

<form action="{{ route('comments.index', $user->id) }}" method="get" class="py-5">
    <input type="text" name="search" placeholder="Pesquisar" class="md:w-1/6 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" value="{{ $search ?? '' }}">
    <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Pesquisar</button>
</form>

<table class="min-w-full leading-normal shadow-md rounded-lg overflow-hidden">
    <thead>
        <tr>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Comentário
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Visível
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Editar
            </th>
        </tr>
      </thead>
      <tbody>
    @forelse ($comments as $comment)
        <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                {{ $comment->body }}
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                {{ $comment->visible ? 'SIM' : 'NÃO' }}
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <a href="{{ route('comments.edit', ['user' => $user->id, 'id' => $comment->id]) }}" class="bg-green-200 rounded-full py-2 px-6">Editar</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                Nenhum resultado encontrado
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

@include('users.comments._partials.paginate')

@endsection