<!-- ランキング用 -->
<?php
$post_id = get_the_ID();
$terms = wp_get_post_terms($post_id, 'classtype');

if (!empty($terms) && !is_wp_error($terms)) {
    $term_id = $terms[0]->term_id;
    increment_term_view_count($term_id);
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
