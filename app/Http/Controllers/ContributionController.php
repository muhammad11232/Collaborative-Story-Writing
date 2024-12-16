<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Chapter;
use App\Models\Contribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContributionController extends Controller
{
    public function index()
    {
        
        // Get the total word count per user, sorted by the highest total word count
        $topContributors = Contribution::selectRaw('user_id, SUM(word_count) as total_word_count')
            ->groupBy('user_id')
            ->orderByDesc('total_word_count')
            ->with('user') // Eager load user data
            ->take(10) // Limit to top 10 contributors
            ->get();
        // Return the data as JSON
        return response()->json($topContributors);
    }

}
