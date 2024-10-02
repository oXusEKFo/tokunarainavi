
<?php
$terms = get_terms(array(
    'taxonomy' => 'age_type',
    'orderby' => 'slug',
    'order' => 'ASC',
));

if (! empty($terms) && ! is_wp_error($terms)) {
    foreach ($terms as $term) {
        echo '<p>' . $term->name . '</p>';
    }
}
wp_reset_postdata();
?>
