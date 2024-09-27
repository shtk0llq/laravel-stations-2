<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel Stations</title>
</head>

<body>
  @if (session('error'))
    <div>
      {{ session('error') }}
    </div>
  @endif

  <form method="POST" action="{{ route('admin.schedules.update', ['id' => $schedule->id]) }}">
    @csrf
    @method('PATCH')

    <input type="text" name="movie_id" value="{{ $schedule->movie->id }}" hidden />

    <div>
      <label for="start_time_date">開始日付</label>
      <input type="date" name="start_time_date" id="start_time_date" value="{{ old('start_time_date', $schedule->start_time->format('Y-m-d')) }}" />
      @error('start_time_date')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="end_time_date">終了日付</label>
      <input type="date" name="end_time_date" id="end_time_date" value="{{ old('end_time_date', $schedule->end_time->format('Y-m-d')) }}" />
      @error('end_time_date')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="start_time_time">開始時間</label>
      <input type="time" name="start_time_time" id="start_time_time" value="{{ old('start_time_time', $schedule->start_time->format('H:i')) }}" />
      @error('start_time_time')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="end_time_time">終了時間</label>
      <input type="time" name="end_time_time" id="end_time_time" value="{{ old('end_time_time', $schedule->end_time->format('H:i')) }}" />
      @error('end_time_time')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <button type="submit">更新</button>
    </div>
  </form>
</body>

</html>
