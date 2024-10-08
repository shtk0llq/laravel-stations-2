<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel Station</title>
</head>

<body>
  @if (session('error'))
    <div class="p-4 bg-green-100">
      {{ session('error') }}
    </div>
  @endif

  <form method="POST" action="{{ route('admin.movies.update', ['id' => $movie->id]) }}">
    @csrf
    @method('PATCH')

    <div>
      <label for="title">映画タイトル</label>
      <input type="text" name="title" id="title" value="{{ old('title', $movie->title) }}" />
      @error('title')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="genre">ジャンル</label>
      <input type="text" name="genre" id="genre" value="{{ old('genre', $movie->genre->name) }}" />
      @error('genre')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="image_url">画像URL</label>
      <input type="text" name="image_url" id="image_url" value="{{ old('image_url', $movie->image_url) }}" />
      @error('image_url')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="published_year">公開年</label>
      <input type="number" name="published_year" id="published_year" value="{{ old('published_year', $movie->published_year) }}" />
      @error('published_year')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="is_showing">公開中かどうか</label>
      <input type="hidden" name="is_showing" value="0">
      <input type="checkbox" name="is_showing" id="is_showing" value="1" {{ old('is_showing', $movie->is_showing) ? 'checked' : '' }} />
      @error('is_showing')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="description">概要</label>
      <textarea id="description" name="description" rows="5">{{ old('description', $movie->description) }}</textarea>
      @error('description')
        <span>{{ $message }}</span>
      @enderror
    </div>

    <div>
      <button type="submit">登録</button>
    </div>
  </form>
</body>

</html>
