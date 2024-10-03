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
        <!-- <?php get_template_part('template-parts/search', 'area'); ?> -->
        <h2>年齢</h2>
        <!-- <?php get_template_part('template-parts/search', 'age'); ?> -->
        <h2>ジャンル</h2>
        <!-- <?php get_template_part('template-parts/search', 'category'); ?> -->
    </section>

    <!-- ランキング -->
    <section>
        <h1>ranking</h1>
        <?php
        $args = [
            'taxonomy'   => 'classtype',   // 指定分类法
            'meta_key'   => 'view_count',        // 使用view_count元数据排序
            'orderby'    => 'meta_value_num',    // 按数字值排序
            'order'      => 'DESC',              // 按降序排列
            'hide_empty' => false,               // 显示没有关联文章的分类
            'number'     => 5,                   // 仅显示前5个分类
        ];
        $argc = [
            'taxonomy'   => 'classtype',
            'orderby' => 'slug',
        ];

        $terms = get_terms($args);
        $termc = get_terms($argc);

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $view_count = get_term_meta($term->term_id, 'view_count', true);
                echo '<p>' . esc_html($term->name) . ' - 浏览次数: ' . esc_html($view_count) . '</p>';
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
