<?php
$column_slug = get_query_var('column_type');
$column = get_term_by('slug', $column_slug, 'column_type');
?>

<?php get_header(); ?>
<main>
    <div class="inner__main">
        <div class="container__breadCrumb">
            <div class="breadCrumb">
                <?php get_template_part('template-parts/breadcrumb'); ?>
            </div>
        </div>

        <!-- コラム一覧カード -->
        <div class="inner__column">
            <div class="title__column">
                <h1>COLUMN</h1>
                <p><?php single_term_title('');
                    ?></p>
            </div>
            <!-- スライダー ここから -->
            <div class="slider">
                <div class="auto-slider">
                    <?php
                    if (have_posts()):
                    ?>
                        <div class="inner__column-area">
                            <?php while (have_posts()): the_post(); ?>
                                <?php get_template_part('template-parts/loop', 'column'); ?>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
