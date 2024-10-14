"use strict";

jQuery(function ($) {
    // ハンバーガーメニュー
    $('.menu').on('click', function () {
        $('.btn__menu, .btn__close').toggleClass('active');
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



// キャラクターアニメーション（TOPの男の子）

document.addEventListener('DOMContentLoaded', () => {
    const pochi = document.querySelector('.boy__pochi'); // クラス名で要素を取得
    const programmer = document.querySelector('.boy__programmer'); // boy_programmerの要素を取得

    if (!pochi || !programmer) {
        console.error('要素が見つかりません。クラス名を確認してください。');
        return;
    }

    // 親要素を相対位置に設定
    const parent = programmer.parentElement;
    parent.style.position = 'relative';

    // pochiをprogrammerの右上に配置
    pochi.style.position = 'absolute';
    pochi.style.left = `${programmer.offsetLeft + programmer.offsetWidth}px`; // 右側に配置
    pochi.style.top = `${programmer.offsetTop}px`; // 上部に配置

    setTimeout(() => {
        let count = 0;
        const interval = setInterval(() => {
            if (count % 2 === 0) {
                pochi.style.opacity = 1; // ポチを表示
            } else {
                pochi.style.opacity = 0; // ポチを非表示
            }

            if (++count >= 12) { // 6回表示と非表示を繰り返す
                clearInterval(interval); // 6回表示と非表示を繰り返したら停止
            }
        }, 500); // 0.5秒ごとに位置を変更
    }, 4000); // 4秒後に開始
});



//main box fadeIn ふわっと表示させる
//class="box fadeIn"を追加するだけでOK

$(window).on("scroll load", function () {
    // ページロード時、またはスクロールされた時
    var scroll = $(this).scrollTop(); // 現在のスクロール量を測定
    var windowHeight = $(window).height(); // ウィンドウの高さを測定
    $(".fadeIn").each(function () {
        var cntPos = $(this).offset().top; // 対象の要素の上からの距離を測定
        if (scroll > cntPos - windowHeight + windowHeight / 3) {
            // 要素がある位置までスクロールされていたら
            $(this).addClass("active"); // 「active」のクラスを付与
        }
    });
});

// トップboy＆フッターのフェードイン
document.addEventListener('DOMContentLoaded', function() {
    const fadeInElements = document.querySelectorAll('.fade__in');

    function checkVisibility() {
        fadeInElements.forEach(element => {
            const rect = element.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                element.classList.add('visible');
            }
        });
    }

    window.addEventListener('scroll', checkVisibility);
    checkVisibility(); // 初期チェック
});
