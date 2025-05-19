@extends('layouts.app')

@section('title', 'Edit Portfolio')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-8">
    <h1 class="text-3xl font-bold mb-6">Edit Your Portfolio</h1>
    
    <form action="{{ route('portfolio.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="title" class="block text-gray-700 font-bold mb-2">Portfolio Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $portfolio->title) }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-6">
            <label for="about" class="block text-gray-700 font-bold mb-2">About You</label>
            <textarea name="about" id="about" rows="4" 
                      class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('about', $portfolio->about) }}</textarea>
        </div>

        <div class="mb-6">
            <label for="theme_color" class="block text-gray-700 font-bold mb-2">Theme Color</label>
            <input type="color" name="theme_color" id="theme_color" value="{{ old('theme_color', $portfolio->theme_color) }}" 
                   class="h-12 w-24 cursor-pointer">
        </div>

        <div class="mb-6">
            <label for="background_image" class="block text-gray-700 font-bold mb-2">Background Image</label>
            <input type="file" name="background_image" id="background_image" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @if($portfolio->background_image)
                <div class="mt-2">
                    <p class="text-sm text-gray-600">Current image:</p>
                    <img src="{{ Storage::url($portfolio->background_image) }}" alt="Current background" class="h-32 mt-2 rounded">
                </div>
            @endif
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Social Links</label>
            <div id="social-links-container">
                @if($portfolio->social_links)
                    @foreach($portfolio->social_links as $name => $url)
                        <div class="flex mb-2 social-link">
                            <select name="social_links[{{ $loop->index }}][name]" class="px-4 py-2 border rounded-l-lg">
                                <option value="facebook" {{ $name == 'facebook' ? 'selected' : '' }}>Facebook</option>
                                <option value="twitter" {{ $name == 'twitter' ? 'selected' : '' }}>Twitter</option>
                                <option value="instagram" {{ $name == 'instagram' ? 'selected' : '' }}>Instagram</option>
                                <option value="linkedin" {{ $name == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                                <option value="github" {{ $name == 'github' ? 'selected' : '' }}>GitHub</option>
                            </select>
                            <input type="url" name="social_links[{{ $loop->index }}][url]" value="{{ $url }}" 
                                   class="flex-1 px-4 py-2 border-t border-b border-r rounded-r-lg" placeholder="URL">
                            <button type="button" class="ml-2 px-3 py-2 bg-red-500 text-white rounded-lg remove-link">Remove</button>
                        </div>
                    @endforeach
                @endif
            </div>
            <button type="button" id="add-social-link" class="mt-2 px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Add Social Link</button>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Custom Sections</label>
            <div id="custom-sections-container">
                @if($portfolio->custom_sections)
                    @foreach($portfolio->custom_sections as $index => $section)
                        <div class="mb-4 p-4 border rounded-lg custom-section">
                            <div class="mb-2">
                                <label class="block text-gray-700 mb-1">Section Title</label>
                                <input type="text" name="custom_sections[{{ $index }}][title]" value="{{ $section['title'] }}" 
                                       class="w-full px-4 py-2 border rounded-lg">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Content</label>
                                <textarea name="custom_sections[{{ $index }}][content]" rows="4" 
                                          class="w-full px-4 py-2 border rounded-lg">{{ $section['content'] }}</textarea>
                            </div>
                            <button type="button" class="mt-2 px-3 py-1 bg-red-500 text-white rounded-lg remove-section">Remove Section</button>
                        </div>
                    @endforeach
                @endif
            </div>
            <button type="button" id="add-custom-section" class="mt-2 px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Add Custom Section</button>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
        </div>
    </form>
</div>

@section('scripts')
<script>
    // Social Links
    document.getElementById('add-social-link').addEventListener('click', function() {
        const container = document.getElementById('social-links-container');
        const index = document.querySelectorAll('.social-link').length;
        
        const div = document.createElement('div');
        div.className = 'flex mb-2 social-link';
        div.innerHTML = `
            <select name="social_links[${index}][name]" class="px-4 py-2 border rounded-l-lg">
                <option value="facebook">Facebook</option>
                <option value="twitter">Twitter</option>
                <option value="instagram">Instagram</option>
                <option value="linkedin">LinkedIn</option>
                <option value="github">GitHub</option>
            </select>
            <input type="url" name="social_links[${index}][url]" 
                   class="flex-1 px-4 py-2 border-t border-b border-r rounded-r-lg" placeholder="URL">
            <button type="button" class="ml-2 px-3 py-2 bg-red-500 text-white rounded-lg remove-link">Remove</button>
        `;
        
        container.appendChild(div);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-link')) {
            e.target.closest('.social-link').remove();
        }
    });

    // Custom Sections
    document.getElementById('add-custom-section').addEventListener('click', function() {
        const container = document.getElementById('custom-sections-container');
        const index = document.querySelectorAll('.custom-section').length;
        
        const div = document.createElement('div');
        div.className = 'mb-4 p-4 border rounded-lg custom-section';
        div.innerHTML = `
            <div class="mb-2">
                <label class="block text-gray-700 mb-1">Section Title</label>
                <input type="text" name="custom_sections[${index}][title]" 
                       class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Content</label>
                <textarea name="custom_sections[${index}][content]" rows="4" 
                          class="w-full px-4 py-2 border rounded-lg"></textarea>
            </div>
            <button type="button" class="mt-2 px-3 py-1 bg-red-500 text-white rounded-lg remove-section">Remove Section</button>
        `;
        
        container.appendChild(div);
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-section')) {
            e.target.closest('.custom-section').remove();
        }
    });
</script>
@endsection
@endsection