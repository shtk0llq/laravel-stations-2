<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel Stations</title>
</head>

<body>
  <div>
    <p>{{ $movie->title }}</p>
    <img src="{{ $movie->image_url }}" alt="Movie Image" />
    <p>{{ $movie->published_year }}</p>
    <p>{{ $movie->description }}</p>
    <p>{{ $movie->is_showing ? '上映中' : '上映予定' }}</p>
  </div>

  <a href="{{ route('admin.schedules.create', ['id' => $movie->id]) }}">スケジュール作成</a>

  @foreach ($movie->schedules as $schedule)
    <div>
      <p>{{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
      <a href="{{ route('admin.schedules.edit', ['id' => $schedule->id]) }}">編集</a>

      <form method="POST" action="{{ route('admin.schedules.destroy', ['id' => $schedule->id]) }}">
        @csrf
        @method('DELETE')

        <button type="button" onclick="deleteConfirm(this)">削除</button>
      </form>
    </div>
  @endforeach

  <script src="{{ asset('/js/app.js') }}"></script>
</body>

</html>
