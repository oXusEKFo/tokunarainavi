"use strict";

jQuery(function ($) {
  $(function () {
    // メイン画像のオプション
    $(".slider").slick({
      autoplay: false, // 自動再生OFF
      arrows: false, // 左右矢印非表示
      asNavFor: ".thumbnail", // サムネイルと同期
    });

    // サムネイルのオプション
    $(".thumbnail").slick({
      slidesToShow: 4, // サムネイルの表示数
      asNavFor: ".slider", // メイン画像と同期
      focusOnSelect: true, // サムネイルクリックを有効化
    });

    // サムネイルホバー時にスタイルを変更して視覚的にフィードバック
    $(".thumbnail .wrap__thumbnailImg").hover(
      function () {
        $(this).css("border", "2px solid #ff0000"); // ホバー時にボーダーを赤くする
      },
      function () {
        $(this).css("border", "none"); // ホバーが外れたら元に戻す
      }
    );
  });
});





document.addEventListener('DOMContentLoaded', function() {
    const cancelButton = document.querySelector('.cancel-reply-btn');
    const commentForm = document.getElementById('commentform');

    if (cancelButton) {
        cancelButton.addEventListener('click', function(event) {
            event.preventDefault(); // デフォルトの動作を防止
            commentForm.reset(); // フォームをリセット
            // 返信キャンセル後の処理（例：ページの状態をリセットする）
            // ここに必要な処理を追加
        });
    }
});
