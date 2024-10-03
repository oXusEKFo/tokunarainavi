<?php get_header(); ?>
<?php
// echo "<pre>";
// var_dump();

$area_slug = get_query_var('area');
// $area = get_term_by('slug', $area_slug, 'area');
// $termchildren = get_term_children($area->term_id, 'area');

$args = [
    'post_type' => 'classroom',
    'posts_per_page' => -1,
];
$taxquerysp = ['relation' => 'AND'];

if (!empty($area_slug)) {
    $taxquerysp[] = [
        'taxonomy' => 'area',
        'terms' => $area_slug,
        'field' => 'slug',
    ];
}

$args['tax_query'] = $taxquerysp;
$the_query = new WP_Query($args);
?>

<main>
    <h1>検索結果（<?php //echo $the_query->found_posts;
                ?>件）</h1>

    <div>
        <?php if ($the_query->have_posts()): ?>
            <?php while ($the_query->have_posts()): ?>
                <?php $the_query->the_post(); ?>

                <div>
                    <?php the_permalink(); ?>
                    <?php $pic = get_field('eyecatch');
                    // $pic_url=$pic['url'];
                    ?>
                    <?php //echo $pic_url;
                    ?>
                    <?php the_field('classroom_name'); ?>
                    <?php the_field('description'); ?>

                    <?php get_template_part('template-parts/loop', 'classroom'); ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endwhile; ?>
        <?php else: ?>
            <h4>条件に合う習いごとは見つかりませんでした。</h4>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
