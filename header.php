<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <?php wp_head(); ?> <!-- 必ず書いてください-->


</head>

<body <?php body_class(); ?>>


    <?php wp_body_open(); ?>
    <!-- wp_body_open アクションフックを呼び出し、テーマテンプレートの<body> タグの直後にカスタムコンテンツを挿入できるようにします。これにより、トラッキングスクリプトや分析コード、その他の動的コンテンツをテーマのコアファイルを編集せずに追加することができます。 -->

    <header class="header">

        <div class="header_logo">
            <h1 class="logo"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?><span><?php bloginfo('description'); ?></span></a></h1>
        </div>

        <div class="header_nav">

            <div class="gnav js-menu">

                <!-- Gnav -->
                <?php
                $args = [
                    'menu' => 'Gnav', //管理画面で作成したメニューの名前
                    'menu_class' => '', //メニューを構成するulタグのクラス名
                    'container' => false, //<ul>タグを囲んでいるdivタグを消除
                ];
                wp_nav_menu($args);
                ?>


            </div>
        </div>
        <?php get_template_part('template-parts/breadcrumb'); ?>
    </header>
