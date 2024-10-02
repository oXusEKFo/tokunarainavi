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
                    <?php the_post_thumbnail('medium'); ?><!-- アイキャッチ画像 -->
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif ?>
    </section>


    <section> search</section>
    <section> ranking</section>

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
    </section>
    <section> news</section>
</main>
<?php get_footer(); ?>
