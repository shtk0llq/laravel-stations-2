<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;

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
            DB::transaction(function () use ($input) {
                $genre = Genre::firstOrCreate(['name' => $input['genre']]);

                unset($input['genre']);

                Movie::create([...$input, 'genre_id' => $genre->id]);
            });
        } catch (\Exception $e) {
            return abort(500);

            // return back()->withInput()->with('error', 'エラーが発生しました。');
        }

        return redirect(route('admin.movies'));
    }

    public function show(Int $id)
    {
        $movie = Movie::with('schedules')->findOrFail($id);

        return view('admin.movie.show', ['movie' => $movie]);
    }

    public function edit(Int $id)
    {
        $movie = Movie::with('genre')->findOrFail($id);

        return view('admin.movie.edit', ['movie' => $movie]);
    }

    public function update(UpdateMovieRequest $request, Int $id)
    {
        $input = $request->all();

        try {
            DB::transaction(function () use ($input, $id) {
                $movie = Movie::findOrFail($id);
                $genre = Genre::firstOrCreate(['name' => $input['genre']]);

                unset($input['genre']);

                $movie->update([...$input, 'genre_id' => $genre->id]);
            });

            return redirect(route('admin.movies'));
        } catch (\Exception $e) {
            return abort(500);

            // return back()->withInput()->with('error', 'エラーが発生しました。');
        }
    }

    public function destroy(Int $id)
    {
        try {
            Movie::findOrFail($id)->delete();

            return redirect(route('admin.movies'))->with('success', '削除が完了しました。');
        } catch (\Exception) {
            return abort(404);
        }
    }
}
