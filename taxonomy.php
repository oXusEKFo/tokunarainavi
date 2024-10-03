<?php get_header(); ?>
<main>
    <?php

    $args = [
        'title_li' => '',
    ];
    wp_list_categories($args);
    ?>
    <?php if (have_posts()): ?>

        <?php
        while (have_posts()): the_post();
            get_template_part('template-parts/loop', 'classroom');
        endwhile;
        ?>


    <?php endif; ?>
</main>
<?php get_footer(); ?>
