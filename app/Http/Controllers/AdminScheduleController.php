<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use Illuminate\Support\Carbon;

class AdminScheduleController extends Controller
{
    public function create(Int $id)
    {
        return view('admin.schedule.create', ['id' => $id]);
    }

    public function store(CreateScheduleRequest $request)
    {
        $input = $request->all();

        try {
            $startTime = Carbon::createFromFormat(
                'Y-m-d H:i',
                $input['start_time_date'] . ' ' . $input['start_time_time']
            );

            $endTime = Carbon::createFromFormat(
                'Y-m-d H:i',
                $input['end_time_date'] . ' ' . $input['end_time_time']
            );

            Schedule::create([
                'movie_id' => $input['movie_id'],
                'start_time' => $startTime,
                'end_time' => $endTime,
                'screen_id' => $input['screen_id']
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'エラーが発生しました。');
        }

        return redirect(route('admin.movies.show', ['id' => $input['movie_id']]));
    }

    public function edit(Int $id)
    {
        $schedule = Schedule::with('movie')->findOrFail($id);

        return view('admin.schedule.edit', ['schedule' => $schedule]);
    }

    public function update(UpdateScheduleRequest $request, Int $id)
    {
        $input = $request->all();

        try {
            $schedule = Schedule::findOrFail($id);

            $startTime = Carbon::createFromFormat(
                'Y-m-d H:i',
                $input['start_time_date'] . ' ' . $input['start_time_time']
            );

            $endTime = Carbon::createFromFormat(
                'Y-m-d H:i',
                $input['end_time_date'] . ' ' . $input['end_time_time']
            );

            $schedule->update([
                'start_time' => $startTime,
                'end_time' => $endTime,
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'エラーが発生しました。');
        }

        return redirect(route('admin.movies.show', ['id' => $schedule->movie_id]));
    }

    public function destroy(Int $id)
    {
        try {
            $schedule = Schedule::findOrFail($id);
            $movieId = $schedule->movie_id;

            $schedule->delete();
            return redirect(route('admin.movies.show', ['id' => $movieId]));
        } catch (\Exception $e) {
            return abort(404);

            // return back()->with('error', 'エラーが発生しました。');
        }

        return redirect(route('admin.movies.show', ['id' => $movieId]));
    }
}
