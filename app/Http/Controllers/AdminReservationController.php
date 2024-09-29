<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminReservationRequest;
use App\Http\Requests\UpdateAdminReservationRequest;
use App\Models\Movie;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;

class AdminReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['schedule' => function ($query) {
            $query->where('end_time', '>', Carbon::now());
        }, 'schedule.movie', 'sheet'])->whereHas('schedule', function ($query) {
            $query->where('end_time', '>', Carbon::now());
        })->where('is_canceled', false)->get();

        return view('admin.reservation.index', ['reservations' => $reservations]);
    }

    public function create()
    {
        return view('admin.reservation.create');
    }

    public function store(CreateAdminReservationRequest $request)
    {
        $input = $request->all();

        try {
            // 日付が入力されていない時に今日の日付を入れる
            if (!isset($input['date'])) {
                $input['date'] = Carbon::now();
            }

            Movie::findOrFail($request['movie_id']);

            Reservation::create($input);
        } catch (\Exception $e) {
            return redirect(route('admin.reservations'))->with('error', 'エラーが発生しました。');
        }

        return redirect(route('admin.reservations'))->with('success', '予約が完了しました');
    }

    public function edit(Int $id)
    {
        $reservation = Reservation::with('schedule.movie')->findOrFail($id);

        return view('admin.reservation.edit', ['reservation' => $reservation]);
    }

    public function update(UpdateAdminReservationRequest $request, Int $id)
    {
        $input = $request->all();

        try {
            $reservation = Reservation::findOrFail($id);

            $reservation->update($input);
        } catch (\Exception $e) {
            return redirect(route('admin.reservations'))->with('error', 'エラーが発生しました。');
        }

        return redirect(route('admin.reservations'))->with('success', '更新が完了しました。');
    }

    public function destroy(Int $id)
    {
        try {
            $reservation = Reservation::findOrFail($id);

            $reservation->delete();
        } catch (ModelNotFoundException $e) {
            return abort(404);
        } catch (\Exception $e) {
            return redirect(route('admin.reservations'))->with('error', 'エラーが発生しました。');
        }

        return redirect(route('admin.reservations'))->with('success', '削除が完了しました。');
    }
}
