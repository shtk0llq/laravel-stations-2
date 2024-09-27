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

  <table>
    <thead>
      <tr>
        <th colspan="5">スクリーン</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($sheets as $rows)
        <tr>
          @foreach ($rows as $item)
            <td>
              <a
                @if (!$item->is_reserved) href="{{ route('movies.schedules.reservations.create', [
                    'movie_id' => $movieId,
                    'schedule_id' => $scheduleId,
                    'date' => request()->query('date'),
                    'sheetId' => $item->id,
                ]) }}" @endif>
                {{ $item->row }}-{{ $item->column }}
              </a>
            </td>
          @endforeach
        </tr>
      @endforeach
    </tbody>
</body>

</html>
