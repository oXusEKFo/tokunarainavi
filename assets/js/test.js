// 検索する ポップアップウィンドウ
function openDialog(title, url) {
    // タイトルの設定
    document.getElementById('dialogTitle').innerText = title;

    // 対応するページの内容をiframeにロード
    document.getElementById('dialogFrame').src = url;

    // モーダルウィンドウを表示
    document.getElementById('dialogOverlay').style.display = 'flex';
}

// ダイアログを閉じる
function closeDialog() {
    // モーダルウィンドウを隠す
    document.getElementById('dialogOverlay').style.display = 'none';

    // iframeの内容をクリア
    document.getElementById('dialogFrame').src = '';
}
