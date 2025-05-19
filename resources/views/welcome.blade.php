@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">Welcome to PortfolioSpace</h1>
            <p class="text-xl text-gray-600 mb-8">Showcase your work with a fully customizable portfolio</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ url('/register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
                    Get Started
                </a>
                <a href="{{ url('/login') }}" class="border border-blue-600 text-blue-600 hover:bg-blue-50 px-6 py-3 rounded-lg">
                    Login
                </a>
            </div>
        </div>
    </div>
</div>
@endsection