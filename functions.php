<?php
// 管理バーを非表示させる
add_filter('show_admin_bar', '__return_false');

/**
 * 「after_setup_theme」アクションフックを使用する関数をまとめる
 */

function my_theme_setup()
{
    add_theme_support('title-tag'); //<title>タグを出力する
    add_theme_support('post-thumbnails'); //アイキャチ画像を使用可能にする
    add_theme_support('menus'); //カスタムメニュー機能を使用可能にする
}
add_action('after_setup_theme', 'my_theme_setup');


/**
 * スタイルシートとJavaScriptファイルを読み込む
 */
function add_style_script()
{
    /*
    *共通CSS
    */

    //リセットCSS
    wp_enqueue_style(
        'destyle',
        get_template_directory_uri() . '/assets/css/destyle.css'
    );

    // 外部のスタイルシート
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css'); //外部のスタイルシート:FontAwesome CDN

    wp_enqueue_style('google-web-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Zen+Maru+Gothic:wght@300;400;500;700;900&display=swap'); //外部のスタイルシート:GoogleFonts
    wp_enqueue_style('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css'); //slick
    wp_enqueue_style('slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css'); //slick-theme
    wp_enqueue_script('jquery');  //jQueryを読み込む
    wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js'); //slick.js スライダー用


    wp_enqueue_style(
        'mycommon',
        get_template_directory_uri() . '/assets/css/common.css'
    );
    wp_enqueue_style(
        'myheader',
        get_template_directory_uri() . '/assets/css/header.css'
    );
    wp_enqueue_style(
        'myfooter',
        get_template_directory_uri() . '/assets/css/footer.css'
    );

    //  common.js
    wp_enqueue_script('common-js', get_template_directory_uri() . '/assets/js/common.js', ['jquery'], true);
    // column_slider . js
    wp_enqueue_script('column_slider-js', get_template_directory_uri() . '/assets/js/column_slider.js', ['jquery'], true);

    /**
     * 個々のページ
     */
    if (is_404()) {
        wp_enqueue_style(
            'error404',
            get_template_directory_uri() . '/assets/css/404.css'
        );
    }
    //404.css

    if (is_home()) {
        wp_enqueue_style(
            'mytop',
            get_template_directory_uri() . '/assets/css/top.css'
        );
    }


    // お問い合わせフォーム
    if (is_page('contact') || ('confirm') || ('thanks')) {
        wp_enqueue_style(
            'tikunarainavi-input',
            get_template_directory_uri() . '/assets/css/input.css',
        );

        wp_enqueue_script(
            'tokunarainavi-mail-js',
            get_template_directory_uri() . '/assets/js/mail_form.js',
            array('jquery'), // jQuery に依存
            '', // バージョン指定なし
            true // フッターに出力
        );
    }

    // お気に入りリスト
    if (is_page('favor')) {
        wp_enqueue_style(
            'favorite',
            get_template_directory_uri() . '/assets/css/favorite.css'
        );
    }

    // page-about.php
    if (is_page('about')) {
        wp_enqueue_style('abouttokunavi', get_template_directory_uri() . '/assets/css/about.css');
        // about.css

    }
}
add_action('wp_enqueue_scripts', 'add_style_script');


//固定ページで抜粋を使えるようにする
add_post_type_support('page', 'excerpt');


/**
 * メインクエリを変更する
 */
add_action('pre_get_posts', 'my_pre_get_posts');
function my_pre_get_posts($query)
{
    //管理画面、メインクエリ以外には設定しない
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    //トップページの場合
    if ($query->is_home()) {
        $query->set('posts_per_page', 3);
        return;
    }
    // 投稿list画面
    if ($query->is_category()) {
        $query->set('posts_per_page', 5);
        return;
    }

    //search画面
    if ($query->is_search()) {
        $query->set('post_type', 'classroom');
        $query->set('posts_per_page', 12);
        return;
    }
}
/*
* 管理画面、施設の記事にを施設の種別分類フィルタの追加
*/
function wpkj_product_taxonomy_filter()
{
    global $typenow;
    $post_type = 'classroom'; //slug
    $taxonomy  = 'classtype'; //  taxonomy
    if ($typenow == $post_type) {
        $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => sprintf(__('ALL %s', 'textdomain'), $info_taxonomy->label),
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'orderby'         => 'name',
            'selected'        => $selected,
            'hierarchical'    => true,
            'show_count'      => true,
            'hide_empty'      => true,
            'value_field'     => 'slug'
        ));
    };
}
add_action('restrict_manage_posts', 'wpkj_product_taxonomy_filter');


/**
 * ランキング用
 * ページ表示の連続更新による閲覧回数カウント制限、transient、1時間
 */
// 分類の表示回数を増やす関数
function increment_term_view_count($term_id)
{
    $user_ip = $_SERVER['REMOTE_ADDR']; //get user IP
    $transient_key = 'view_count_' . $term_id . '_' . md5($user_ip);

    if (false === get_transient($transient_key)) {

        $view_count = get_term_meta($term_id, 'view_count', true);
        $view_count = $view_count ? intval($view_count) : 0;

        update_term_meta($term_id, 'view_count', $view_count + 1);

        set_transient($transient_key, 'viewed', 3600); // transientを設定します。有効期限は1時間（3600秒）です。
    }
}

/**
 * wp_nav_menu() に walker クラスを追加
 */
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu
{
    // Start of each <li>
    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $classes = empty($item->classes) ? [] : (array) $item->classes;

        // Add custom class to <li>
        $classes[] = 'site_nav_item';

        // Join class array to string
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        // Create <li> element
        $output .= '<li' . $class_names . '>';

        // Add link inside <li>
        $atts = [];
        $atts['href'] = ! empty($item->url) ? $item->url : '';
        $atts['title'] = ! empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = ! empty($item->target) ? $item->target : '';
        $atts['rel'] = ! empty($item->xfn) ? $item->xfn : '';

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (! empty($value)) {
                $attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
