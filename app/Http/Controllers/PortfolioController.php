<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Services\PortfolioService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    protected $portfolioService;

    public function __construct()
    {
        $this->portfolioService = new PortfolioService();
        // Instead of using middleware here, we'll handle authentication in the routes file
    }

    public function show($userId)
    {
        $portfolio = Portfolio::where('user_id', $userId)->firstOrFail();
        return view('portfolio.show', compact('portfolio'));
    }

    public function edit()
    {
        $portfolio = auth()->user()->portfolio;
        return view('portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'about' => 'nullable|string',
            'theme_color' => 'nullable|string',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_links' => 'nullable|array',
            'custom_sections' => 'nullable|array',
        ]);

        $portfolio = auth()->user()->portfolio;

        if ($request->hasFile('background_image')) {
            if ($portfolio->background_image) {
                Storage::delete($portfolio->background_image);
            }
            $validated['background_image'] = $request->file('background_image')->store('portfolio_backgrounds');
        }

        $portfolio->update($validated);
        
        if (config('services.socket.enabled')) {
            Http::post(config('services.socket.url').'/notify-update', [
                'user_id' => auth()->id(),
                'event' => 'portfolio_updated'
            ]);
        }

        return redirect()->route('portfolio.show', auth()->id())->with('success', 'Portfolio updated successfully!');
    }

    public function dashboard()
{
    $user = auth()->user();
    $portfolio = $user->portfolio;
    
    // Create a default portfolio if one doesn't exist
    if (!$portfolio) {
        $portfolio = Portfolio::create([
            'user_id' => $user->id,
            'title' => $user->name . "'s Portfolio",
            'about' => 'Welcome to my portfolio!',
            'theme_color' => '#3490dc', // Default blue color
        ]);
    }
    
    return view('portfolio.dashboard', compact('portfolio'));
}
}