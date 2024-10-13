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



// キャラクターアニメーション（TOPの男の子）

document.addEventListener('DOMContentLoaded', () => {
    const pochi = document.querySelector('.boy__pochi'); // クラス名で要素を取得
    const programmer = document.querySelector('.boy__programmer'); // boy_programmerの要素を取得

    setTimeout(() => {
        pochi.style.opacity = 1; // 4秒後にポチを表示
        let count = 0;
        const interval = setInterval(() => {
            const randomX = (Math.random() * 20 - 50) + 'px'; //
            const randomY = (Math.random() * 40 - 50) + 'px'; //
            const programmerRect = programmer.getBoundingClientRect(); // boy_programmerの位置を取得

            // boy_programmerの近くにポジションを設定
            pochi.style.left = `${programmerRect.right + parseFloat(randomX)}px`; // 右側に移動
            pochi.style.top = `${programmerRect.top + parseFloat(randomY)}px`; //

            // ポチのイラストを取得
            const pochiIllustration = document.querySelector('.pochi-illustration');
            // スタイルを変更して表示位置を上に
            pochiIllustration.style.position = 'absolute';
            pochiIllustration.style.top = '200px';

            if (++count >= 6) {
                clearInterval(interval); // 6回移動したら停止
                setTimeout(() => {
                    pochi.style.opacity = 0; // 最後にポチを消す
                }, 500); // 0.5秒後に消す
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

// フッターのフェードイン
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
