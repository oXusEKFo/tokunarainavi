"use strict";

document.addEventListener('DOMContentLoaded', function() {
    var checkbox = document.querySelector('.check-policy');
    var submitButton = document.getElementById('styled-button');
    var hover = document.querySelector('.styled-button');

    // 初期状態では送信ボタンを無効化
    submitButton.disabled = true;

    // チェックボックスが変更されたときのイベントリスナー
    checkbox.addEventListener('change', function() {
        if (this.checked) {
            submitButton.disabled = false; // チェックされたら送信ボタンを有効化
            // 確認ボタンのhover時のボタンの色を変える
            hover.addEventListener('mouseover', () => {
                hover.style.backgroundColor = '#ed6d1f';  // 背景色を変える
            });
             hover.addEventListener('mouseout', () => {
             hover.style.backgroundColor = '#ccc';  // 元の背景色に戻す
            });
        } else {
            submitButton.disabled = true; // チェックが外れたら送信ボタンを無効化
        }
    });
});
