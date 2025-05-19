@extends('layouts.app')

@section('title', $portfolio->title)

@section('styles')
<style>
    .portfolio-background {
        background-image: url('{{ $portfolio->background_image ? Storage::url($portfolio->background_image) : '' }}');
        background-size: cover;
        background-position: center;
    }
    .portfolio-theme {
        background-color: {{ $portfolio->theme_color }};
    }
</style>
@endsection

@section('content')
<div class="portfolio-background rounded-lg shadow-xl overflow-hidden mb-8">
    <div class="bg-black bg-opacity-50 p-8 text-white">
        <div class="container mx-auto">
            <h1 class="text-4xl font-bold mb-2">{{ $portfolio->title }}</h1>
            <p class="text-xl mb-6">{{ $portfolio->about }}</p>
            
            @if($portfolio->social_links)
                <div class="flex space-x-4">
                    @foreach($portfolio->social_links as $name => $url)
                        <a href="{{ $url }}" target="_blank" class="text-white hover:text-blue-300 text-2xl">
                            <i class="fab fa-{{ $name }}"></i>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @if($portfolio->custom_sections)
        @foreach($portfolio->custom_sections as $section)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-4">{{ $section['title'] }}</h2>
                <div class="prose">
                    {!! $section['content'] !!}
                </div>
            </div>
        @endforeach
    @endif
</div>

@auth
    @if(auth()->id() == $portfolio->user_id)
        <div class="mt-8 text-center">
            <a href="{{ route('portfolio.edit') }}" class="portfolio-theme text-white px-6 py-3 rounded-lg hover:opacity-90 transition">
                Edit Your Portfolio
            </a>
        </div>
    @endif
@endauth
@endsection