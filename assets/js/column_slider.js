"use strict";

jQuery(function ($) {
  $(function () {
    // メイン画像のオプション
    $(".auto-slider").slick({
      slidesToShow: 1, // 表示するスライド数
      slidesToScroll: 1, // スクロールするスライド数
      centerMode: true, // 中央揃え
      variableWidth: true, // 幅の自動調整
      autoplay: true, // 自動再生ON/OFF
      autoplaySpeed: 3000, // 自動再生スピード[msec]
      infinite: true, // ループ再生ON/OFF
      cssEase: "linear", // イージングモード
      pauseOnFocus: true, // フォーカスで停止ON/OFF
      pauseOnHover: true, // ホバーで停止ON/OFF
      arrows: false, // スライド切り替え矢印 非表示
      swipeToSlide: true, // スワイプ切り替えON/OFF

      responsive: [
        {
          breakpoint: 780, // 横幅がこのpx未満に適用
          settings: {
            slidesToShow: 1, // スライド数
          },
        },
        {
          breakpoint: 1170, // 横幅がこのpx未満に適用
          settings: {
            slidesToShow: 2, // スライド数
            // centerMode: false, // 中央揃え
          },
        },
      ],
    });
  });
});
