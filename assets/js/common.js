"use strict";

// header ハンバーガー
function toggleMenu() {
    const menu = document.getElementById("menu");
    const menuIcon = document.getElementById("menuIcon");

    // メニューが開いているかどうかを確認し、アイコンを切り替え
    if (menu.classList.contains("active")) {
        menu.classList.remove("active");
        menuIcon.innerHTML = "&#9776;";  // ハンバーガーアイコンに戻す
    } else {
        menu.classList.add("active");
        menuIcon.innerHTML = "X";  // クローズアイコンに変える
    }
}


// Topへ戻るボタン
$(function () {
  let top = $(".back-to-top");
  top.hide();
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      top.fadeIn();
    } else {
      top.fadeOut();
    }
  });
  top.click(function () {
    $("body, html").animate({ scrollTop: 0 }, 200, "swing");
    return false;
  });
});
