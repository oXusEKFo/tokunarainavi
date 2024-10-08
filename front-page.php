<?php get_header(); ?>

<main>
    <div class="inner__main">
        <section class="landing">
            <div class="inner__landing">
                <!-- KV -->
                <div class="wrap__kv">
                    <div class="container__kv-Mo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/kv_mo.png" alt="kv_mobile">
                    </div>
                    <div class="container__kv-Pc">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/kv_p.png" alt="kv_pc">
                    </div>
                </div>

                <!-- about me -->
                <div class="about">
                    <?php
                    $args = [
                        'post_type' => 'page',
                        'post__in' => ['174'], // サーバ環境用
                    ];
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()):
                        while ($the_query->have_posts()): $the_query->the_post();
                    ?>
                            <div class="container__about">
                                <div class="note__about">
                                    <!-- 抜粋 -->
                                    <h2><?php echo the_excerpt(); ?></h2>
                                </div>
                                <div class="image__about">
                                    <!-- アイキャッチ画像 -->
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="about">
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif ?>
                </div>
            </div>
        </section>
        <!-- 白背景の余白スペース -->
        <div class="clearance"></div>
        <!-- search -->
        <section class="search">
            <div class="container__search">
                <div class="title__search">
                    <h1>SERACH</h1>
                    <p>検索</p>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/greencircle.png" alt="みどり円">
                </div>
                <div class="options__search">
                    <ul>
                        <li class="option__search">エリアを選ぶ</li>
                        <!-- <?php get_template_part('template-parts/search', 'area'); ?> -->
                        <li class="option__search">年齢を選ぶ</li>
                        <!-- <?php get_template_part('template-parts/search', 'age'); ?> -->
                        <li class="option__search">ジャンルを選ぶ</li>
                        <!-- <?php get_template_part('template-parts/search', 'classtype'); ?> -->
                        <li class="detail__search">詳細検索ページへ</li>
                    </ul>
                    <div class="box__search">
                        <div class="inner__search-box">
                            <input type="search" placeholder="キーワードを入力してください" value="">
                            <button>
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <button class="button__more-search">
                    <a href="">詳細検索は<br>こちら</a>
                </button>
            </div>
        </section>
        <!-- 白背景の余白スペース -->
        <div class="clearance"></div>
        <!-- ランキング -->
        <section class="ranking">
            <div class="inner__ranking">
                <div class="title__ranking">
                    <h1>RANKING</h1>
                    <p>アクセスランキング</p>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/creamcircle.png" alt="クリーム円">
                </div>
                <div class="order__ranking">
                    <ul>
                        <?php
                        $args = [
                            'taxonomy'   => 'classtype',
                            'meta_key'   => 'view_count',        // view _ countメタデータを使用したソート
                            'orderby'    => 'meta_value_num',    // 数値でソート
                            'order'      => 'DESC',              // 降順に並べる
                            'hide_empty' => false,               // 関連付けられていない記事の分類を表示
                            'number'     => 5,                   // 上位5分類のみ表示
                        ];
                        $argc = [
                            'taxonomy'   => 'classtype',
                            'orderby' => 'slug',
                        ];

                        $terms = get_terms($args);
                        $termc = get_terms($argc);

                        if (!empty($terms) && !is_wp_error($terms)) :
                            $number = 0;
                            foreach ($terms as $term) {
                                if (strpos($term->slug, 'class') !== false) {
                                    continue;
                                }
                                $number++;
                                $view_count = get_term_meta($term->term_id, 'view_count', true);
                                $term_link = get_term_link($term); // 分類リンクの取得
                                if (!is_wp_error($term_link)) :
                        ?>
                                    <li class="order">
                                        <a href="<?php echo esc_url($term_link); ?>"><?php echo  esc_html($term->name); ?>

                                            <?php
                                            echo '回数: ' . esc_html($view_count);
                                            ?></a>
                                    </li>
                                <?php endif; ?>
                        <?php
                            }

                        endif;
                        ?>
                    </ul>
                </div>
            </div>
        </section>
        <!-- 白背景の余白スペース -->
        <div class="clearance"></div>
        <!-- とくしまの習いごとアンケート -->
        <section class="survey-results">
            <div class="inner__survey">
                <div class="banner__survey">
                    <a href="">とくしまの習いごとアンケート</a>
                </div>
            </div>
        </section>
        <!-- column -->

        <section class="column">
            <div class="inner__column">
                <div class="title__column">
                    <h1>COLUMN</h1>
                    <p>コラム</p>
                </div>
                <!-- スライダー ここから -->
                <div class="slider">
                    <div class="auto-slider">
                        <?php
                        $args = [
                            'post_type' => 'column',
                            'posts_per_page'     => 5,
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                        ];
                        $column_query = new WP_query($args);
                        if ($column_query->have_posts()):
                        ?>
                            <?php while ($column_query->have_posts()): $column_query->the_post(); ?>
                                <?php get_template_part('template-parts/loop', 'column'); ?>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php endif ?>
                    </div>
                </div>
                <!-- スライダー ここまで -->
                <button class="button__more-column">
                    <a href="">コラムを<br>もっと見る</a>
                </button>
            </div>
        </section>
        <!-- 白背景の余白スペース -->
        <div class="clearance"></div>
        <!-- NEWS -->

        <section class="news">
            <div class="title__news">
                <h1>NEWS</h1>
                <p>新着情報</p>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/creamcircle.png" alt="クリーム円">
            </div>
            <!-- ここからニュース記事 -->
            <?php if (have_posts()) : ?>
                <div class="wrap__news">
                    <div class="container__news">
                        <div class="items__news">
                            <ul>
                                <?php
                                $news = get_term_by('slug', 'news', 'category');
                                $news_link = get_term_link($news, 'category');
                                ?>
                                <?php while (have_posts()) : the_post(); ?>
                                    <?php get_template_part('template-parts/loop', 'news'); ?>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            </ul>
                        </div>
                        <button class="button__more-news">
                            <a href="<?php echo $news_link; ?>">新着情報を<br>もっと見る</a>
                        </button>
                    </div>
                </div>
            <?php endif ?>
        </section>
        <!-- 白背景の余白スペース -->
        <div class="clearance"></div>
        <!-- end news -->

    </div>
</main>
<?php get_footer(); ?>
