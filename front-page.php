<?php get_header(); ?>
<?php
wp_enqueue_style('test', get_template_directory_uri() . '/assets/css/test.css');
wp_enqueue_script('test_js', get_template_directory_uri() . '/assets/js/test.js');
?>
<link href="../../assets/css/searchpopup.css" rel="stylesheet" />
<main>
    <div class="inner__main">
        <section class="landing">
            <div class="inner__landing">
                <!-- KV 静的-->
                <div class="wrap__kv">
                    <div class="container__kv-Mo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/kv_mo.png" alt="kv_mobile">
                    </div>
                    <div class="container__kv-Pc">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/kv_p.png" alt="kv_pc">
                    </div>
                </div>
                <!-- end KV -->

                <!-- about 動的 -->
                <div class="about">
                    <?php
                    $args = [
                        'post_type' => 'page',
                        'post__in' => ['174'],
                    ];
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()):
                        while ($the_query->have_posts()): $the_query->the_post();
                    ?>
                            <div class="container__about">
                                <div class="note__about">
                                    <?php echo the_excerpt(); ?>
                                </div>
                                <div class="image__about">
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="about">
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif ?>
                </div>
                <!-- end about -->

            </div>
        </section>

        <!-- 白背景の余白スペース -->
        <div class="clearance"></div>

        <!-- 検索search -->
        <section class="search">
            <div class="container__search">
                <div class="title__search">
                    <h1>SERACH</h1>
                    <p>検索</p>
                    <img src="<?php echo get_template_directory_uri();  ?>/assets/images/matcha.png" alt="みどり円">
                </div>
                <div class="options__search">
                    <!-- エリアを選ぶ -->
                    <button class="option__search" onclick="togglePopup('popup_area')">エリアを選ぶ</button>
                    <div class="overlay" style="display: none;"></div>
                    <div class="search_container" id="popup_area" style="display: none;">
                        <div class="close_button" onclick="closePopup()">&times;</div> <!-- &times; --× -->
                        <div class="search_header">
                            <h1>エリアを選ぶ</h1>
                        </div>
                        <form method="GET" action="<?php echo home_url(); ?>">
                            <input type="hidden" name="s" value="">

                            <!-- 徳島市全域area01 -->
                            <div class="search_options">
                                <?php
                                $parent_term = get_term_by('slug', 'area01', 'area');
                                $child_terms = get_terms(array(
                                    'taxonomy' => 'area',
                                    'parent' => $parent_term->term_id,
                                    'hide_empty' => false,
                                    'orderby' => 'slug',
                                    'order' => 'ASC',
                                ));
                                ?>
                                <label class="accordion_item full_width">
                                    <input type="checkbox" onclick="selectAll('<?php echo $parent_term->slug; ?>', this);"> <?php echo $parent_term->name; ?>
                                </label>
                                <div id="<?php echo $parent_term->slug; ?>" class="single_column">
                                    <!-- 徳島市全域の子要素 -->
                                    <?php
                                    if (!empty($child_terms) && !is_wp_error($child_terms)) :
                                        foreach ($child_terms as $child_term) :
                                    ?>
                                            <label class="accordion_item">
                                                <input type="checkbox" name="area[]" value="<?php echo $child_term->slug; ?>" onclick="selectItem(this)">
                                                <?php echo $child_term->name; ?>
                                            </label>
                                    <?php
                                        endforeach;
                                        wp_reset_postdata();
                                    endif;
                                    ?>
                                </div>

                                <!-- 板野郡全域area02 -->
                                <?php
                                $parent_term = get_term_by('slug', 'area02', 'area');
                                $child_terms = get_terms(array(
                                    'taxonomy' => 'area',
                                    'parent' => $parent_term->term_id,
                                    'hide_empty' => false,
                                    'orderby' => 'slug',
                                    'order' => 'ASC',
                                ));
                                ?>
                                <label class="accordion_item full_width">
                                    <input type="checkbox" onclick="selectAll('<?php echo $parent_term->slug; ?>', this);"> <?php echo $parent_term->name; ?>
                                </label>
                                <div id="<?php echo $parent_term->slug; ?>" class="double_column">
                                    <!-- 板野郡全域の子要素 -->
                                    <?php
                                    if (!empty($child_terms) && !is_wp_error($child_terms)) :
                                        foreach ($child_terms as $child_term) :
                                    ?>
                                            <label class="accordion_item">
                                                <input type="checkbox" name="area[]" value="<?php echo $child_term->slug; ?>" onclick="selectItem(this)">
                                                <?php echo $child_term->name; ?>
                                            </label>
                                    <?php
                                        endforeach;
                                        wp_reset_postdata();
                                    endif;
                                    ?>
                                </div>

                                <!-- 徳島市と板野郡以外の域 -->
                                <div class="double_column">
                                    <?php
                                    $terms = get_terms(array(
                                        'taxonomy' => 'area',
                                        'hide_empty' => false,
                                        'orderby' => 'slug',
                                        'order' => 'ASC',
                                    ));
                                    if (!empty($terms) && !is_wp_error($terms)) :
                                        foreach ($terms as $term) :
                                            if ($term->parent == 0 && $term->slug !== 'area01' && $term->slug !== 'area02') :
                                    ?>
                                                <label class="accordion_item">
                                                    <input type="checkbox" name="area[]" value="<?php echo $term->slug; ?>" onclick="selectItem(this)">
                                                    <?php echo $term->name; ?>
                                                </label>
                                    <?php
                                            endif;
                                        endforeach;
                                        wp_reset_postdata();
                                    endif;
                                    ?>
                                </div>

                                <div class="search_actions">
                                    <button type="submit" class="search_button">この条件で検索する</button>
                                    <div class="additional-buttons">
                                        <button type="button" onclick="toggleAgePopup()">年齢も選ぶ</button>
                                        <button type="button" onclick="toggleGenrePopup()">ジャンルも選ぶ</button>
                                    </div>
                                    <button type="button" class="clear_button" onclick="clearSelections()">すべてクリア</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- end エリアを選ぶ -->

                    <!-- 年齢を選ぶ -->
                    <button class="option__search" onclick="togglePopup('popup_age')">年齢を選ぶ</button>
                    <div class="overlay"></div>
                    <div class="search_container" id="popup_age" style="display: none;">
                        <div class="close_button" onclick="closePopup()">&times;</div>
                        <div class="search_header">
                            <h1>年齢を選ぶ</h1>
                        </div>
                        <form method="GET" action="<?php echo home_url(); ?>">
                            <input type="hidden" name="s" value="">
                            <div class="search_options">
                                <div class="double_column">
                                    <?php
                                    $terms = get_terms(array(
                                        'taxonomy' => 'age_type',
                                        'hide_empty' => false,
                                        'orderby' => 'slug',
                                        'order' => 'ASC',
                                    ));
                                    if (!empty($terms)):
                                        foreach ($terms as $term) :
                                    ?>
                                            <label class="accordion_item">
                                                <input type="checkbox" name="age_type" value="<?php echo $term->slug; ?>" onclick="selectItem(this)">
                                                <?php echo $term->name; ?>
                                            </label>
                                    <?php
                                        endforeach;
                                        wp_reset_postdata();
                                    endif;
                                    ?>
                                </div>
                            </div>
                            <div class="search_actions">
                                <button class="search_button" type="submit">この条件で検索する</button>
                                <div class="additional-buttons">
                                    <button onclick="toggleAreaPopup()">エリアも選ぶ</button>
                                    <button onclick="toggleGenrePopup()">ジャンルも選ぶ</button>
                                </div>
                                <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                            </div>
                        </form>
                    </div>
                    <!-- end 年齢を選ぶ -->

                    <!-- ジャンルを選ぶ -->
                    <button class="option__search" onclick="togglePopup('popup_genre')">ジャンルを選ぶ</button>
                    <div class="overlay"></div>
                    <div class="search_container" id="popup_genre" style="display: none;">
                        <div class="close_button" onclick="closePopup()">&times;</div>
                        <div class="search_header">
                            <h1>ジャンルを選ぶ</h1>
                        </div>
                        <form method="GET" action="<?php echo home_url(); ?>">
                            <input type="hidden" name="s" value="">
                            <div class="search_options">
                                <?php
                                $parent_terms = get_terms(array(
                                    'taxonomy' => 'classtype',
                                    'hide_empty' => false,
                                    'orderby' => 'slug',
                                    'order' => 'ASC',
                                ));

                                if (!empty($parent_terms) && !is_wp_error($parent_terms)):
                                    foreach ($parent_terms as $parent_term):
                                        if ($parent_term->parent == 0):
                                ?>
                                            <label class="search_option_suboption">
                                                <input type="checkbox" onclick="toggleAccordion('<?php echo $parent_term->slug; ?>')"> <?php echo $parent_term->name; ?><span class="plus">&#x2B;</span>
                                                </button>
                                            </label>

                                            <div id="<?php echo $parent_term->slug; ?>" class="accordion_content">

                                                <label class="accordion_item full_width">
                                                    <input type="checkbox" onclick="selectAll('<?php echo $parent_term->slug; ?>', this);">
                                                    <?php echo $parent_term->name; ?> をすべて選択
                                                </label>
                                                <div id="<?php echo $parent_term->slug; ?>_list" class="double_column">
                                                    <?php
                                                    $child_terms = get_terms(array(
                                                        'taxonomy' => 'classtype',
                                                        'parent' => $parent_term->term_id,
                                                        'hide_empty' => false,
                                                        'orderby' => 'slug',
                                                        'order' => 'ASC',
                                                    ));

                                                    if (!empty($child_terms) && !is_wp_error($child_terms)):
                                                        foreach ($child_terms as $child_term):
                                                    ?>
                                                            <label class="accordion_item">
                                                                <input type="checkbox" name="classtype" value="<?php echo $child_term->slug; ?>" onclick="selectItem(this)">
                                                                <?php echo esc_html($child_term->name); ?>
                                                            </label>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </div>
                                            </div>
                                <?php
                                        endif;
                                    endforeach;
                                endif;
                                ?>
                                <div class="search_actions">
                                    <button type="submit" class="search_button" onclick="">この条件で検索する</button>
                                    <div class="additional-buttons">
                                        <button onclick="toggleAreaPopup()">エリアも選ぶ</button>
                                        <button onclick="toggleAgePopup()">年齢も選ぶ</button>
                                    </div>
                                    <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                                </div>
                        </form>
                    </div>
                </div>
                <!-- end ジャンルを選ぶ -->

                <button class="detail__search" onclick="window.location.href='<?php echo home_url(); ?>/?s='">詳細検索ページへ</button>

                <!-- キーワード検索 -->
                <form action="<?php echo home_url('/'); ?>" method="get">
                    <div class="box__search">
                        <div class="inner__search-box">
                            <input class="window__search" type="search" name="s" value="<?php the_search_query(); ?>" placeholder="キーワードを入力してください">
                            <button class="btn__search" type="submit"> <i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </form>
                <!-- end キーワード検索 -->
            </div>
            <!-- <button class="button__more-search">
                        <a href="<?php echo home_url(); ?>/?s=">詳細検索は<br>こちら</a>
                    </button> -->
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
                <form method="GET" action="<?php echo home_url(); ?>">
                    <input type="hidden" name="s" value="">
                    <?php
                    $args = [
                        'taxonomy'   => 'classtype',
                        'meta_key'   => 'view_count',        // view _ countメタデータを使用したソート
                        'orderby'    => 'meta_value_num',    // 数値でソート
                        'order'      => 'DESC',              // 降順に並べる
                        'hide_empty' => false,               // 関連付けられていない記事の分類を表示
                        'number'     => 5,                   // 上位5分類のみ表示
                    ];
                    $terms = get_terms($args);
                    ?>
                    <ul>
                        <?php
                        if (!empty($terms) && !is_wp_error($terms)) :
                            foreach ($terms as $term) :
                                if (strpos($term->slug, 'class') !== false) {
                                    continue;
                                }
                                $view_count = get_term_meta($term->term_id, 'view_count', true);
                        ?>
                                <li class="order">
                                    <button type="submit" name="classtype[]" value="<?php echo $term->slug; ?>">
                                        <?php echo $term->name; ?>
                                        <small>
                                            <?php
                                            echo 'click' . esc_html($view_count);
                                            ?>
                                        </small>
                                    </button>
                                </li>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </ul>
                </form>
            </div>
        </div>
    </section>
    <!-- 白背景の余白スペース -->
    <div class="clearance"></div>
    <!-- とくしまの習いごとアンケート -->
    <div class="survey-results">
        <div class="inner__survey">
            <div class="banner__survey">
                <a href="<?php echo home_url('/fushion'); ?>">徳島の習いごと事情</a>
            </div>
        </div>
    </div>
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
                    $column_query = new WP_query($args); ?>
                    <?php
                    if ($column_query->have_posts()):
                    ?>
                        <?php while ($column_query->have_posts()): $column_query->the_post(); ?>
                            <div class="inner__slider">
                                <div class="wrap__card">
                                    <a href="<?php echo the_permalink(); ?>">
                                        <div class="container__card">
                                            <div class="container__img">
                                                <img class="img__card" src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="施設写真">
                                            </div>
                                            <div class="container__info">
                                                <div class="title__info">
                                                    <h2><?php echo the_title(); ?></h2>
                                                </div>
                                                <div class="note__column">
                                                    <?php echo the_excerpt(); ?><!-- 抜粋 -->
                                                </div>
                                                <div class="container__date">
                                                    <div class="icon__edit">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pencil.png" alt="編集アイコン">
                                                    </div>
                                                    <time class="date__edit" datetime="<?php the_time('y-m-d'); ?>">
                                                        <?php the_time('Y年m月d日') ?>
                                                    </time>
                                                </div>
                                            </div>
                                    </a>
                                </div>
                            </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif ?>
            </div>
        </div>
        <!-- スライダー ここまで -->
        <button class=" button__more-column">
            <a href="<?php echo home_url('/column'); ?>">MORE</a>
        </button>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bear2.png" alt="Bear" class="bear__image-column">
        </div>
    </section>

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
                        <a href="<?php echo home_url('/category/news') ?>">MORE</a>
                    </button>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bear2.png" alt="Bear" class="bear__image-news">
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
