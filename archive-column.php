<?php get_header(); ?>
<main>
    <!--  -->
    <div class="inner__main">
        <div class="container__breadCrumb">
            <div class="breadCrumb">
                <?php get_template_part('template-parts/breadcrumb'); ?>
            </div>
        </div>
        <?php
        $colurmn_terms = get_terms(['taxonomy' => 'column_type']);
        ?>
        <?php
        if (!empty($colurmn_terms)): ?>
            <?php foreach ($colurmn_terms as $column): ?>
                <div>
                    <a href="<?php echo get_term_link($column);
                                ?>"><?= $column->name ?></a>
                </div>
            <?php endforeach; ?>
        <?php endif ?>
        <!-- コラム一覧カード -->
        <div class="column__area">
            <div class="column__title">
                <h1>COLUMN</h1>
                <p>コラム</p>
            </div>
            <!-- スライダー ここから -->
            <div class="inner__column-area">
                <?php
                $args = [
                    'post_type' => 'column',
                    // 'posts_per_page'     => 5,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ];
                $column_query = new WP_query($args); ?>
                <?php
                if ($column_query->have_posts()):
                ?>
                    <?php while ($column_query->have_posts()): $column_query->the_post(); ?>
                        <div class="wrap__column-card">
                            <?php get_template_part('template-parts/loop', 'column'); ?>
                        </div>
                    <?php endwhile; ?>
                    <!-- <?php wp_reset_postdata(); ?> -->
                <?php endif ?>
            </div>
        </div>
        <!-- コラムカードここまで -->

        <div class="column__footer">
            <div class="container__page-num">

                <?php if (function_exists('wp_pagenavi')):  ?>
                    <div class="column_page-num">
                        <?php wp_pagenavi(); ?>
                    </div>
                <?php endif;  ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
