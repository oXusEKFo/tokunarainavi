<?php get_header(); ?>

<main>

    <div class="news">
        <div class="inner_main">

            <!-- パンくず -->
            <div class="container_breadCrumb">
                <div class="breadCrumb">
                    <p><?php
                        get_template_part('template-parts/breadcrumb');
                        ?>
                        <span class="underLine"></span>
                    </p>
                </div>
            </div>

            <!-- news_areaここから -->
            <div class="news_area">
                <div class="title_news">
                    <h1>NEWS</h1>
                    <p>新着情報</p>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/creamcircle.png" alt="クリーム色の丸" width="150" height="150">
                </div>

                <div class="wrap_news">
                    <div class="container_news">
                        <div class="items_news">
                            <ul>

                                <?php
                                $args = [
                                    'post_type' => 'post',
                                ];
                                $the_query = new WP_Query($args);
                                if ($the_query->have_posts()):
                                    while ($the_query->have_posts()): $the_query->the_post();
                                ?>

                                        <li class="item_news">
                                            <a href="<?php the_permalink(); ?>">
                                                <div class="tag_news">
                                                    <h2><?php the_title(); ?></h2>
                                                    <p><time datetime="<?php the_time('y-m-d'); ?>"><?php the_time('y.m.d') ?> </time></p>
                                                </div>
                                                <div class="note_news">
                                                    <p><?php echo the_excerpt(); ?></p>
                                                </div>
                                            </a>
                                        </li>

                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                <?php endif ?>

                            </ul>

                            <p class="page">&lt; 1 2 3 &gt;</p>

                        </div> <!-- items_newsここまで -->
                    </div> <!-- container_newsここまで -->
                </div> <!-- wrap_newsここまで -->

            </div> <!-- news_areaここまで -->

        </div>
    </div>

</main>

<?php get_footer(); ?>
