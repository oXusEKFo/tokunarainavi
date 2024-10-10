<?php get_header(); ?>
<?php
//各タクソノミーのデータを取得
$data = [
    $area_terms = get_terms(['taxonomy' => 'area', 'orderby' => 'slug', 'hide_empty' => false]), //hide_empty 0件の項目を表示する場合は必要
    $age_type_terms = get_terms(['taxonomy' => 'age_type', 'orderby' => 'slug']),
    $classtype_terms = get_terms(['taxonomy' => 'classtype', 'orderby' => 'slug', 'hide_empty' => false]),
    $weektimes_terms = get_terms(['taxonomy' => 'weektimes', 'orderby' => 'slug']),
    $cost_type_terms = get_terms(['taxonomy' => 'cost_type', 'orderby' => 'slug']),
    $personality_type_terms = get_terms(['taxonomy' => 'personality_type'], ['orderby' => 'slug']),
    $skill_type_terms = get_terms(['taxonomy' => 'skill_type'], ['orderby' => 'slug']),
];

foreach ($data as $value) {
    $taxonomy_name[] = $value[0]->taxonomy;
}
$count = 0; //タクソノミー名取得用
$count2 = 0;
?>

<main>
    <!--パンくずリスト-->

    <div class="results">
        <div class="inner_main">
            <div class="container_breadcrumb">
                <div class="breadcrumb">
                    <?php get_template_part('template-parts/breadcrumb'); ?>
                </div>
            </div>
            <section class="search_results">
                <!--検索フォーム-->
                <div>
                    <h1>条件検索</h1>

                    <?php foreach ($data as $value) {
                        // チェックしたものを検索した後も保持するための記述
                        // 「エリア」のチェックを保持
                        $select = filter_input(INPUT_GET, "$taxonomy_name[$count]", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?: [];
                        foreach ($value as $value2) {
                            $checked[$value2->taxonomy][$value2->slug] = "";
                        }
                        foreach ($select as $val) {
                            $checked[$taxonomy_name[$count]][$val] = " checked";
                        }
                        $count++;

                        //選択項目の名前の取得
                        foreach ($value as $value2) {
                            foreach ($select as $val) {
                                if ($val === $value2->slug) {
                                    $aaa[] = $value2->name;
                                }
                            }
                        }
                    }
                    $name_imp = "エリアを選択";
                    if (!empty($aaa)) {
                        $name_imp = implode(",", $aaa);
                    }
                    ?>

                    <div class="search_filters">
                        <div class="filter_row">
                            <span class="filter_label">エリア</span>
                            <span class="filter_value"><?= $name_imp ?></span>
                            <button class="change_btn" onclick="togglePopup('popup_area')">変更</button>
                        </div>
                        <div class="search_container" id="popup_area" style="display: none;">
                            <form method="GET" action="<?php echo esc_url(home_url('/')); ?>">
                                <input type="hidden" name="s" value="">
                                <div class="close_button" onclick="closePopup()">×</div>
                                <div class="search_header">
                                    <h1>エリアを選ぶ</h1>
                                </div>
                                <div class="search_options">
                                    <label class="accorindon_item full_width"><input type="text" onclick="selectAll('tokushima',this);">徳島市全域</label>
                                    <div id="tokushima" class="single_column">

                                        <?php foreach ($area_terms as $value): ?>
                                            <label class="accordion_item <?= $checked["area"]["$value->slug"] ?>"><input type="checkbox" name="area[]" value="<?php echo $value->slug ?>" <?= $checked["area"]["$value->slug"] ?> onclick="selectItem(this)"><?php echo $value->name ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="search_actions">
                                        <input class="search_button" type="submit" value="この条件で探す">
                                        <div class="additional-buttons">
                                            <button>年齢も選ぶ</button>
                                            <button>ジャンルも選ぶ</button>
                                        </div>
                                        <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <h1>フリーワード検索</h1>
                    <form action="<?php echo home_url('/'); ?>" method="get">
                        <input type="text" name="s" value="<?php the_search_query(); ?>" placeholder="キーワードを入力してください">
                        <button type="submit">🔍</button>
                    </form>
                </div>
            </section>

            <!-- 検索結果一覧カード -->
            <!-- フリーワード検索の結果 -->
            <?php if (!empty(get_search_query())): ?>
                <h1 class="results_count">検索結果：<?php echo count($posts); ?>件（1-5件表示）</h1>
                <div class="results_card">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <div class="results_card">
                                <div class="wrap_card">
                                    <div class="inner_card">
                                        <?php get_template_part('template-parts/loop', 'classroom');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                </div>
                <h4>条件に合う習い事はありませんでした。</h4>
            <?php endif; ?>
        <?php else: ?>
            <!--条件検索のサブクエリ-->
            <?php

                $result = [
                    $area_slug = get_query_var('area'),
                    $age_type_slug = get_query_var('age_type'),
                    $classtype_slug = get_query_var('classtype'),
                    $weektimes_slug = get_query_var('weektimes'),
                    $cost_type_slug = get_query_var('cost_type'),
                    $personality_type_slug = get_query_var('personality_type'),
                    $skill_type_slug = get_query_var('skill_type'),
                ];

                $args = [
                    'post_type' => 'classroom',
                    'posts_per_page' => -1,
                ];
                $taxquerysp = ['relation' => 'AND'];

                foreach ($result as $value) {
                    if (!empty($value)) {
                        $taxquerysp[] = [
                            'taxonomy' => "$taxonomy_name[$count2]", //↑と違うカウントを使う
                            'terms' => $value,
                            'field' => 'slug',
                            'operator' => 'IN',
                        ];
                    }
                    $count2++;
                }

                $args['tax_query'] = $taxquerysp;
                $the_query = new WP_Query($args);
            ?>
            <!-- 条件検索の結果 -->
            <h1 class="results_count">検索結果：<?php echo $the_query->found_posts; ?>件（1-5件表示）</h1>
            <div>
                <div class="results_card">
                    <?php if ($the_query->have_posts()): ?>
                        <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                            <div class="wrap_card">
                                <div class="inner_card">
                                    <?php
                                    get_template_part('template-parts/loop', 'classroom');
                                    ?>
                                </div>
                            </div>
                            <?php wp_reset_postdata(); ?>
                        <?php endwhile; ?>
                </div>
            <?php else: ?>
                <h4>条件に合う習いごとは見つかりませんでした。</h4>
            <?php endif; ?>
        <?php endif; ?>
            </div>

            </section>
            <!-- 検索結果一覧カードここまで -->

            <section class="footer_results">
                <div class="containerpagenum">
                    <div class="results_pagenum">
                        <h3>
                            <?php if (function_exists('wp_pagenavi')): ?>
                                <?php wp_pagenavi(); ?>
                            <?php endif; ?>
                        </h3>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
