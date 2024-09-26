<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel Stations</title>
</head>

<body>
  <form method="GET" action="{{ route('movies') }}">
    <div>
      <label>キーワード</label>
      <input type="text" name="keyword" value="{{ request()->query('keyword') }}" />
    </div>

    <div>
      <label for="all">すべて</label>
      <input type="radio" id="all" name="is_showing" value="" {{ request()->query('is_showing') == '' ? 'checked' : '' }} />

      <label for="published">公開中</label>
      <input type="radio" id="published" name="is_showing" value="1" {{ request()->query('is_showing') == '1' ? 'checked' : '' }} />

      <label for="scheduled">公開予定</label>
      <input type="radio" id="scheduled" name="is_showing" value="0" {{ request()->query('is_showing') == '0' ? 'checked' : '' }}  />
    </div>

    <div>
      <button type="submit">検索</button>
    </div>
  </form>

  @foreach ($movies as $movie)
    <div>
      <p>
        <a href="{{ route('movies.show', ['id' => $movie->id]) }}">
          {{ $movie->title }}
        </a>
      </p>
      <img src="{{ $movie->image_url }}" alt="Movie Image" />
    </div>
  @endforeach

  {{ $movies->links() }}
</body>

</html>
