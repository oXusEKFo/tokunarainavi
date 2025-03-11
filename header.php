<!-- 福島　2024/10/12　追加　消さないでください。開始 -->
<?php
// 開発モードで公開の時は、管理画面へのログインが必要です。
if (!is_user_logged_in() && IS_DEV == true) {
    header('Location:' . home_url('/') . 'wp-admin');
    exit;
}
?>
<!-- 福島　2024/10/12　追加　消さないでください。 終了-->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes">

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PK4HP84D');
    </script>
    <!-- End Google Tag Manager -->

    <?php
    $description = "";
    $og_title = "";
    $og_type = "article";
    $og_url = get_permalink();

    if (is_home()) {
        $description = "徳島の子ども向け習い事情報を一括検索できるサイトです。学びの輪を広げ、未来へつなげるお手伝いをします。音楽・スポーツ・アートなど多様な学びの場や体験型の習いごとを子どもたちとその保護者に紹介します。";
        $og_type = "website";
        $og_url = home_url();
    } elseif (is_page('favor')) {
        $description = "お気に入り登録した教室の一覧です。";
        $og_title = "|お気に入り";
    } elseif (is_page('contact')) {
        $description = "お問い合わせと掲載申し込みのページです。";
        $og_title = "|お問い合わせ、掲載申し込み";
    } elseif (is_page('confirm')) {
        $description = "内容をご確認の上、問題がなければ送信ボタンを押してください。修正が必要な場合は、戻るボタンで編集が可能です。";
        $og_title = "|送信内容確認";
    } elseif (is_page('thanks')) {
        $description = "お問い合わせ、誠にありがとうございました。送信が通常に完了しました。";
        $og_title = "|送信完了";
    } elseif (is_search()) {
        $description = "徳島県内の子供向け習い事を、エリア、年齢、ジャンルなどから検索できます。";
        $og_title = "|習い事検索";
    } elseif (is_singular('classroom')) {
        $description = "習い事教室の詳細です。";
        $og_title = "|習い事教室詳細";
    } elseif (is_page('fushion')) {
        $description = "徳島の習い事事情についてのアンケート結果です。";
        $og_title = "|徳島の習い事事情（アンケート結果）";
    } elseif (is_post_type_archive('column') || is_tax('column_type') || is_singular('column')) {
        $description = "習い事教室へのインタビューや体験レビューです。";
        if (is_singular('column')) {
            $og_title = "|コラム詳細";
        } else {
            $og_title = "|コラム一覧";
        }
    } elseif (is_page('infos') || is_category() || is_single()) {
        $description = "お知らせ、更新情報、イベント情報です。";
        if (is_single()) {
            $og_title = "|ニュース詳細";
        } else {
            $og_title = "|ニュース一覧";
        }
    } elseif (is_page('about')) {
        $description = "とくしま習いごとナビの説明です。";
        $og_title = "|徳島習いごとナビとは？";
    } elseif (is_page('service')) {
        $description = "とくしま習いごとナビの利用規約です。";
        $og_title = "|利用規約";
    } elseif (is_page('praivacy')) {
        $description = "とくしま習いごとナビのプライバシーポリシーです。";
        $og_title = "|プライバシーポリシー";
    } else {
        $description = "申し訳ありません。お探しのページが見つかりませんでした。URLをもう一度確認するか、ホームページに戻って他のコンテンツをご覧ください。";
        $og_type = "noindex";
    }
    ?>
    <?php if ($og_type != 'noindex'): ?>
        <meta name="description" content="<?= $description ?>">
        <meta property="og:title" content="<?php echo "とくしま習いごとナビ" . $og_title ?>">
        <meta property="og:type" content="<?= $og_type ?>">
        <meta property="og:url" content="<?= $og_url ?>">
        <meta property="og:image" content="https://tokunarainavi.com/wp-content/themes/tokunarainavi/assets/images/OGPimage.png">
        <meta property="og:site_name" content="とくしま習いごとナビ">
        <meta property="og:description" content="<?= $description ?>">
        <meta name="twitter:card" content="summary_large_image">
    <?php else: ?>
        <meta name="description" content="<?= $description ?>">
        <meta name="robots" content="noindex">
    <?php endif; ?>

    <?php wp_head(); ?>
    <!-- 必ず書いてください-->
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PK4HP84D"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <header>
        <div class="inner__header">
            <nav class="gnav">
                <div class="gnav__wrap">
                    <ul class="gnav__menu">
                        <li class="gnav__menu__item">
                            <a href="<?php echo home_url(); ?>/?s=">
                                &nbsp;&nbsp;条件検索
                            </a>
                        </li>
                        <li class="gnav__menu__item">
                            <a href="<?php echo home_url('/fushion'); ?>">
                                &nbsp;&nbsp;徳島の習いごと事情
                            </a>
                        </li>
                        <li class="gnav__menu__item">
                            <a href="<?php echo home_url('/column'); ?>">
                                &nbsp;&nbsp;コラム
                            </a>
                        </li>
                        <li class="gnav__menu__item">
                            <a href="<?php echo home_url('/infos');  ?>">&nbsp;&nbsp;新着情報
                            </a>
                        </li>
                        <li class="gnav__menu__item">
                            <a href="<?php echo home_url('/favor') ?>">&nbsp;&nbsp;お気に入りリスト
                            </a>
                        </li>
                        <li class="gnav__menu__item">
                            <a href="<?php echo home_url('/contact') ?>">&nbsp;&nbsp;お問い合わせ・掲載申し込み
                            </a>
                        </li>
                        <li>
                            <div class="wrap__sns-logo">
                                <a href="https://www.instagram.com/tokunavi17" target="_blank">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                                <!-- <a href="https://x.com/tokunavi17" target="_blank">
                                    <i class=" fa-brands fa-x-twitter"></i>
                                </a> -->
                            </div>
                            <div class="wrap__gnav-chara">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/rabbit.png" alt="うさぎ">
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="logo__header">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/rogo.png" alt="とくしま習いごとナビ">
                </a>
            </div>

            <div class="wrap__navi">
                <div class="menu">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hg_menu.png" alt="hg_menu" class="btn__menu">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hg_close.png" alt="close-btn" class="btn__close">
                </div>
            </div>
        </div>
    </header>
