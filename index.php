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

            <!-- news__areaここから -->
            <div class="news__area">
                <div class="title__news">
                    <h1>NEWS</h1>
                    <p>新着情報</p>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/creamcircle.png" alt="クリーム色の丸">
                </div>

                <div class="wrap__news">

                    <ul class="category__news">
                        <?php
                        // カテゴリーを取得
                        $categories = get_categories();

                        // カテゴリーを好きな順番で並べる
                        $custom_order = ['infos', 'news', 'update', 'events'];

                        // スラッグ名をキーとする連想配列を作成
                        $ordered_categories = [];
                        foreach ($categories as $category) {
                            $ordered_categories[$category->slug] = $category;
                        }

                        // 現在のカテゴリー情報を取得
                        $current_category = get_queried_object();
                        $current_slug = isset($current_category->slug) ? $current_category->slug : '';

                        // 「すべて」ページが表示されているかを確認する
                        $is_infos_page = (is_page('infos'));

                        // 指定した順番にカテゴリーを出力
                        foreach ($custom_order as $slug) {
                            if ($slug === 'infos') {
                                // 「すべて」ページのリンクに 'active' クラスを追加
                                $active_class = $is_infos_page ? 'active' : '';

                                // 「すべて」ページへのリンクを追加
                                echo '<li class="' . esc_attr($active_class) . '">';
                                echo '<a href="' . esc_url(home_url('infos')) . '">すべて</a>';
                                echo '</li>';
                            } elseif (isset($ordered_categories[$slug])) {
                                $category = $ordered_categories[$slug]; // スラッグに対応するカテゴリーを取得
                                $cat_name = esc_html($category->name); // カテゴリー名
                                $cat_id = esc_attr($category->term_id); // カテゴリーID
                                $cat_link = esc_url(get_category_link($cat_id)); // カテゴリーリンク

                                // アクティブなカテゴリーには 'active' クラスを追加
                                $active_class = ($slug === $current_slug) ? 'active' : '';

                                echo '<li class="' . esc_attr($active_class) . '">';
                                echo '<a href="' . $cat_link . '">' . $cat_name . '</a>';
                                echo '</li>';
                            } else {
                                // 投稿が0件のカテゴリーがあった場合でもリストに表示する
                                $category = get_category_by_slug($slug);
                                if ($category) {
                                    $cat_name = esc_html($category->name); // カテゴリー名
                                    $category_link = esc_url(get_category_link($category->term_id)); // リンク生成
                                    $active_class = ($slug === $current_slug) ? 'active' : '';

                                    echo '<li class="' . esc_attr($active_class) . '">';
                                    echo '<a href="' . esc_url($category_link) . '">' . $cat_name . '</a>';
                                    echo '</li>';
                                }
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
                                    'post_status'    => 'publish', // 公開済みの投稿のみを表示
                                ];
                                $the_query = new WP_Query($args);
                                if ($the_query->have_posts()):
                                    while ($the_query->have_posts()): $the_query->the_post();
                                ?>

                                        <a href="<?php the_permalink(); ?>">
                                            <li class="item__news">
                                                <div class="tag__news">
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
                                                        <p><time datetime="<?php the_time('y-m-d'); ?>"><?php the_time('y.m.d') ?> </time></p>
                                                    </div>

                                                </div>
                                                <div class="note__news">
                                                    <p><?php echo the_excerpt(); ?></p>
                                                </div>
                                            </li>
                                        </a>

                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                <?php else: ?>
                                    <li class="no__news">
                                        <p>まだ投稿がありません。</p>
                                    </li>
                                <?php endif ?>

                            </ul>

                            <!-- ページネーション -->
                            <?php if ($the_query->have_posts()): ?>
                                <div class="pagination">
                                    <?php
                                    if (function_exists('wp_pagenavi')) {
                                        wp_pagenavi(array('query' => $the_query));
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>

                        </div> <!-- items__newsここまで -->
                    </div> <!-- container__newsここまで -->
                </div> <!-- wrap__newsここまで -->

            </div> <!-- news__areaここまで -->

        </div>
    </div>

</main>

<?php get_footer(); ?>
