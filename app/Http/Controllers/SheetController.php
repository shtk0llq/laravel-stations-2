<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Schedule;
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

        // 現在のスケジュールのscreen_idを取得
        $currentScreenId = Schedule::findOrFail($schedule_id)->screen_id;

        // 予約済みのシートIDを取得する際に、同じscreen_idのものだけを対象にする
        $reservedSheetIds = Reservation::query()
            ->join('schedules', 'reservations.schedule_id', '=', 'schedules.id')
            ->where('schedules.screen_id', $currentScreenId)
            ->where('reservations.schedule_id', $schedule_id)
            ->where('reservations.date', $date)
            ->where('reservations.is_canceled', 0)
            ->pluck('reservations.sheet_id')
            ->toArray();

        for ($i = 0; $i < count($sheets); $i += 5) {
            $newSheets[] = $sheets->slice($i, 5)->map(function ($sheet) use ($reservedSheetIds) {
                $sheet->is_reserved = in_array($sheet->id, $reservedSheetIds);
                return $sheet;
            })->values();
        }

        return view('sheet.index', ['sheets' => $newSheets, 'movieId' => $movie_id, 'scheduleId' => $schedule_id]);
    }
}
