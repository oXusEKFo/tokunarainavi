<?php get_header(); ?>

<main>

    <!-- パンくず -->
    <div class="breadCrumb__wrap">
        <div class="breadCrumb">
            <?php get_template_part('template-parts/breadcrumb'); ?>
        </div>
    </div>

    <div class="news">
        <div class="inner__main">

            <!-- wrap__newsここから -->
            <div class="wrap__news">
                <div class="container__news">

                    <!-- ニュース記事タイトル -->
                    <div class="tag__news">
                        <h1><?php the_title(); ?></h1>
                        <!-- 日付 -->
                        <div class="subtag__news">
                            <div class="small__category">
                                <?php
                                // 現在の投稿に関連付けられているカテゴリーを取得
                                $categories = get_the_category();

                                if (! empty($categories)) {
                                    foreach ($categories as $category) {
                                        echo '<p>' . esc_html($category->name) . '</p>';
                                    }
                                }
                                ?>
                            </div>
                            <p><time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日') ?> </time></p>
                        </div>
                    </div>

                    <div class="note__news">
                        <p><?php the_content(); ?></p>
                    </div>

                </div> <!-- container__news -->


                <div class="navi">
                    <!-- 前の記事リンク -->
                    <div class="pre__navi">
                        <?php
                        $prev_post = get_previous_post(true, '', 'category');
                        if ($prev_post) {
                            $prev_link = get_permalink($prev_post->ID);
                            echo '<a href="' . esc_url($prev_link) . '" class="btn__prev">
                    <span class="prev">&lt;</span> 前の記事
                </a>';
                        }
                        // 記事が存在しない場合、空の <div> をそのまま出力
                        ?>
                    </div>

                    <!-- 次の記事リンク -->
                    <div class="next__navi">
                        <?php
                        $next_post = get_next_post(true, '', 'category');
                        if ($next_post) {
                            $next_link = get_permalink($next_post->ID);
                            echo '<a href="' . esc_url($next_link) . '" class="btn__next">
                    次の記事 <span class="next">&gt;</span>
                </a>';
                        }
                        // 記事が存在しない場合、空の <div> をそのまま出力
                        ?>
                    </div>
                </div>


            </div> <!-- wrap__news -->

        </div> <!-- inner_main -->
    </div> <!-- news -->
</main>


<?php get_footer(); ?>
