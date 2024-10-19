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
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <?php
    $description = "";
    $og_title = "";
    $og_type = "article";
    $og_url = get_permalink();

    if (is_home()) {
        $description = "徳島の子ども向け習いごと情報を一括検索できるサイトです。学びの輪を広げ、未来へつなげるお手伝いをします。音楽・スポーツ・アートなど多様な学びの場や体験型の習いごとを子どもたちとその保護者に紹介します。";
        $og_type = "website";
        $og_url = home_url();
    } elseif (is_page('favor')) {
        $description = "お気に入り登録した教室の一覧です。";
        $og_title = "|お気に入りページ";
    } elseif (is_page('contact')) {
        $description = "とくしま習いごとナビのお問い合わせのページです。";
        $og_title = "|入力フォーム";
    } elseif (is_page('confirm')) {
        $description = "内容をご確認の上、問題がなければ送信ボタンを押してください。修正が必要な場合は、戻るボタンで編集が可能です。";
        $og_title = "|送信内容確認";
    } elseif (is_page('thanks')) {
        $description = "お問い合わせ、誠にありがとうございました。送信が通常に完了しました。";
        $og_title = "|送信完了";
    } elseif (is_search()) {
        $description = "徳島県内の習いごと情報を、エリア、年齢、ジャンルから検索します。";
        $og_title = "|SEARCH";
    } elseif (is_singular('classroom')) {
        $description = "習いごと教室の詳細についてです。";
        $og_title = "|結果詳細";
    } elseif (is_page('fushion')) {
        $description = "2024年秋に、 徳島県内の保護者の皆様に行ったアンケート結果です。";
        $og_title = "|習い事事情ページ";
    } elseif (is_post_type_archive('column') || is_tax('column_type') || is_singular('column')) {
        $description = "習いごと教室の先生のインタビューを紹介します。";
        if (is_singular('column')) {
            $og_title = "|COLUMN詳細";
        } else {
            $og_title = "|COLUMN一覧";
        }
    } elseif (is_page('infos') || is_category() || is_single()) {
        $description = "とくしま習いごとナビのお知らせや、習いごと教室のイベント情報等を掲載します。";
        if (is_single()) {
            $og_title = "|NEWS詳細";
        } else {
            $og_title = "|NEWS一覧";
        }
    } elseif (is_page('about')) {
        $description = "このサイトは国の求職者支援制度に基づく「WEBプログラマー養成科」第17期生によって2024年秋に制作された、徳島県内の子ども向け習いごと教室を検索できるウェブサイトです。";
        $og_title = "|このサイトについて";
    } elseif (is_page('service')) {
        $description = "とくしま習いごとナビの利用規約のページです。";
        $og_title = "|利用規約";
    } elseif (is_page('praivacy')) {
        $description = "とくしま習いごとナビのプライバシーポリシーのページです。";
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
        <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/ogpimage.png">
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
                            <a href="<?php echo home_url('/contact') ?>">&nbsp;&nbsp;お問い合わせ
                            </a>
                        </li>
                        <li>
                            <div class="wrap__sns-logo">
                                <a href="https://www.instagram.com/tokunavi17" target="_blank">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                                <a href="https://x.com/tokunavi17" target="_blank">
                                    <i class=" fa-brands fa-x-twitter"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <div class="wrap__gnav-chara">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/rabbit.png" alt="とくしま習いごとナビ">
                    </div>
                </div>
            </nav>

            <div class="logo__header">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/rogo.png" alt="とくしま習いごとナビ">
                </a>
            </div>

            <div class="wrap__navi">
                <a class="menu">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hg_menu.png" alt="hg_menu" class="btn__menu">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hg_close.png" alt="close-btn" class="btn__close">
                </a>
            </div>
        </div>
    </header>
