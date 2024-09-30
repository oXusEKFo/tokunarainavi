<!-- header.phpを読み込む -->
<?php
get_header();
?>

<main>
    <!-- パンくずリスト -->
    <?php get_template_part('template-parts/breadcrumb'); ?>

    <article>
        <h2>見出しです。</h2>
        <p>文章です。文章です。文章です。文章です。文章です。文章です。</p>
    </article>
</main>

<!-- footer.phpを読み込む -->
<?php
get_footer();
?>
