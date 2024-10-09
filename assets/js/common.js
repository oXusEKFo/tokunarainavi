"use strict";

jQuery(function ($) {
    // ハンバーガーメニュー
    $('.menu').on('click', function () {
        $('.menu__line').toggleClass('active');
        $('.gnav').fadeToggle();
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

/**
 *
 *検索ー 選び から
 */
function showSubMenu(button) {
    const subMenus = document.querySelectorAll('.sub-menu');
    const buttons = document.querySelectorAll('.option_button_search');
    subMenus.forEach(menu => {
        menu.style.display = 'none';
    });
    const targetId = button.getAttribute('data-target');
    const targetMenu = document.getElementById(targetId);
    if (targetMenu) {
        targetMenu.style.display = 'block';
    }
    buttons.forEach(btn => {
        if (btn !== button) {
            btn.style.display = 'inline-block';
        } else {
            btn.style.display = 'none';
        }
    });
}
