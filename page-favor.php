<?php get_header();

$events = [];
// イベント数カウント
$event_count = 0;

?>

<!-- main -->
<main>
    <div class="inner_main">

        <?php
        get_template_part('template-parts/breadcrumb');
        ?>

        <h1>お気に入りリスト</h1>

        <div class="favorite_card">
            <!-- ここからお気に入りの施設一覧が表示されます -->


            <?php
            if (function_exists('get_user_favorites')) :
                // 現在のユーザーのお気に入り投稿IDを取得
                $favorites = get_user_favorites();
                // お気に入りリストを降順に並べ替える
                //（新しく追加したものが先頭にくるように）
                krsort($favorites);

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

                            <?php
                            $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                            $thumbnail_data = wp_get_attachment_image_src($thumbnail_id, 'large');
                            $thumbnail_url = $thumbnail_data[0]; // URLを取得
                            ?>

                            <!-- お気に入り一覧カード -->
                            <?php get_template_part('template-parts/loop', 'classroom') ?>



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

            </section>

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

        </div>

        <section class="favorite_info">
            <h2>お気に入りページの注意点</h2>
            <p>・当サイトのお気に入り機能はCookieを使用しています。</p>
            <p>・ブラウザのCookieを削除すると、保存されたブックマーク情報も削除されますのでご注意ください。</p>
        </section>

    </div>
</main>


<?php get_footer(); ?>
