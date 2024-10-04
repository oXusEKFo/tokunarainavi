<?php get_header(); ?>
<main>

    <!-- KV -->
    <section>
        KV
    </section>

    <!-- about me -->
    <section>
        <h1>about me </h1>
        <?php
        $args = [
            'post_type' => 'page',

            'post__in' => ['174'], // サーバ環境用
        ];
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()):
            while ($the_query->have_posts()): $the_query->the_post();
        ?>
                <div>
                    <?php echo the_excerpt(); ?><!-- 抜粋 -->
                </div>
                <div>
                    <?php the_post_thumbnail(); ?><!-- アイキャッチ画像 -->
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif ?>
    </section>

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
    <section>
        <h1>ranking</h1>
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

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                if (strpos($term->slug, 'class') !== false) {
                    continue;
                }
                $view_count = get_term_meta($term->term_id, 'view_count', true);
                $term_link = get_term_link($term); // 分類リンクの取得
                if (!is_wp_error($term_link)) {
                    //出力分類の名前、リンク、ブラウズ回数
                    echo '<p><a href="' . esc_url($term_link) . '">' . esc_html($term->name) . '</a> - ブラウズ回数: ' . esc_html($view_count) . '</p>';
                }
            }
        } else {
            echo '分類されていない、または分類されていないブラウズ回数レコード。';
        }
        ?>
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

    <section>
        <h1>news</h1>
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

        <a href="<?php echo home_url('/category'); ?>" class="">もっと見る</a>
    </section>
</main>
<?php get_footer(); ?>
