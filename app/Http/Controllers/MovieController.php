<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query();

        $movies = Movie::query()
            ->when(isset($query['is_showing']), function ($q) use ($query) {
                $q->where('is_showing', $query['is_showing']);
            })
            ->when(isset($query['keyword']), function ($q) use ($query) {
                $q->where(function ($subQuery) use ($query) {
                    $subQuery->where('title', 'like', '%' . $query['keyword'] . '%')
                        ->orWhere('description', 'like', '%' . $query['keyword'] . '%');
                });
            })
            ->paginate(20);

        return view('movie.index', ['movies' => $movies]);
    }
}
