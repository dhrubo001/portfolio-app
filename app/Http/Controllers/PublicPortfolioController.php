<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;

class PublicPortfolioController extends Controller
{
    public function __invoke($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->firstOrFail();
        return view('portfolio.public', compact('portfolio'));
    }
}
