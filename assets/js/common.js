"use strict";

jQuery(function ($) {
    // ハンバーガーメニュー
    $('.menu').on('click', function () {
        $('.menu__line').toggleClass('active');
        $('.gnav').fadeToggle();
    });



    // Enterキーで検索ボタンクリック
    const window__search = document.getElementById("window__search");

    window__search.addEventListener("keydown", (e) => {
        if (e.key === "Enter") {
            const btn__search = document.getElementById("btn__search");
            btn__search.dispatchEvent(new PointerEvent("click"));

        e.preventDefault();  // Enterキー入力の伝搬防止
    }
    return false;
    });



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
});
