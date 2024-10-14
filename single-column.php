<?php get_header(); ?>
<main>
    <!--  -->
    <div class="inner_main">
        <div class="container_breadCrumb">
            <div class="breadCrumb">
                <p>TOP &gt;コラム一覧 &gt;
                    <span class="underLine">コラム詳細</span>
                </p>
            </div>
        </div>

        <!-- コラム一覧カード -->
        <section class="column_area">
            <div class="inner_column-area">
                <article class="wrap_column">
                    <div class="wrap_edit-date">
                        <div class="edit-icon">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/pencil.png" alt="編集アイコン">
                        </div>
                        <time class="edit_date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日') ?>
                        </time>
                    </div>
                    <div class="column_title">
                        <h2><?php the_title(); ?></h2>
                    </div>
                    <div class="column_content">
                        <?php the_content(); ?>
                    </div>
                </article>
            </div>
            <aside class="related">
                <div class="wrap_related">
                    <div class="container_related-title">
                        <h2>関連記事</h2>
                    </div>
                    <?php
                    $args = [
                        'post_type' => 'column',
                        'posts_per_page'     => 5,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ];
                    $column_query = new WP_query($args); ?>
                    <?php
                    if ($column_query->have_posts()):
                    ?>
                        <div class="inner_related-area">
                            <?php while ($column_query->have_posts()): $column_query->the_post(); ?>
                                <div class="wrap_column-card">
                                    <?php get_template_part('template-parts/loop', 'column'); ?>
                                </div>
                                <?php wp_reset_postdata(); ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif ?>
                </div>
            </aside>
        </section>
        <!-- コラムカードここまで -->

        <section class="footer_column">
            <div class="container_pageNum">
                <div class="column_pageNum">
                    <p>
                        &lt　1　2　3　&gt
                    </p>
                </div>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>
