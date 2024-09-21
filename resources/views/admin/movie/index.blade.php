<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel Stations</title>
</head>

<body>
  <table>
    <thead>
      <tr>
        <th>映画タイトル</th>
        <th>画像URL</th>
        <th>公開年</th>
        <th>上映中かどうか</th>
        <th>概要</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($movies as $movie)
        <tr>
          <td>{{ $movie->title }}</td>
          <td>{{ $movie->image_url }}</td>
          <td>{{ $movie->published_year }}</td>
          <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
          <td>{{ $movie->description }}</td>
          <td>
            <a href="{{ route('admin.movies.edit', ['id' => $movie->id]) }}">
              <button>編集</button>
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
</body>

</html>
