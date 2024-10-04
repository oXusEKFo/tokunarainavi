<!-- ランキング用 -->
<?php
$post_id = get_the_ID();
$terms = wp_get_post_terms($post_id, 'classtype');

if (!empty($terms) && !is_wp_error($terms)) {
    $term_id = $terms[0]->term_id;
    increment_term_view_count($term_id);
}
?>

<!-- 投稿のランキング用 -->
<?php
$cookie_name = 'post_views_' . $post->ID;

if (!isset($_COOKIE[$cookie_name])) {
    global $post;

    $current_views = get_post_meta($post->ID, 'post_views', true);
    if ($current_views === '') {
        $current_views = 0;
    }
    $current_views = intval($current_views);

    $new_views = $current_views + 1;
    update_post_meta($post->ID, 'post_views', $new_views);
    setcookie($cookie_name, '1', time() + 3600, COOKIEPATH, COOKIE_DOMAIN);
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
