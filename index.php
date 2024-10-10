<?php get_header(); ?>

<main>

    <div class="news">
        <div class="inner__main">

            <!-- パンくず -->
            <div class="container__breadCrumb">
                <div class="breadCrumb">
                    <p><?php
                        get_template_part('template-parts/breadcrumb');
                        ?>
                        <span class="underLine"></span>
                    </p>
                </div>
            </div>

            <!-- news__areaここから -->
            <div class="news__area">
                <div class="title__news">
                    <h1>NEWS</h1>
                    <p>新着情報</p>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/creamcircle.png" alt="クリーム色の丸" width="150" height="150">
                </div>

                <div class="wrap__news">
                    <div class="container__news">
                        <div class="items__news">
                            <ul>

                                <?php
                                $args = [
                                    'post_type' => 'post',
                                ];
                                $the_query = new WP_Query($args);
                                if ($the_query->have_posts()):
                                    while ($the_query->have_posts()): $the_query->the_post();
                                ?>

                                        <li class="item__news">
                                            <a href="<?php the_permalink(); ?>">
                                                <div class="tag__news">
                                                    <h2><?php the_title(); ?></h2>
                                                    <p><time datetime="<?php the_time('y-m-d'); ?>"><?php the_time('y.m.d') ?> </time></p>
                                                </div>
                                                <div class="note__news">
                                                    <p><?php echo the_excerpt(); ?></p>
                                                </div>
                                            </a>
                                        </li>

                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                <?php endif ?>

                            </ul>

                            <p class="page">&lt; 1 2 3 &gt;</p>

                        </div> <!-- items__newsここまで -->
                    </div> <!-- container__newsここまで -->
                </div> <!-- wrap__newsここまで -->

            </div> <!-- news__areaここまで -->

        </div>
    </div>

</main>

<?php get_footer(); ?>
