@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Your Dashboard</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Portfolio Summary -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-4">Portfolio Overview</h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Portfolio Title</p>
                                <p class="font-medium">{{ $portfolio->title }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Last Updated</p>
                                <p class="font-medium">{{ $portfolio->updated_at->diffForHumans() }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Theme Color</p>
                                <div class="flex items-center">
                                    <span class="w-6 h-6 rounded-full mr-2" style="background-color: {{ $portfolio->theme_color }}"></span>
                                    <span>{{ $portfolio->theme_color }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
                        <div class="space-y-3">
                            <a href="{{ route('portfolio.edit') }}" class="block w-full px-4 py-2 bg-blue-600 text-white text-center rounded hover:bg-blue-700 transition">
                                Edit Portfolio
                            </a>
                            <a href="{{ route('portfolio.show', auth()->id()) }}" class="block w-full px-4 py-2 bg-green-600 text-white text-center rounded hover:bg-green-700 transition">
                                View Public Portfolio
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Section -->
                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Recent Activity</h2>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600">No recent activity yet.</p>
                        <!-- You can add actual activity logs here later -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection