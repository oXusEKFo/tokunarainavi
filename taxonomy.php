<!-- ランキング用 -->
<?php get_template_part('template-parts/ranking'); ?>


<?php get_header(); ?>
<main>
    <?php get_template_part('template-parts/search', 'ranking'); ?>

    <?php if (have_posts()): ?>

        <?php
        while (have_posts()): the_post(); ?>

            <?php get_template_part('template-parts/loop', 'classroom'); ?>

        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
