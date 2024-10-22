<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Models\Reservation;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function create(Request $request, Int $movie_id, Int $schedule_id)
    {
        $user = Auth::user();

        if (empty($request->query('date')) || empty($request->query('sheetId'))) {
            return abort(400);
        }

        // 日付+時間で入ってきた時に日付のみに変換する
        $requestDate = Carbon::parse($request->query('date'))->toDateString();

        $isReserved = Reservation::where('schedule_id', $schedule_id)
            ->where('sheet_id', $request->query('sheetId'))
            ->whereDate("date", $requestDate)
            ->exists();

        if ($isReserved) {
            return abort(400);
        }

        return view('reservation.create', ['movieId' => $movie_id, 'scheduleId' => $schedule_id, 'user_id' => $user->id, 'name' => $user->name, 'email' => $user->email]);
    }

    public function store(CreateReservationRequest $request)
    {
        $input = $request->all();

        try {
            $movieId = Schedule::findOrFail($input['schedule_id'])->movie_id;

            Reservation::create($input);
        } catch (\Exception $e) {
            dd($e);
            return redirect(route('movies.schedules.sheets', ['movie_id' => $movieId, 'schedule_id' => $request->input('schedule_id'), 'date' => $request->input('date')]))->with('error', 'その座席はすでに予約済みです');

            // return back()->withInput()->with('error', 'エラーが発生しました。');
        }

        return redirect(route('movies.show', ['id' => $movieId]))->with('success', '予約が完了しました');
    }
}
