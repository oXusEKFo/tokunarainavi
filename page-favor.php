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
        <div class="results_card"> <!-- ← results.htmlから借用 -->

            <?php
            if (function_exists('get_user_favorites')) :
                // code...
                $favorites = get_user_favorites(); // 現在のユーザーのお気に入り投稿IDを取得
                krsort($favorites); // リストを降順に並べる（新規追加したものが先頭にくるように）

                // print_r($favorites);

                if ($favorites) :
                    $the_query = new WP_Query([
                        'post_type' => 'classroom', // カスタム投稿 'classroom'
                        'posts_per_page' => -1, // すべての投稿を取得
                        'ignore_sticky_posts' => true,
                        'post__in' => $favorites, // お気に入りの投稿ID
                        'orderby' => 'post__in', // お気に入りに登録された順に並び替え
                    ]);
                    if ($the_query->have_posts()) :
                        while ($the_query->have_posts()) :
                            $the_query->the_post();

                            $classname = esc_html(get_the_title());  // 教室名

                            $events['text'][] = $classname;
            ?>


                            <div class="wrap_card">
                                <div class="inner_card">
                                    <?php get_template_part('template-parts/loop', 'classroom') ?>
                                </div>
                            </div>


                        <?php
                            $event_count++;
                        // end ループ while
                        endwhile;
                        wp_reset_postdata();
                        // else :
                        ?>


            <?php
                    else :

                    endif;
                endif;
            // end favorites
            endif;
            // print_r($events);
            // print_r($event_count);
            ?>

        </div>
        <?php
        if ($event_count == 0) :
        ?>
            <!-- 登録物がないときは下記の文章を使用します -->
            <p>
                <center>お気に入りはありません。</center>
            </p>
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
