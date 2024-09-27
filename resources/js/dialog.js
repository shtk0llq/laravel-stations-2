window.deleteConfirm = function (button) {
  if (confirm('削除してもよろしいですか？')) {
    button.closest('form').submit();
  }
}
