<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // 作品データの変数名は、 view に渡している変数名と合わせて適宜変更してください
        // $movies = DB::table('movies')->whereRaw("title = '{$request->input('keyword')}'")->paginate();

        // $movies = DB::table('movies')->whereRaw("title = ?", [$request->input('keyword')])->paginate();

        // dd($movies);

        return view('movie.index', ['movies' => $movies]);
    }

    public function show(Int $id)
    {
        $movie = Movie::findOrFail($id);
        $schedules = Schedule::query()
            ->where('movie_id', $id)
            ->orderBy('start_time', 'asc')
            ->get();

        return view('movie.show', ['movie' => $movie, 'schedules' => $schedules]);
    }
}
