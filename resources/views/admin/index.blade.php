@extends('layout')
@section('content')


    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        <div class="lg:grid lg:grid-cols-1 gap-4 space-y-4 md:space-y-0 mx-4">
            @unless (count($listings) == 0)
                @foreach ($listings as $listing)
                    <x-listing-card :listing="$listing" />
                @endforeach
            @endunless ()
        </div>

        <div class="lg:grid lg:grid-cols-1 gap-4 space-y-4 md:space-y-0 mx-4">
            <x-card>
                <h3 class="text-center text-xl mb-5">Users</h3>

                <div class="flex mb-4 justify-end">
                    <a href="admin/add-user"
                        class="text-center py-2 h-10 w-40 text-white rounded-lg bg-red-500 hover:bg-red-600">
                        Add User <i class="fa-solid fa-plus"></i>
                    </a>
                </div>


                @foreach ($users as $user)
                    <x-user-card :user="$user" />
                @endforeach
            </x-card>
        </div>
    </div>
    {{-- <div class="pt-10">
        {{$listings->links()}}
    </div> --}}

@endsection
