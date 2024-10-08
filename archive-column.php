<?php get_header(); ?>
<main>
    <!--パンくずリスト-->
    <?php get_template_part('template-parts/breadcrumb'); ?>


    <h1>コラム一覧</h1>
    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <div>
                <?php get_template_part('template-parts/loop', 'column'); ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>

</main>
<?php get_footer(); ?>
