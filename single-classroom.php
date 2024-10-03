<!-- ランキング用 -->
<!-- <?php

        if (is_tax('classtype')) {
            $term_id = get_queried_object_id();
            increment_term_view_count($term_id); // 增加查看次数
        }
        ?> -->

<?php
function display_term_view_count($term_id)
{
    // 获取当前分类的浏览次数
    $view_count = (int) get_term_meta($term_id, 'view_count', true);

    // 显示浏览次数
    echo '<p>' . $term_id . '浏览次数: ' . $view_count . '</p>';
}
?>
<?php get_header(); ?>
<?php
if (have_posts()):
    while (have_posts()): the_post();
?>
        <h1><?php echo the_title(); ?></h1>




<?php
    endwhile;
    wp_reset_postdata();
endif;
?>

<?php get_footer(); ?>
