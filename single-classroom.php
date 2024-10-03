<!-- ランキング用 -->
<?php
add_action('wp', function () {
    // 检查是否是在 'classroom' 文章类型的 'class-room-type' 分类页面
    if (is_tax('class-room-type')) {
        $term_id = get_queried_object_id(); // 获取当前分类的 ID
        increment_term_view_count($term_id); // 增加浏览次数
    }
});
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
