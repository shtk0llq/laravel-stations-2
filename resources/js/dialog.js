window.deleteMovie = function (button) {
  if (confirm('削除してもよろしいですか？')) {
    button.closest('form').submit();
  }
}
