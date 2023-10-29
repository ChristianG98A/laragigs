@props(['user'])

<x-card class="mb-4">
    <div class="flex justify-between">
        {{-- <img class="hidden w-48 mr-6 md:block" src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png')}}" alt="logo" /> --}}
        <h3 class="text-center text-xl">{{ $user->email }}</h3>
        <div class="space-x-4">
            <a href="admin/{{ $user->id }}/edit"><i class="m-left-auto py-2 fa-solid fa-pen"></i></a>
        </div>
    </div>
</x-card>
