<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel Stations</title>
</head>

<body>
  <form method="POST" action="{{ route('admin.reservations.update', ['id' => $reservation->id]) }}">
    @csrf
    @method('PATCH')

    <div>
      <label for="movie_id">映画ID</label>
      <input type="text" name="movie_id" id="movie_id" value="{{ old('movie_id', $reservation->schedule->movie->id) }}" />
      @error('movie_id')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="schedule_id">スケジュールID</label>
      <input type="text" name="schedule_id" id="schedule_id" value="{{ old('schedule_id', $reservation->schedule_id) }}" />
      @error('schedule_id')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="sheet_id">シートID</label>
      <input type="text" name="sheet_id" id="sheet_id" value="{{ old('sheet_id', $reservation->sheet_id) }}" />
      @error('sheet_id')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="date">日付</label>
      <input type="date" name="date" id="date" value="{{ old('date', $reservation->date) }}" />
      @error('date')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="name">予約者名</label>
      <input type="text" name="name" id="name" value="{{ old('name', $reservation->name) }}" />
      @error('name')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="email">メールアドレス</label>
      <input type="email" name="email" id="email" value="{{ old('email', $reservation->email) }}" />
      @error('email')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <button type="submit">更新する</button>
    </div>
  </form>
</body>

</html>
