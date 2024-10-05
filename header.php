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

    <header class="site_header">
        <div class="site_header_container site_header_logo_center">
            <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/karilogo.png" alt="logo" class="site_header_logo"></a>
        </div>

        <!-- ハンバーガーメニューアイコン -->
        <div class="site_header_menu_icon" id="menuIcon" onclick="toggleMenu()">&#9776;</div>
        <!-- ハンバーガーメニュー -->
        <nav class="site_nav" id="menu">

            <!-- Gnav -->
            <?php
            $args = [
                'menu' => 'Gnav', //管理画面で作成したメニューの名前
                'menu_class' => 'site_nav_list', //メニューを構成するulタグのクラス名
                'container' => false, //<ul>タグを囲んでいるdivタグを消除
                'walker' => new Custom_Walker_Nav_Menu() // カスタム Walker クラスを指定
            ];
            wp_nav_menu($args);
            ?>

            <!-- SNSアイコンの配置 -->
            <div class="site_nav_social_links">
                <a href="https://www.instagram.com" target="_blank">
                    <img src="<?php echo get_template_directory_uri();  ?>/assets/images/insta.png" alt="Instagram">
                </a>
                <a href="https://www.twitter.com" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/X.png" alt="Twitter">
                </a>
            </div>
            <!-- キャラクター画像の../assets/images/配置 -->
            <div class="site_nav_character">
                <img src="<?php echo get_template_directory_uri();  ?>/assets/images/rabbit.png" alt="うさぎキャラクター">
            </div>
        </nav>

    </header>
