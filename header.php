<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <?php wp_head(); ?> <!-- 必ず書いてください-->


</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header>
        <div class="inner__header">
            <nav class="gnav">
                <div class="gnav__wrap">
                    <!-- Gnav -->
                    <?php
                    $args = [
                        'menu' => 'Gnav', //管理画面で作成したメニューの名前
                        'menu_class' => 'gnav__menu', //メニューを構成するulタグのクラス名
                        'container' => false, //<ul>タグを囲んでいるdivタグを消除
                        'walker' => new Custom_Walker_Nav_Menu() // カスタム Walker クラスを指定
                    ];
                    wp_nav_menu($args);
                    ?>


                    <div class="wrap__sns-logo">
                        <a href="https://www.instagram.com/tokunavi17">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://x.com/tokunavi17">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>

                    </div>


                </div>
            </nav>

            <div class="logo__header">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/karilogo.png" alt="とくしま習いごとナビ">
                </a>
            </div>

            <div class="wrap__navi">
                <a class="menu">
                    <span class="menu__line menu__line--top"></span>
                    <span class="menu__line menu__line--center"></span>
                    <span class="menu__line menu__line--bottom"></span>
                </a>
            </div>
    </header>
