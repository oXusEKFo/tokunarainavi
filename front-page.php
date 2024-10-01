<?php get_header(); ?>
<main>

    <!-- KV -->
    <section>
        KV
    </section>

    <!-- about me -->
    <section>
        <?php
        $args = [
            'post_type' => 'page',
            'post__in' => ['162'],
        ];
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()):
            while ($the_query->have_posts()): $the_query->the_post();
        ?>
                <div>
                    <?php echo the_excerpt(); ?>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif ?>
    </section>


    <section> search</section>
    <section> ranking</section>
    <section> column</section>
    <section> news</section>
</main>
<?php get_footer(); ?>
