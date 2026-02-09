<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function edit()
    {
        $portfolio = Portfolio::where('user_id', Auth::id())->first();
        return view('portfolio.edit', compact('portfolio'));
    }

    public function store(Request $request)
    {
        $portfolio = Portfolio::where('user_id', auth()->id())->first();

        $rules = [
            'mobile'      => 'required|string|max:20',
            'address'     => 'required|string|max:500',
            'bio'         => 'required|string|max:1000',
            'projects'    => 'nullable|array',
            'projects.*'  => 'nullable|url',
        ];

        /**
         * Skills validation:
         * - Required only if portfolio does NOT already have skills
         */
        if (!$portfolio || empty($portfolio->skills)) {
            $rules['skills'] = 'required|string';
        } else {
            $rules['skills'] = 'nullable|string';
        }

        $data = $request->validate($rules);

        /**
         * Normalize skills (newline-separated string)
         */
        if (!empty($data['skills'])) {
            $data['skills'] = collect(explode("\n", $data['skills']))
                ->map(fn($s) => trim($s))
                ->filter()
                ->unique()
                ->implode("\n");
        } else {
            // Keep existing skills if not submitted
            unset($data['skills']);
        }

        /**
         * Normalize projects (array)
         */
        if (!empty($data['projects'])) {
            $data['projects'] = collect($data['projects'])
                ->filter()
                ->values()
                ->toArray();
        } else {
            $data['projects'] = [];
        }

        /**
         * Always sync name & email from user table
         */
        $data['name']  = auth()->user()->name;
        $data['email'] = auth()->user()->email;

        Portfolio::updateOrCreate(
            ['user_id' => auth()->id()],
            $data
        );

        return redirect()->back()->with('success', 'Portfolio saved!');
    }
}
