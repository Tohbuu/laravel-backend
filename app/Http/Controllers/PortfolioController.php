<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Services\PortfolioService;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    protected $portfolioService;

    public function __construct(PortfolioService $portfolioService)
    {
        $this->portfolioService = $portfolioService;
        $this->middleware('auth')->except(['show']);
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
            'social_links' => 'nullable|json',
            'custom_sections' => 'nullable|json',
        ]);

        $portfolio = auth()->user()->portfolio;

        if ($request->hasFile('background_image')) {
            if ($portfolio->background_image) {
                Storage::delete($portfolio->background_image);
            }
            $validated['background_image'] = $request->file('background_image')->store('portfolio_backgrounds');
        }

        $portfolio->update($validated);

        return redirect()->route('portfolio.show', auth()->id())->with('success', 'Portfolio updated successfully!');
    }

    public function dashboard()
    {
        $portfolio = auth()->user()->portfolio;
        return view('portfolio.dashboard', compact('portfolio'));
    }
}