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

// footer TOPボタン スムーズスクロール機能
document.addEventListener('DOMContentLoaded', function () {
    const backToTop = document.querySelector('.back_to_top');
    if (backToTop) {
        backToTop.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth' // スムーズスクロール
            });
        });
    }
});
