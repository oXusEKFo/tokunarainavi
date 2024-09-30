<?php

// 管理バーを非表示させる
// add_filter('show_admin_bar', '__return_false');


/**
 * テーマセットアップ後に、WordPressの初期化設定
 *
 * @return void
 */
function tokunavi_after_setup_theme()
{
    /**
     * <title>タぐを出力する
     */
    add_theme_support('title-tag');

    /**
     * アイキャッチ画像を使用可能にする
     */
    add_theme_support('post-thumbnails');

    /**
     * カスタムメニュー機能を使用可能にする
     */
    add_theme_support('menus');
}
add_action('after_setup_theme', 'tokunavi_after_setup_theme');

/**
 * スタイルシートとJSファイルを読み込む関数
 *
 * @return void
 */
function tokunavi_wp_enqueue_scripts()
{
    // WEBサイトの共通のスタイルシート、JSファイルを読み込む
    // スタイルファイルを読み込む
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css');


    // googleフォント
    wp_enqueue_style('google-googleapis', 'https://fonts.googleapis.com');
    wp_enqueue_style('google-gstatic', 'https://fonts.gstatic.com');
    wp_enqueue_style('google-kaisei', 'https://fonts.googleapis.com/css2?family=Kaisei+Opti:wght@700&family=Zen+Kaku+Gothic+New:wght@400;500&display=swap');

    // リセットCSS
    wp_enqueue_style('tokunavi-reset', get_template_directory_uri() . '/assets/css/reset.css');

    // 共通のスタイルシート
    // wp_enqueue_style('tokunavi-app', get_template_directory_uri() . '/assets/css/app.css');
    wp_enqueue_style('tokunavi-common', get_template_directory_uri() . '/assets/css/common.css');

    // 自作CSS
    wp_enqueue_style('tokunavi-front-page', get_template_directory_uri() . '/assets/css/front-page.css');

    wp_enqueue_style('tokunavi-header', get_template_directory_uri() . '/assets/css/header.css');

    wp_enqueue_style('tokunavi-footer', get_template_directory_uri() . '/assets/css/footer.css');

    wp_enqueue_style('tokunavi-btn', get_template_directory_uri() . '/assets/css/btn.css');

    wp_enqueue_style('tokunavi-card_list2', get_template_directory_uri() . '/assets/css/card_list2.css');

    // slick CSS
    wp_enqueue_style('tokunavi-slick', get_template_directory_uri() . '/assets/css/slick.css');
    wp_enqueue_style('tokunavi-slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css');

    wp_enqueue_style('tokunavi-colorbox', get_template_directory_uri() . '/assets/css/colorbox.css');

    // jQueryを読み込む
    // wp_enqueue_script('jquery');

    wp_deregister_script('jquery');

    wp_enqueue_script(
        'jquery-3.7.1',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js',
        '',
        '',
        false  //フッターに読み込むように
    );

    wp_enqueue_script(
        'tokunavi-main',
        get_template_directory_uri() . '/assets/js/main.js',
        '',
        '',
        true  //フッターに読み込むように
    );

    // ヘッダー(ハンバーガー)JSファイルを読み込む
    wp_enqueue_script(
        'tokunavi-header',
        get_template_directory_uri() . '/assets/js/header.js',
        '',
        '',
        true  //フッターに読み込むように
    );

    // ハンバーガーJSファイルを読み込む
    wp_enqueue_script(
        'tokunavi-slick_min',
        get_template_directory_uri() . '/assets/js/slick.min.js',
        '',
        '',
        true  //フッターに読み込むように
    );


    // それぞれのページに必要とするスタイルシート、JSファイルを読み込む

    if (is_home()) {
        // CSSファイルを読み込む
        wp_enqueue_style('tokunavi-front-page', get_template_directory_uri() . '/assets/css/front-page.css');

        // JSファイルを読み込む
        wp_enqueue_script(
            'tokunavi-home',
            get_template_directory_uri() . '/assets/js/front_page.js',
            '',
            '',
            true
        );
    } else if (is_search()) {

        wp_enqueue_style('tokunavi-search', get_template_directory_uri() . '/assets/css/search.css');

        wp_enqueue_style('tokunavi-card_list2', get_template_directory_uri() . '/assets/css/card_list2.css');

        wp_enqueue_style(
            'tokunavi-search_detail',
            get_template_directory_uri() . '/assets/css/search_detail.css'
        );

        wp_enqueue_style('tokunavi-btn', get_template_directory_uri() . '/assets/css/btn.css');

        wp_enqueue_script(
            'tokunavi-search',
            get_template_directory_uri() . '/assets/js/search.js',
            '',
            '',
            true
        );
        wp_enqueue_script(
            'tokunavi-search_cetail',
            get_template_directory_uri() . '/assets/js/search_cetail.js',
            '',
            '',
            true
        );
    } else if (is_page('contact') || is_page('confirm') || is_page('thanks')) {
        wp_enqueue_style('tokunavi-contact', get_template_directory_uri() . '/assets/css/contact.css');

        wp_enqueue_script(
            'tokunavi-contact',
            get_template_directory_uri() . '/assets/js/contact.js',
            '',
            '',
            true
        );
    } else if (is_page('about')) {

        wp_enqueue_style('tokunavi-site_about', get_template_directory_uri() . '/assets/css/site_about.css');
    } else if (is_page('qa')) {

        wp_enqueue_style('tokunavi-page_qa', get_template_directory_uri() . '/assets/css/page_qa.css');
    } else if (is_page('mypage')) {
        // タクソノミーページ
        wp_enqueue_style('tokunavi-model_course', get_template_directory_uri() . '/assets/css/model_course.css');

        wp_enqueue_style('tokunavi-card_list2', get_template_directory_uri() . '/assets/css/card_list2.css');

        wp_enqueue_style('tokunavi-favorite', get_template_directory_uri() . '/assets/css/favorite.css');
    } else if (is_page('trivia')) {

        wp_enqueue_style('tokunavi-syouwa_about', get_template_directory_uri() . '/assets/css/syouwa_about.css');
    } else if (is_page('policy')) {

        wp_enqueue_style('tokunavi-privacy_policy', get_template_directory_uri() . '/assets/css/privacy_policy.css');
    } else if (is_post_type_archive('gallery')) {

        wp_enqueue_style('tokunavi-gallery', get_template_directory_uri() . '/assets/css/gallery.css');

        // JSファイルを読み込む
        wp_enqueue_script(
            'tokunavi-colorbox-min',
            get_template_directory_uri() . '/assets/js/jquery.colorbox-min.js',
            '',
            '',
            true
        );
        wp_enqueue_script(
            'tokunavi-gallery',
            get_template_directory_uri() . '/assets/js/gallery.js',
            '',
            '',
            true
        );
    } else if (is_post_type_archive('special')) {

        wp_enqueue_style('tokunavi-colamn', get_template_directory_uri() . '/assets/css/colamn.css');
    } else if (is_category()) {
        // カテゴリーページ

    } else if (is_tax('food_type')) {
        // タクソノミーページ
        wp_enqueue_style('tokunavi-food_list', get_template_directory_uri() . '/assets/css/food_list.css');

        wp_enqueue_style('tokunavi-card_list2', get_template_directory_uri() . '/assets/css/card_list2.css');

        // JSファイルを読み込む
        wp_enqueue_script(
            'tokunavi-food_list-min',
            get_template_directory_uri() . '/assets/js/food_list.js',
            '',
            '',
            true
        );
    } else if (is_tax('spot_type')) {

        wp_enqueue_style('tokunavi-spot_list', get_template_directory_uri() . '/assets/css/spot_list.css');
        // JSファイルを読み込む
        wp_enqueue_script(
            'tokunavi-food_list-min',
            get_template_directory_uri() . '/assets/js/food_list.js',
            '',
            '',
            true
        );
    } else if (is_tax('read')) {

        wp_enqueue_style('tokunavi-colamn', get_template_directory_uri() . '/assets/css/colamn.css');
    } else if (is_tax('area')) {
        wp_enqueue_style('tokunavi-search', get_template_directory_uri() . '/assets/css/search.css');

        wp_enqueue_style('tokunavi-card_list2', get_template_directory_uri() . '/assets/css/card_list2.css');

        // タクソノミーページ
        wp_enqueue_style('tokunavi-food_list', get_template_directory_uri() . '/assets/css/food_list.css');

        wp_enqueue_style(
            'tokunavi-search_detail',
            get_template_directory_uri() . '/assets/css/search_detail.css'
        );

        wp_enqueue_script(
            'tokunavi-search',
            get_template_directory_uri() . '/assets/js/search.js',
            '',
            '',
            true
        );
        wp_enqueue_script(
            'tokunavi-search_cetail',
            get_template_directory_uri() . '/assets/js/search_cetail.js',
            '',
            '',
            true
        );
    } else if (is_tax('genre')) {
        wp_enqueue_style('tokunavi-search', get_template_directory_uri() . '/assets/css/search.css');

        wp_enqueue_style('tokunavi-card_list2', get_template_directory_uri() . '/assets/css/card_list2.css');

        // タクソノミーページ
        wp_enqueue_style('tokunavi-food_list', get_template_directory_uri() . '/assets/css/food_list.css');

        wp_enqueue_style(
            'tokunavi-search_detail',
            get_template_directory_uri() . '/assets/css/search_detail.css'
        );

        wp_enqueue_script(
            'tokunavi-search',
            get_template_directory_uri() . '/assets/js/search.js',
            '',
            '',
            true
        );
        wp_enqueue_script(
            'tokunavi-search_cetail',
            get_template_directory_uri() . '/assets/js/search_cetail.js',
            '',
            '',
            true
        );

        wp_enqueue_script(
            'tokunavi-genre',
            get_template_directory_uri() . '/assets/js/test.js',
            '',
            '',
            true
        );
    } else if (is_singular('food')) {
        // 特定のfoodの詳細ページ
        // 汎用のsingleページ
        // wp_enqueue_style('tokunavi-detail', get_template_directory_uri() . '/assets/css/detail.css');

        // 汎用のsingleページ
        wp_enqueue_style('tokunavi-detail', get_template_directory_uri() . '/assets/css/detail.css');

        wp_enqueue_script(
            'tokunavi-detail',
            get_template_directory_uri() . '/assets/js/detail.js',
            '',
            '',
            true
        );
    } else if (is_singular('spot')) {
        wp_enqueue_style('tokunavi-detail', get_template_directory_uri() . '/assets/css/detail.css');

        wp_enqueue_script(
            'tokunavi-detail',
            get_template_directory_uri() . '/assets/js/detail.js',
            '',
            '',
            true
        );
    } else if (is_singular('course')) {
        wp_enqueue_style('tokunavi-course', get_template_directory_uri() . '/assets/css/model_course.css');
    } else if (is_singular('special')) {
        //シングルコラムcss
        wp_enqueue_style('tokunavi-colamn', get_template_directory_uri() . '/assets/css/colamn.css');
    }
}
add_action('wp_enqueue_scripts', 'tokunavi_wp_enqueue_scripts');
// add_action('読みだすタイミング', '呼び出す関数名');


