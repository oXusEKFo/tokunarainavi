<?php get_header();

// お気に入りの総件数を保存する変数
$total_favorites_count = 0;

?>

<!-- main -->
<main>

    <!-- パンくず -->
    <div class="breadCrumb__wrap">
        <div class="breadCrumb">
            <?php get_template_part('template-parts/breadcrumb'); ?>
        </div>
    </div>

    <div class="inner_main">

        <h1>お気に入りリスト （登録：<?php echo $total_favorites_count; ?>件）</h1>

        <!-- ここからお気に入り一覧が表示されます -->
        <div class="results_card">

            <?php
            if (function_exists('get_user_favorites')) :
                // 現在のユーザーのお気に入り投稿IDを取得
                $favorites = get_user_favorites();

                // お気に入りIDが空でない場合
                if (!empty($favorites)) {
                    // お気に入りの総件数を取得
                    $total_favorites_count = count($favorites);

                    krsort($favorites); // リストを降順に並べる

                    // 現在のページ番号を取得
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    $the_query = new WP_Query([
                        'post_type' => 'classroom', // カスタム投稿 'classroom'
                        'posts_per_page' => 6, // 1ページに表示する投稿数を6件に制限
                        'ignore_sticky_posts' => true,
                        'post__in' => $favorites, // お気に入りの投稿ID
                        'orderby' => 'post__in', // お気に入りに登録された順に並び替え
                        'paged' => $paged, // ページネーション対応
                    ]);

                    if ($the_query->have_posts()) :
                        while ($the_query->have_posts()) :
                            $the_query->the_post();

                            // 教室名を取得
                            $classname = esc_html(get_the_title());
                            get_template_part('template-parts/loop', 'classroom');

                        endwhile;

                        wp_reset_postdata();
                    endif; // $the_query->have_posts()
                }
            endif; // function_exists('get_user_favorites')
            ?>

            <?php
            if ($total_favorites_count == 0) :
            ?>
                <!-- 登録物がないときは下記の文章を使用します -->
                <p class="no-favorite">お気に入りはありません。</p>
            <?php
            endif;
            ?>

        </div> <!-- results_card -->

        <!-- ページナビゲーション -->
        <?php
        if (!empty($favorites) && function_exists('wp_pagenavi') && isset($the_query)) {
            wp_pagenavi(['query' => $the_query]);
        }
        ?>

        <!-- 件数表示を更新 -->
        <script>
            document.querySelector('h1').innerHTML = 'お気に入りリスト （登録：<?php echo $total_favorites_count; ?>件）';
        </script>

        <section class="favorite_info">
            <h2>お気に入りページの注意点</h2>
            <p>・当サイトのお気に入り機能はCookieを使用しています。</p>
            <p>・ブラウザのCookieを削除すると、保存されたブックマーク情報も削除されますのでご注意ください。</p>
        </section>

    </div>
</main>

<?php get_footer(); ?>
