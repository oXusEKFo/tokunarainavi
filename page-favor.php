<?php get_header();

$events = [];
// イベント数カウント
$event_count = 0;

?>

<!-- main -->
<main>

    <div class="inner_main">
        <!-- パンくず -->
        <div class="container_breadCrumb">
            <div class="breadCrumb">
                <?php
                get_template_part('template-parts/breadcrumb');
                ?>
            </div>
        </div>

        <h1>お気に入りリスト</h1>

        <!-- ここからお気に入り一覧が表示されます -->
        <div class="results_card">

            <?php
            if (function_exists('get_user_favorites')) :
                // 現在のユーザーのお気に入り投稿IDを取得
                $favorites = get_user_favorites();

                if (!empty($favorites)) {
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

                            $classname = esc_html(get_the_title());  // 教室名
            ?>

                            <div class="wrap_card">
                                <div class="inner_card">
                                    <?php get_template_part('template-parts/loop', 'classroom') ?>
                                </div>
                            </div>

            <?php
                            $event_count++;
                        endwhile;

                        wp_reset_postdata();
                    endif; // $the_query->have_posts()
                }
            endif; // function_exists('get_user_favorites')
            ?>

        </div> <!-- results_card -->

        <!-- ページナビゲーション -->
        <?php
        if (function_exists('wp_pagenavi')) {
            wp_pagenavi(['query' => $the_query]);
        }
        ?>

        <?php
        if ($event_count == 0) :
        ?>
            <!-- 登録物がないときは下記の文章を使用します -->
            <p class="no__favorite">お気に入りはありません。</p>
        <?php
        endif;
        ?>

        <section class="favorite_info">
            <h2>お気に入りページの注意点</h2>
            <p>・当サイトのお気に入り機能はCookieを使用しています。</p>
            <p>・ブラウザのCookieを削除すると、保存されたブックマーク情報も削除されますのでご注意ください。</p>
        </section>

    </div>
</main>

<?php get_footer(); ?>
