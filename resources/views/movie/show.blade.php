<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel Stations</title>
</head>

<body>
  @if (session('success'))
    <div>
      {{ session('success') }}
    </div>
  @endif

  <div>
    <p>{{ $movie->title }}</p>
    <img src="{{ $movie->image_url }}" alt="Movie Image" />
    <p>{{ $movie->published_year }}</p>
    <p>{{ $movie->is_showing ? '上映中' : '上映予定' }}</p>
    <p>{{ $movie->description }}</p>
  </div>

  @foreach ($schedules as $schedule)
    <div>
      <p>{{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }}</p>
      <a
        href="{{ route('movies.schedules.sheets', [
            'movie_id' => $schedule->movie_id,
            'schedule_id' => $schedule->id,
            'date' => date('Y-m-d'),
        ]) }}">
        <button>
          座席を予約する
        </button>
      </a>
    </div>
  @endforeach
</body>

</html>
