@extends('layouts.app')

@section('title', 'BRQ News - ' . $author->name)
@section('content')
 <!-- Author -->
    <div class="flex gap-4 items-center mb-10 text-white p-10 bg-cover" style="background-image: url('{{asset('assets/img/bg-profile.png')}}');">
      <img src="{{ asset('storage/' . $author->avatar) }}" alt="profile" class="rounded-full max-w-28 ">
      <div class="">
        <p class="font-bold text-lg">{{ $author->user->name }}</p>
        <p>{!! $author->bio !!}</p>
      </div>
    </div>

    <!-- Berita -->
    <div class=" flex flex-col gap-5 px-4 lg:px-14">
        <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
        @foreach ($author->news as $item)
          <a href="{{ route('news.show', $item->slug) }}">
            <div
              class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out">
              <div class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
                {{ $item->newsCategory->title }}</div>
              <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="" class="w-full rounded-xl mb-3" style="height: 250px; object-fit:cover;">
              <p class="font-bold text-base mb-1">{{ $item->title }}</p>
              <p class="text-slate-400">{{ $item->published_at }}</p>
            </div>
          </a>
         
          @endforeach
        </div>
    </div>

@endsection