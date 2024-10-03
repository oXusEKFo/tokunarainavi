document.getElementById('policy').addEventListener('change', function() {
var submitBtn = document.getElementById('submitBtn');

  // チェックされているかどうかで送信ボタンを有効化/無効化
if (this.checked) {
    submitBtn.disabled = false;
} else {
    submitBtn.disabled = true;
}
});
