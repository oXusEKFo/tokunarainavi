<?php get_header(); ?>

<main id="main" class="main">

    <section class="favorite-booth">
        <h2>お気に入りリスト</h2>

        <!-- カード 始まり -->
        <div class="article-content main-article mw-1200">

            <!-- カード型記事範囲 -->
            <div class="card-container">
                <!-- 記事 -->


                <?php
                if (function_exists('get_user_favorites')) :
                    // 現在のユーザーのお気に入り投稿IDを取得
                    $favorites = get_user_favorites();
                    // お気に入りリストを降順に並べ替える（新しく追加したものが先頭にくるように）
                    krsort($favorites);


                    // print_r($favorites);

                    if ($favorites) :
                        $the_query = new WP_Query([
                            'post_type' => 'class-room', // カスタム投稿タイプ 'class-room'
                            'posts_per_page' => -1, // すべての投稿を取得
                            'ignore_sticky_posts' => true,
                            'post__in' => $favorites, // お気に入りの投稿ID
                            'orderby' => 'post__in', // お気に入りに登録された順に並び替え
                        ]);
                        if ($the_query->have_posts()) :
                            while ($the_query->have_posts()) :
                                $the_query->the_post();

                                $text = esc_html(get_the_title());  // 教室名

                                $events['text'][] = $text;
                ?>


                                <div class="card-wrap">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="article-news">
                                            <i class="fa-solid fa-bookmark  fa-2x fa-pull-left"></i>
                                            <?php
                                            $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                                            $thumbnail_data = wp_get_attachment_image_src($thumbnail_id, 'large');
                                            $thumbnail_url = $thumbnail_data[0]; // URLを取得
                                            ?>
                                            <img src="<?php echo esc_url($thumbnail_url); ?>" alt="記事画像">
                                            <h3 class="article-news-caption"><?php echo esc_html(get_the_title()); ?></h3>
                                            <p class="article-news-txt"><?php the_field('institution'); ?></p>
                                        </div>
                                    </a>
                                </div>

                            <?php
                                $event_count++;
                            // end ループ while
                            endwhile;
                            wp_reset_postdata();
                            // else :
                            ?>
            </div>

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

</main>


<?php get_footer(); ?>
