<!-- ランキング用 -->
<?php

if (is_tax('classtype')) {
        $term_id = get_queried_object_id();
        increment_term_view_count($term_id); // 增加查看次数
}
?>



<?php get_header(); ?>
<main>
        <?php get_template_part('template-parts/search', 'randing'); ?>

        <?php if (have_posts()): ?>

                <?php
                while (have_posts()): the_post();
                        get_template_part('template-parts/loop', 'classroom');
                endwhile;
                ?>


        <?php endif; ?>
</main>
<?php get_footer(); ?>
