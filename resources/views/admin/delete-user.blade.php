@extends('layout')

@section('content')
    <x-card class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Delete user {{$user->name}}?
            </h2>
        </header>

        <form method="POST" action="/admin/{{$user->id}}">
            @csrf
            @method("DELETE")
            <div class="flex mb-6 mt-10 px-auto align-center justify-center">
                <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Delete
                </button>
                <a href="javascript:history.back()" class="text-black ml-4 py-2 px-4 "> Back </a>
            </div>
        </form>
    </x-card>
@endsection
