<?php get_header(); ?>

<main>
    <div class="inner__main">
        <div class="landing">
            <!-- KV 静的-->
            <div class="inner__landing">
                <div class="wrap__kv">
                    <div class="container__kv">
                        <!-- キャッチコピー -->
                        <h1 class="kv__title fadeIn">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/kv_title.png" alt="title" class="title__img">
                        </h1>
                        <!-- 飾り -->
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/deco1.png" alt="decoration1" class="deco1">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/deco2.png" alt="decoration2" class="deco2">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/kv_img2.png" alt="decoration3" class="deco3">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/kv_img2.png" alt="decoration4" class="deco4">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/kv_img4.png" alt="decoration5" class="deco5">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/kv_img4.png" alt="decoration6" class="deco6">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/kv_img1.png" alt="decoration7" class="deco7">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/kv_img4.png" alt="decoration8" class="deco8">
                        <!-- キャラクター -->
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/english_conversation.png" alt="英語学習" class="en_learning">

                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/soccer_player.png" alt="サッカー" class="soccer-player kick">

                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/soccer_ball.png" alt="サッカーボール" class="soccer-ball kicked-ball">
                        <!-- 新体操モバイル用 -->
                        <div class="gym">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gymnastics.png" alt="新体操" class="rg--stop">
                        </div>
                        <!-- 新体操PC用 -->
                        <div class="gym swing2">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gym.png" alt="新体操" class="rg--move">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ribbon.png" alt="リボン" class="ribbon rot">
                        </div>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/parent_child.png" alt="親子" class="cap">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/treble_clef.png" alt="四分音符" class="symbol1">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/musical_note.png" alt="音符" class="symbol2">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/awa_odori.png" alt="阿波おどり" class="awa-odori dance">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/piano.png" alt="ピアノ" class="piano">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/swimming.png" alt="水泳" class="swimming swim">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/drawing.png" alt="絵描き" class="drawing">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/stars.png" alt="星" class="stars__kv">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/sun.png" alt="太陽" class="sun">
                    </div>
                </div>
            </div>
            <!-- end KV -->

            <!-- 白背景の余白スペース -->
            <div class="clearance"></div>

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
                        <div class="container__about  box fadeIn">
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

        <!-- 白背景の余白スペース -->
        <div class="clearance"></div>

        <!-- 検索search -->
        <div class="search">
            <div class="container__search box fadeIn">

                <div class="title__search">
                    <h2>SERACH</h2>
                    <p>検索</p>
                    <img src="<?php echo get_template_directory_uri();  ?>/assets/images/matcha.png" alt="みどり円">
                </div>

                <div class="options__search">

                    <button type="button" class="option__search" onclick="togglePopup('popup_area')">エリアを選ぶ</button>
                    <button type="button" class="option__search" onclick="togglePopup('popup_age')">年齢を選ぶ</button>
                    <button type="button" class="option__search" onclick="togglePopup('popup_genre')">ジャンルを選ぶ</button>
                    <form method="GET" action="<?php echo home_url(); ?>">
                        <input type="hidden" name="s" value="">
                        <!-- エリアを選ぶ -->
                        <div class="overlay" style="display: none;"></div>
                        <div class="search_container" id="popup_area" style="display: none;">
                            <div class="close_button" onclick="closePopup()">&times;</div> <!-- &times; --× -->
                            <div class="search_header">
                                <h3>エリアを選ぶ</h3>
                            </div>
                            <!-- <form method="GET" action="<?php echo home_url(); ?>">
                            <input type="hidden" name="s" value=""> -->

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
                                ?><div id="<?= $parent_term->slug; ?>" class="accordion_content" style="display:flex">
                                    <label class="accordion_item full_width">
                                        <input type="checkbox" name="area[]" onclick="selectAll('<?php echo $parent_term->slug; ?>', this);"> <?php echo $parent_term->name; ?>
                                    </label>
                                    <!-- <div id="<?php echo $parent_term->slug; ?>" class="single_column"> -->
                                    <div class="single_column">
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
                                <div id="<?= $parent_term->slug; ?>" class="accordion_content" style="display:flex">
                                    <label class="accordion_item full_width">
                                        <input type="checkbox" name="area[]" onclick="selectAll('<?php echo $parent_term->slug; ?>', this);"> <?php echo $parent_term->name; ?>
                                    </label>
                                    <!-- <div id="<?php echo $parent_term->slug; ?>" class="double_column"> -->
                                    <!-- 板野郡全域の子要素 -->
                                    <div class="double_column">
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
                                    <button type="button" class="clear_button" onclick="clearSelections('area')">すべてクリア</button>
                                </div>
                            </div>
                            <!-- </form> -->

                        </div>
                        <!-- end エリアを選ぶ -->

                        <!-- 年齢を選ぶ -->

                        <!-- <div class="overlay"></div> -->
                        <div class="search_container" id="popup_age" style="display: none;">
                            <div class="close_button" onclick="closePopup()">&times;</div>
                            <div class="search_header">
                                <h3>年齢を選ぶ</h3>
                            </div>
                            <!-- <form method="GET" action="<?php echo home_url(); ?>">
                            <input type="hidden" name="s" value=""> -->
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
                                                <input type="checkbox" name="age_type[]" value="<?php echo $term->slug; ?>" onclick="selectItem(this)">
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
                                    <button type="button" onclick="toggleAreaPopup()">エリアも選ぶ</button>
                                    <button type="button" onclick="toggleGenrePopup()">ジャンルも選ぶ</button>
                                </div>
                                <button type="button" class="clear_button" onclick="clearSelections('age_type')">すべてクリア</button>
                            </div>
                            <!-- </form> -->
                        </div>
                        <!-- end 年齢を選ぶ -->

                        <!-- ジャンルを選ぶ -->

                        <div class="overlay"></div>
                        <div class="search_container" id="popup_genre" style="display: none;">
                            <div class="close_button" onclick="closePopup()">&times;</div>
                            <div class="search_header">
                                <h3>ジャンルを選ぶ</h3>
                            </div>
                            <!-- <form method="GET" action="<?php echo home_url(); ?>">
                            <input type="hidden" name="s" value=""> -->
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

                                            </label>

                                            <div id="<?php echo $parent_term->slug; ?>" class="accordion_content">

                                                <label class="accordion_item full_width">
                                                    <input type="checkbox" name="classtype[]" onclick="selectAll('<?php echo $parent_term->slug; ?>', this);">
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
                                                                <input type="checkbox" name="classtype[]" value="<?php echo $child_term->slug; ?>" onclick="selectItem(this)">
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
                                        <button type="button" onclick="toggleAreaPopup()">エリアも選ぶ</button>
                                        <button type="button" onclick="toggleAgePopup()">年齢も選ぶ</button>
                                    </div>
                                    <button type="button" class="clear_button" onclick="clearSelections('classtype')">すべてクリア</button>
                                </div>
                                <!-- </form> -->
                            </div>
                        </div>
                        <!-- end ジャンルを選ぶ -->
                    </form>

                    <button class="detail__search" onclick="window.location.href='<?php echo home_url(); ?>/?s='">詳細検索ページへ</button>

                    <!-- キーワード検索 -->
                    <form action="<?php echo home_url('/'); ?>" method="get">
                        <div class="box__search">
                            <div class="inner__search-box">
                                <input class="window__search" type="search" name="s" value="<?php the_search_query(); ?>" placeholder="キーワードを入力してください">
                                <button class="btn__search" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- end キーワード検索 -->
                    <div class="boy__character fade__in">
                        <img class="boy__programmer" src="<?php echo get_template_directory_uri(); ?>/assets/images/programming.png" alt="プログラマー">
                        <img class="boy__idea" src="<?php echo get_template_directory_uri(); ?>/assets/images/idea.png" alt="アイデア">
                        <img class="boy__pochi" src="<?php echo get_template_directory_uri(); ?>/assets/images/pochi.png" alt="ポチ">
                    </div>
                </div>
            </div>

            <!-- 白背景の余白スペース -->
            <div class="clearance"></div>

            <!-- ランキング -->
            <div class="ranking">
                <div class="inner__ranking box fadeIn">
                    <div class="title__ranking">
                        <h2>RANKING</h2>
                        <p>アクセスランキング</p>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/creamcircle.png" alt="クリーム円">
                    </div>
                    <div class="order__ranking  box fadeIn">
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
                                                <!-- クリック回数 -->
                                                <!-- <small>
                                                <?php
                                                echo 'click' . esc_html($view_count);
                                                ?>
                                            </small> -->
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
            </div>

            <!-- 白背景の余白スペース -->
            <div class="clearance"></div>
            <!-- とくしまの習いごとアンケート -->
            <a href="<?php echo home_url('/fushion'); ?>">
                <div class="survey-results">
                    <div class="inner__survey box fadeIn">
                        <div class="banner__survey">


                        </div>
                    </div>
                </div>
            </a>

            <!-- 白背景の余白スペース -->
            <div class="clearance"></div>
            <!-- column -->
            <div class="column box fadeIn">
                <div class="inner__column  ">
                    <img class="spike__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/spike.png" alt="spike">
                    <div class="title__column">
                        <h2>COLUMN</h2>
                        <p>コラム</p>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/matcha.png" alt="みどり円">
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
                            ?>
                            <?php
                            if ($column_query->have_posts()):
                            ?>
                                <?php while ($column_query->have_posts()): $column_query->the_post(); ?>
                                    <?php get_template_part('template-parts/loop', 'column'); ?>

                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="more">
                    <button class="button__more button__more-column" onclick="window.location.href='<?php echo home_url('/column'); ?>'">MORE</button>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bear2.png" alt="Bear" class="bear__image bear__image-column">
                </div>
            </div>

            <!-- 白背景の余白スペース -->
            <div class="clearance"></div>
            <!-- NEWS -->
            <div class="news box fadeIn">
                <img class="tennis__boy y__flip" src="<?php echo get_template_directory_uri(); ?>/assets/images/tennis.png" alt="テニスボーイ">
                <img class="english__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/english_book.png" alt="englishbook">
                <img class="helmet__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/helmet_bat.png" alt="helmetbat">
                <div class="title__news">
                    <h2>NEWS</h2>
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

                        </div>
                    </div>
                <?php endif ?>
                <div class="more">
                    <button class="button__more button__more-news" onclick="window.location.href='<?php echo home_url('/category/news') ?>'">MORE</button>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bear2.png" alt="Bear" class="bear__image bear__image-news">
                </div>
            </div>
            <!-- end news -->

            <!-- 白背景の余白スペース -->
            <div class="clearance"></div>
        </div>
</main>
<?php get_footer(); ?>
