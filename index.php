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

                    <ul class="category__news">
                        <?php
                        // カテゴリーを取得
                        $categories = get_categories();

                        // 自分の好きな順番を指定（スラッグ名の配列）
                        $custom_order = ['news', 'update', 'events', 'others']; // スラッグ名を指定

                        // スラッグ名をキーとする連想配列を作成
                        $ordered_categories = [];
                        foreach ($categories as $category) {
                            $ordered_categories[$category->slug] = $category; // スラッグをキーにしてカテゴリーを格納
                        }

                        // 現在のカテゴリー情報を取得
                        $current_category = get_queried_object();
                        $current_slug = isset($current_category->slug) ? $current_category->slug : '';

                        // 指定した順番にカテゴリーを出力
                        foreach ($custom_order as $slug) {
                            if (isset($ordered_categories[$slug])) {
                                $category = $ordered_categories[$slug]; // スラッグに対応するカテゴリーを取得
                                $cat_name = esc_html($category->name); // カテゴリー名
                                $cat_id = esc_attr($category->term_id); // カテゴリーID
                                $cat_link = esc_url(get_category_link($cat_id)); // カテゴリーリンク

                                // アクティブなカテゴリーには 'active' クラスを追加
                                $active_class = ($slug === $current_slug) ? 'active' : '';

                                echo '<li class="' . esc_attr($active_class) . '">';
                                echo '<a href="' . $cat_link . '">' . $cat_name . '</a>';
                                echo '</li>';
                            }
                        }
                        ?>
                    </ul>

                    <div class="container__news">
                        <div class="items__news">

                            <ul>

                                <?php
                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // ページ番号を取得
                                $args = [
                                    'post_type'      => 'post',
                                    'posts_per_page' => 5,
                                    'paged'          => $paged,
                                    'category_name'  => $current_slug, // 現在のカテゴリーのスラッグを指定
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

                            <!-- ページネーション -->
                            <div class="pagination">
                                <?php
                                if (function_exists('wp_pagenavi')) {
                                    wp_pagenavi(array('query' => $the_query));
                                }
                                ?>
                            </div>

                        </div> <!-- items__newsここまで -->
                    </div> <!-- container__newsここまで -->
                </div> <!-- wrap__newsここまで -->

            </div> <!-- news__areaここまで -->

        </div>
    </div>

</main>

<?php get_footer(); ?>
