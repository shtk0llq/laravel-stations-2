<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Models\Reservation;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create(Request $request, Int $movie_id, Int $schedule_id)
    {
        if (empty($request->query('date')) || empty($request->query('sheetId'))) {
            return abort(400);
        }

        return view('reservation.create', ['movieId' => $movie_id, 'scheduleId' => $schedule_id]);
    }

    public function store(CreateReservationRequest $request)
    {
        $input = $request->all();

        try {
            $movieId = Schedule::findOrFail($input['schedule_id'])->movie_id;

            Reservation::create($input);
        } catch (\Exception $e) {
            return redirect(route('movies.schedules.sheets', ['movie_id' => $movieId, 'schedule_id' => $request->input('schedule_id'), 'date' => $request->input('date')]))->with('error', 'その座席はすでに予約済みです');

            // return back()->withInput()->with('error', 'エラーが発生しました。');
        }

        return redirect(route('movies.show', ['id' => $movieId]))->with('success', '予約が完了しました');
    }
}
