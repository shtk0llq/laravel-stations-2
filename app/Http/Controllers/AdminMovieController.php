<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;

class AdminMovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('admin.movie.index', ['movies' => $movies]);
    }

    public function create()
    {
        return view('admin.movie.create');
    }

    public function store(CreateMovieRequest $request)
    {
        $input = $request->all();

        try {
            Movie::create($input);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'エラーが発生しました。');
        }

        return redirect(route('admin.movies'));
    }
}
