<?php

namespace App\Http\Controllers;

use App\Models\Sheet;
use Illuminate\Http\Request;

class SheetController extends Controller
{
    public function list()
    {
        $sheets = Sheet::all();

        for ($i = 0; $i < count($sheets); $i += 5) {
            $newSheets[] = $sheets->slice($i, 5)->values();
        }

        return view('sheet.list', ['sheets' => $newSheets]);
    }

    public function index(Request $request, Int $movie_id, Int $schedule_id)
    {
        // 日付のバリデーション
        $date = $request->query('date');
        if (!$date) {
            return abort(400);
        }

        $sheets = Sheet::all();

        for ($i = 0; $i < count($sheets); $i += 5) {
            $newSheets[] = $sheets->slice($i, 5)->values();
        }

        return view('sheet.index', ['sheets' => $newSheets, 'movieId' => $movie_id, 'scheduleId' => $schedule_id]);
    }
}
