<?php get_header(); ?>
<main>
    <div class="breadCrumb__wrap">
        <div class="breadCrumb">
            <?php get_template_part('template-parts/breadcrumb'); ?>
        </div>
    </div>
    <div class="inner_main">

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
                        <h2>
                            <?php
                            $days = 7;  // NEWを付ける最新記事の期間(日数)
                            $today = date_i18n('U');  // 現在の時間
                            $entry = get_the_time('U');  // 投稿日の時間
                            $term = date('U', ($today - $entry)) / 86400;   // 投稿日からの日数を算出(60x60x24=86400s)
                            if ($days > $term) {
                                echo '<span class="new">NEW</span>'; //  条件合致時に表示する文字
                            }
                            ?>
                            <?php the_title(); ?>
                        </h2>
                    </div>
                    <div class="column_content">
                        <?php the_content(); ?>
                    </div>
                </article>

                <!-- 関連施設を取得する -->
                <?php
                $args = [
                    'post_type' => 'classroom',
                ];

                $meta_query = ['relation' => 'AND'];
                $meta_query[] = [
                    'key' => "colunmid",
                    'type' => "CHAR",
                    'value' => get_the_ID(),
                    'compare' => '=',
                ];
                $args['meta_query'] = $meta_query;
                $the_query = new WP_Query($args);
                // print_r($the_query);
                ?>
                <section class="wrap__link">
                    <h2 class="link__title">関連施設</h2>
                    <?php if (!empty($the_query)): ?>
                        <div class="link__flex">
                            <?php while ($the_query->have_posts()): $the_query->the_post(); ?>

                                <p><a href="<?php the_permalink(); ?>" class="link__button"><?php the_title(); ?></a></p>

                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </section>

                <!-- ↓前後記事のリンク -->
                <div class="navi">
                    <div class="pre__navi">
                        <?php $pre_post = get_previous_post(true, '', 'column_type'); ?>
                        <?php if ($pre_post):
                        ?>
                            <?php $pre_link = get_permalink($pre_post) ?>
                            <a class="pre__link" href="<?= esc_url($pre_link) ?>">
                                <span class="pre__btn">&lt;前の記事</span>
                            </a>
                        <?php endif;
                        ?>
                    </div>
                    <div class="next__navi">
                        <?php $next_post = get_next_post(true, '', 'column_type'); ?>
                        <?php if ($next_post): ?>
                            <?php $next_link = get_permalink($next_post) ?>
                            <a class="next__link" href="<?= esc_url($next_link) ?>">
                                <span class="next__btn">次の記事&gt;</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <aside class="related">
                <div class="wrap_related">
                    <div class="container_related-title">
                        <h2>関連記事</h2>
                    </div>
                    <?php
                    $post_ID = get_the_ID();
                    $args = [
                        'post_type' => 'column',
                        'posts_per_page'     => 3,
                        'post__not_in' => array($post_ID),
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

                    </p>
                </div>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>
