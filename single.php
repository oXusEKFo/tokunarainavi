<?php get_header(); ?>

<main>
    <div class="news">
        <div class="inner_main">
            <!-- パンくず -->
            <div class="container_breadCrumb">
                <div class="breadCrumb">
                    <?php
                    get_template_part('template-parts/breadcrumb');
                    ?>
                </div>
            </div>


            <div class="news__area">
                <div class="wrap__news">
                    <div class="container__news">

                        <div class="news-more">
                            <!-- ニュース記事タイトル -->
                            <h1 class="news-more__title"><?php the_title(); ?></h1>
                            <!-- 日付 -->
                            <p><?php echo get_the_date(); ?></p>
                        </div>

                        <div class="note__news">
                            <p class="news-more__content"><?php the_content(); ?></p>
                        </div>


                    </div> <!-- container__news -->
                </div> <!-- wrap__news -->
            </div> <!-- news__area -->


        </div> <!-- inner_main -->
    </div> <!-- news -->
</main>


<?php get_footer(); ?>