/**
 * タイトルの区切り文字を設定する
 *
 * @param string $separator
 * @return string
 */
function tokunavi_document_title_separator(string $separator): string
{
    $separator = '|';     //好きな文字をセットする
    return $separator;
}

// add_filter('呼び出すタイミング', '呼びだす関数名');
add_filter(
    'document_title_separator',
    'tokunavi_document_title_separator'
);

/**
 * Contact Form 7の時には整形機能をOFFにする
 *
 * @return void
 */
function tokunavi_wpcf7_autop()
{
    return false;
}
add_filter('wpcf7_autop_or_not', 'tokunavi_wpcf7_autop');

/**
 * メインクエリを調整する
 *
 * @param [type] $query
 * @return void
 */
function tokunavi_pre_get_posts($query)
{
    // 管理画面、またはメインクエリでないとき対象外とする
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if ($query->is_home()) {
        // トップページの場合は変更する
        $query->set('posts_per_page', 3);       //3件だけ
        // $query->set('category_name', 'news');   //カテゴリーnewsだけ
    } else if (is_search()) {
        //検索の場合は、投稿のみ対象とする
        // $query->set('post_type', 'post');
        if ($query->is_search() && $query->is_main_query() && !$query->is_admin()) {
            $s = $query->get('s');
            $s = trim($s);
            if (empty($s)) {
                // $search .= " AND 0=1 ";
            } else {
                $query->set('post_type', ['food', 'spot']);
            }
            $query->set('posts_per_page', 6);       //3件だけ
        }
    } else if (is_post_type_archive('gallery')) {
        $query->set('posts_per_page', 6);       //9件だけ
        //ギャラリーの場合は、並びはランダムとする
        $query->set('orderby', 'rand');
    } else if (is_tax()) {
        //たくそのみーの場合は、ギャラリーとコラムを対象外とする
        $query->set('posts_per_page', 6);       //9件だけ
        // $query->set('post_type', 'special');
    }


    //公開する投稿だけ
    $query->set('post_status', 'publish');
    return;
}
// アクションフックで関数を呼び出す
add_action('pre_get_posts', 'tokunavi_pre_get_posts');

/**
 * descriptionを取得して出力関数
 *
 * @return void
 */
function tokunavi_description()
{
    // トップページの場合は
    if (is_home()) {
        // トップページ
        $description = "トップページのデスクリプションです。";
    } else {
        // その他の下層ページ
        $description = "下層ページのデスクリプションです。";
    }
    echo $description;
    return;
}
