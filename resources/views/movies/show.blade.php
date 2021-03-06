@extends('layouts.main')

@section('content')
    <div class="movie-info border-b border-gray-500">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] }}" alt="parasite" class="w-96">
            <div class="lg:ml-20">
                
                <h2 class="text-4xl font-semibold">
                    {{ $movie['title'] }}
                </h2>
                
                <div class="flex items-center text-gray-300 text-sm mt-1">
                    <span><i class="fa fa-star text-orange-400" aria-hidden="true" ></i></span>
                    <span class="ml-1">{{ $movie['vote_average'] * 10 .'%' }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
                    <span class="mx-2">|</span>
                    <span>
                        @foreach ($movie['genres'] as $genre)
                            {{ $genre['name'] }}@if (!$loop->last), @endif
                        @endforeach
                    </span>
                </div>
                
                <p class="text-gray-300 mt-6">
                    {{ $movie['overview'] }}
                </p>

                <div class="mt-6">
                    
                    <h3 class="text-white font-semibold">
                        Featured Cast
                    </h3>
                    
                    <div class="flex mt-2">
                        @foreach ($movie['credits']['crew'] as $crew)
                            @if ($loop->index < 2)
                            <div class="mt-2 {{ !$loop->first ? 'ml-4 pl-4' : ''}}">
                                <div class="">{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                            </div>
                            @endif
                        @endforeach
                    </div>

                    @if (count($movie['videos']['results']) > 0)
                        <div class="mt-6">
                            <a href="https://youtube.com/watch?v={{ $movie['videos']['results'][0]['key'] }}" target="_blank"
                            class="flex inline-flex item-center bg-orange-500 text-gray-900 rounded font-semibold px-7 py-3
                            hover:text-white transition ease-in-out duration-150">
                            <i class="fa fa-play py-1 px-2"></i>
                                Play
                            </a>
                        </div> 
                                           
                    @endif
                </div>
            </div>
        </div>
    </div><!-- end movie info -->

    <div class="movie-cast border-b border-gray-400 mt-6 pb-10">
        <div class="container mx-auto px-4 py-15">
            <h2 class="text-4xl font-semibold">
                Cast
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($movie['credits']['cast'] as $cast)
                    @if ($loop->index < 10)
                        <div class="mt-8">
                            <a href="{{ route('actors.show', $cast['id']) }}">
                                @if ($cast['profile_path'])
                                <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$cast['profile_path'] }}" alt="" class="hover:opacity-75 transition ease-in-out duration-150">
                                @else
                                <img src="{{  'https://ui-avatars.com/api/?size=500&name='.$cast['name'] }}" alt="" class="hover:opacity-75 transition ease-in-out duration-150">
                                @endif
                            </a>
                            <div class="mt-2">
                                <a href="{{ $cast['id'] }}" class="text-lg mt-2 hover:text-gray-300">{{ $cast['name'] }}</a>
                                <div class="text-gray-400 text-sm">
                                {{ $cast['character'] }}
                                </div>
                            </div>
                        </div>
                    
                    @endif
                @endforeach

             </div>
        </div>
    </div>

    <div class="movie-images border-b border-gray-400 mt-6 pb-10">
        <div class="container mx-auto px-4 py-15">
            <h2 class="text-4xl font-semibold">
                Images
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($movie['images']['backdrops'] as $image)
                    @if ($loop->index < 9)
                        <div class="mt-8">
                        <a href="">
                            <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}" alt="" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        </div>
                    @else
                        @break
                    @endif
                @endforeach

             </div>
        </div>
    </div>

    <div class="movie-images border-b border-gray-400 mt-6 pb-10">
        <div class="container mx-auto px-4 py-15">
            <h2 class="text-center">
                copyright@2022 All Rights Reserved
            </h2>
        </div>
    </div>
@endsection