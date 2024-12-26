<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class SearchController extends Controller
{
    // I need only one action
    public function __invoke()
    {
        $jobs = Job::query()
        ->with(['employer', 'tags'])
        ->where('title', 'LIKE', '%'.request('search').'%')
        ->get(); // Get all jobs where the title is like the search query

        return view('results', [
            'jobs' => $jobs
        ]);
    }
}
