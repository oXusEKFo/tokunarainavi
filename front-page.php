<?php get_header(); ?>

<main>

    <!-- KV -->
    <section>
        KV
    </section>

    <!-- about me -->
    <section class="inner_concept">

        <?php
        $args = [
            'post_type' => 'page',

            'post__in' => ['174'], // サーバ環境用
        ];
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()):
            while ($the_query->have_posts()): $the_query->the_post();
        ?>
                <div class="text_content">
                    <!-- 抜粋 -->
                    <h2><?php echo the_excerpt(); ?></h2>
                </div>
                <div class="image_content">
                    <!-- アイキャッチ画像 -->
                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="コンセプト" class="combined_image">
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif ?>
    </section>
    <!-- 白背景の余白スペース -->
    <div class="white_space"></div>
    <!-- search -->
    <section>
        <h1>search</h1>
        <h2>エリア</h2>
        <?php get_template_part('template-parts/search', 'area'); ?>
        <h2>年齢</h2>
        <?php get_template_part('template-parts/search', 'age'); ?>
        <h2>ジャンル</h2>
        <?php get_template_part('template-parts/search', 'classtype'); ?>
    </section>

    <!-- ランキング -->
    <section class="ranking_container">
        <!-- タイトルの配置 -->
        <h2 class="ranking_title">RANKING</h2>
        <ul>
            <?php
            $args = [
                'taxonomy'   => 'classtype',
                'meta_key'   => 'view_count',        // view _ countメタデータを使用したソート
                'orderby'    => 'meta_value_num',    // 数値でソート
                'order'      => 'DESC',              // 降順に並べる
                'hide_empty' => false,               // 関連付けられていない記事の分類を表示
                'number'     => 5,                   // 上位5分類のみ表示
            ];
            $argc = [
                'taxonomy'   => 'classtype',
                'orderby' => 'slug',
            ];

            $terms = get_terms($args);
            $termc = get_terms($argc);

            if (!empty($terms) && !is_wp_error($terms)) :
                $number = 0;
                foreach ($terms as $term) {
                    if (strpos($term->slug, 'class') !== false) {
                        continue;
                    }
                    $number++;
            ?>
                    <li>
                        <div class="crown_container">
                            <div class="crown">
                                <span class="number"><?php print_r($number); ?></span>
                            </div>
                        </div>
                        <a href="swimming.html">水泳<span class="arrow">&gt;</span></a>
                        <?php
                        $view_count = get_term_meta($term->term_id, 'view_count', true);
                        $term_link = get_term_link($term); // 分類リンクの取得
                        if (!is_wp_error($term_link)) {
                            //出力分類の名前、リンク、ブラウズ回数
                            echo '<p><a href="' . esc_url($term_link) . '">' . esc_html($term->name) . '</a> - ブラウズ回数: ' . esc_html($view_count) . '</p>';
                        ?>
                    </li>
        <?php
                        }
                    }
                endif;
        ?>
        </ul>
        <a href="<?php echo home_url('/fushion'); ?>" class="">もっと見る</a>
    </section>

    <!-- column -->
    <section>
        <h1>column</h1>
        <?php
        $args = [
            'post_type' => 'column',
        ];
        $column_query = new WP_query($args);
        if ($column_query->have_posts()):
        ?>
            <?php while ($column_query->have_posts()): $column_query->the_post(); ?>
                <?php get_template_part('template-parts/loop', 'column'); ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif ?>

        <a href="<?php echo home_url('/column'); ?>" class="">もっと見る</a>
    </section>

    <section class="NEWS">
        <div class="circle">
            <img src="<?php echo get_template_directory_uri();  ?>/assets/images/creamcircle.png" alt="">
            <h1 class="title">NEWS</h1>
        </div>
        <h2 class="subtitle">新着情報</h2>
        <!-- ここからニュース記事 -->
        <div class="inner">
            <ul class="news_list">
                <?php
                $args = [
                    'post_type' => 'post',
                ];
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()):
                    while ($the_query->have_posts()): $the_query->the_post();
                ?>
                        <?php get_template_part('template-parts/loop', 'news'); ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif ?>
            </ul>
        </div>



    </section>

    <div class="box">
        <img src="<?php echo get_template_directory_uri();  ?>/assets/images/star.png" class="big-star">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/star.png" class="mini-star">
        <a href="<?php echo home_url('/category'); ?>" class="button">新着情報を<br>もっと見る</a>
    </div>

    <!-- end news -->

</main>
<?php get_footer(); ?>
