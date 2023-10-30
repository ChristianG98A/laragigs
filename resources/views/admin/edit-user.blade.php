@extends('layout')
@section('content')

    @php
        $isListings = $listings ?? null;
    @endphp


    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        <x-card class="lg:grid lg:grid-cols-1 bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    Edit {{ $user->name }}
                </h2>
            </header>

            <form method="POST" action="/admin/{{ $user->id }}">
                @csrf
                <div class="mb-6">
                    <label for="name" class="inline-block text-lg mb-2">
                        Name
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                        value="{{ $user->name }}" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="inline-block text-lg mb-2">Email</label>
                    <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                        value="{{ $user->email }}" />
                    <!-- Error Example -->
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="inline-block text-lg mb-2">
                        Password
                    </label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password" />
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="inline-block text-lg mb-2">
                        Confirm Password
                    </label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation" />
                </div>

                <div class="mb-6">
                    <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                        Update User
                    </button>
                    <a href="delete-confirmation" class="text-red-500 ml-4"> Delete </a>
                    <a href="/admin" class="text-black ml-4"> Back </a>
                </div>


            </form>
        </x-card>

        <div class="lg:grid lg:grid-cols-1 gap-4 space-y-4 md:space-y-0 mx-4">
            @if (count($listings) == 0)
                <x-card class="mt-24">
                    <h2 class="text-center text-2xl font-bold uppercase mb-1">
                        User has no listings
                    </h2>
                </x-card>
            @endif
            @unless (count($listings) == 0)
                <div class="mt-24">
                    @foreach ($listings as $listing)
                        <x-admin-listing-card :listing="$listing" />
                    @endforeach
                </div>
            @endunless ()
        </div>
    </div>
@endsection
