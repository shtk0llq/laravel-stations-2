<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel Stations</title>
</head>

<body>
  @foreach (['success', 'error'] as $status)
    @if (session($status))
      <div>
        {{ session($status) }}
      </div>
    @endif
  @endforeach

  <div>
    <a href="{{ route('admin.reservations.create') }}">
      <button>作成</button>
    </a>
  </div>
  @foreach ($reservations as $reservation)
    <div>
      <p>{{ $reservation->schedule->movie->title }}</p>
      <p>{{ strtoupper($reservation->sheet->row . $reservation->sheet->column) }}</p>
      <p>{{ $reservation->schedule->start_time }} - {{ $reservation->schedule->end_time }}</p>
      <p>{{ $reservation->name }}</p>
      <p>{{ $reservation->email }}</p>
      <a href="{{ route('admin.reservations.edit', ['id' => $reservation->id]) }}">
        <button>編集</button>
      </a>

      <form method="POST" action="{{ route('admin.reservations.destroy', ['id' => $reservation->id]) }}">
        @csrf
        @method('DELETE')

        <button type="button" onclick="deleteConfirm(this)">削除</button>
      </form>
    </div>
  @endforeach

  <script src="{{ asset('/js/app.js') }}"></script>
</body>

</html>
