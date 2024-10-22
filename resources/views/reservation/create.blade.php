<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel Stations</title>
</head>

<body>
  <form method="POST" action="{{ route('reservations.store') }}">
    @csrf

    <input type="text" name="user_id" value="{{ $user_id }}" hidden />
    <input type="text" name="schedule_id" value="{{ $scheduleId }}" hidden />
    <input type="text" name="sheet_id" value="{{ request()->query('sheetId') }}" hidden />
    <input type="date" name="date" value="{{ request()->query('date') }}" hidden />

    <p>映画ID {{ $movieId }}</p>
    <p>スケジュールID {{ $scheduleId }}</p>
    <p>シートID {{ request()->query('sheetId') }}</p>
    <p>日付 {{ request()->query('date') }}</p>

    <div>
      <label for="name">予約者名</label>
      <input type="text" id="name" value="{{ old('name', $name) }}" disabled />
      @error('name')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="email">メールアドレス</label>
      <input type="email" id="email" value="{{ old('email', $email) }}" disabled />
      @error('email')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <button type="submit">予約する</button>
    </div>
  </form>
</body>

</html>
