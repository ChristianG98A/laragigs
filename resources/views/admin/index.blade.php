@extends('layout')

@section('content')
@include('partials._hero')
@include('partials._search')


    <div>hello admin!</div>

    {{-- <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @unless (count($listings) == 0)


            @foreach ($listings as $listing)
                <x-listing-card :listing="$listing" />
            @endforeach

        @endunless ()

    </div>

    <div class="pt-10">
        {{$listings->links()}}
    </div> --}}

@endsection
