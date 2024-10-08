<?php
get_header();
?>
<main>
    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <h2><?php the_title(); ?></h2>
        <?php endwhile; ?>
    <?php endif; ?>
</main>
<? get_footer(); ?>
