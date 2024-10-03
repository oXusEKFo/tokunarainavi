<?php get_header(); ?>

<main>
    <!-- ページタイトルを表示 -->
    <h1><?php the_title(); ?></h1>

    <!-- ページのコンテンツを表示 -->
    <div>
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                the_content(); // ページの本文を表示
            endwhile;
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>
