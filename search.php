<?php get_header(); ?>
<?php
//各タクソノミーのデータを取得
$data = [
    $area_terms = get_terms(['taxonomy' => 'area', 'orderby' => 'slug', 'hide_empty' => false]), //hide_empty 0件の項目を表示する場合は必要
    $age_type_terms = get_terms(['taxonomy' => 'age_type', 'orderby' => 'slug', 'hide_empty' => false]),
    $classtype_terms = get_terms(['taxonomy' => 'classtype', 'orderby' => 'slug', 'hide_empty' => false]),
    $weektimes_terms = get_terms(['taxonomy' => 'weektimes', 'orderby' => 'slug', 'hide_empty' => false]),
    $cost_type_terms = get_terms(['taxonomy' => 'cost_type', 'orderby' => 'slug', 'hide_empty' => false]),
    $personality_type_terms = get_terms(['taxonomy' => 'personality_type', 'orderby' => 'slug', 'hide_empty' => false]),
    $skill_type_terms = get_terms(['taxonomy' => 'skill_type', 'orderby' => 'slug', 'hide_empty' => false]),
];

foreach ($data as $value) {
    $taxonomy_name[] = $value[0]->taxonomy;
}
$count = 0; //タクソノミー名取得用
$count2 = 0;
?>

<main>
    <div class="breadCrumb__wrap">
        <div class="breadCrumb">
            <?php get_template_part('template-parts/breadcrumb'); ?>
        </div>
    </div>
    <div class="results">
        <div class="inner_main">
            <section class="search_results">
                <!--検索フォーム-->
                <div>
                    <?php
                    //選択項目の保持と選択項目の名前の取得
                    //各タクソノミーでループ 名前の取得まで
                    foreach ($data as $terms) {
                        $term_name[$taxonomy_name[$count]] = '指定なし';
                        foreach ($terms as $value) {
                            $checked["$taxonomy_name[$count]"][$value->slug] = "";
                        }
                        $select = filter_input(INPUT_GET, "$taxonomy_name[$count]", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?: [];
                        foreach ($select as $value) {
                            $checked["$taxonomy_name[$count]"][$value] = "checked";
                            foreach ($terms as $slug) {
                                if ($value === "$slug->slug") {
                                    $term_name_array[$slug->taxonomy][] = "$slug->name";
                                }
                            }
                        }
                        if (!empty($term_name_array[$taxonomy_name[$count]])) {
                            $term_name[$taxonomy_name[$count]] = implode(",", $term_name_array[$taxonomy_name[$count]]);
                        }

                        if (!empty($select)) {
                            if ($count == 3) {
                                foreach ($select as $value) {
                                    //各子タクソノミー（時間帯）に親タクソノミー（曜日）を追加
                                    $term = get_term_by('slug', $value, 'weektimes');
                                    if ($term->parent) {
                                        $parent_term = get_term_by('ID', $term->parent, 'weektimes');
                                        $parent_name[$parent_term->slug] = $parent_term->name;
                                        $parent_slug[] = $parent_term->slug;
                                        $weektimes_data[$parent_term->slug][] = $term->name;
                                    }
                                }
                                foreach ($parent_slug as $value) {
                                    $aaa[$value] = "$parent_name[$value](" . implode(",", $weektimes_data[$value]) . ")";
                                    // print_r($value);
                                }
                                if (!empty($aaa)) {
                                    $term_name[$taxonomy_name[$count]] = implode(",", $aaa);
                                }
                            }
                        }
                        $count++;
                    }
                    ?>

                </div>
                <div class="search_filters">
                    <form method="GET" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="hidden" name="s" value="">
                        <div class="filter_row">
                            <span class="filter_label">エリア</span>
                            <span class="filter_value"><?= $term_name['area'] ?></span>
                            <button type="button" class="change_btn" onclick="togglePopup('popup_area')">変更</button>
                        </div>
                        <div class="overlay" style="display: none;"></div>
                        <div class="search_container" id="popup_area" style="display: none;">
                            <div class="close_button" onclick="closePopup()">×</div>
                            <div class="search_header">
                                <h2>エリアを選ぶ</h2>
                            </div>
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
                                <div id="<?= $parent_term->slug; ?>" class="accordion_content" style="display:flex">
                                    <label class="accordion_item full_width <?= $checked['area']["$parent_term->slug"] ?>">
                                        <input type="checkbox" name="area[]" value="<?= $parent_term->slug ?>" <?= $checked['area']["$parent_term->slug"] ?> onclick="selectAll('<?= $parent_term->slug; ?>', this);" style="display: none;"> <?php echo $parent_term->name; ?>
                                    </label>
                                    <div class="single_column">
                                        <?php if (! empty($child_terms) && ! is_wp_error($child_terms)): ?>
                                            <?php foreach ($child_terms as $child_term) : ?>
                                                <label class="accordion_item full_width <?= $checked['area']["$child_term->slug"] ?>">
                                                    <input type="checkbox" name="area[]" value="<?php echo $child_term->slug; ?>" <?= $checked['area']["$child_term->slug"] ?> onclick="selectItem(this)" style="display: none;">
                                                    <?php echo $child_term->name; ?></label>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
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
                                    <label class="accordion_item full_width <?= $checked['area'][$parent_term->slug] ?>">
                                        <input type="checkbox" name="area[]" value="<?= $parent_term->slug ?>" <?= $checked['area'][$parent_term->slug] ?> onclick="selectAll('<?= $parent_term->slug; ?>', this);" style="display: none;"><?= $parent_term->name; ?>
                                    </label>
                                    <div class="double_column">
                                        <?php if (!empty($child_terms) && ! is_wp_error($child_terms)): ?>
                                            <?php foreach ($child_terms as $child_term) : ?>
                                                <label class="accordion_item full_width <?= $checked['area']["$child_term->slug"] ?>">
                                                    <input type="checkbox" name="area[]" value="<?php echo $child_term->slug; ?>" <?= $checked['area']["$child_term->slug"] ?> onclick="selectItem(this)" style="display: none;">
                                                    <?php echo $child_term->name; ?>
                                                </label>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="double_column">
                                    <?php
                                    $terms = get_terms(array(
                                        'taxonomy' => 'area',
                                        'hide_empty' => false,
                                        'orderby' => 'slug',
                                        'order' => 'ASC',

                                    ));
                                    if (!empty($terms) && ! is_wp_error($terms)):
                                        foreach ($terms as $term):
                                            if ($term->parent == 0):
                                                if ($term->slug == 'area01' || $term->slug == 'area02') {
                                                    continue;
                                                }
                                    ?>
                                                <label class="accordion_item <?= $checked['area']["$term->slug"] ?>">
                                                    <input type="checkbox" name="area[]" value="<?php echo $term->slug; ?>" <?= $checked['area']["$term->slug"] ?> onclick="selectItem(this)" style="display: none;">
                                                    <?php echo $term->name; ?>
                                                </label>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="search_actions">
                                    <input type="submit" value="この条件で検索する" class="search_button"></input>
                                    <button type="button" class="clear_button" onclick="clearSelections('area')">すべてクリア</button>
                                </div>
                            </div>
                        </div>
                        <div class="filter_row">
                            <span class="filter_label">年齢</span>
                            <span class="filter_value"><?= $term_name['age_type'] ?></span>
                            <button type="button" class="change_btn" onclick="togglePopup('popup_age')">変更</button>
                        </div>
                        <div class="overlay"></div>
                        <div class="search_container" id="popup_age" style="display: none;">
                            <div class="close_button" onclick="closePopup()">×</div>
                            <div class="search_header">
                                <h2>年齢を選ぶ</h2>
                            </div>
                            <div class="search_options">
                                <div class="double_column">
                                    <?php
                                    $terms = get_terms(array(
                                        'taxonomy' => 'age_type',
                                        'hide_empty' => false,
                                        'orderby' => 'slug',
                                        'order' => 'ASC',
                                    ));
                                    ?>
                                    <?php if (!empty($terms)): ?>
                                        <?php foreach ($terms as $term) : ?>
                                            <label class="accordion_item <?= $checked['age_type']["$term->slug"] ?>">
                                                <input type="checkbox" name="age_type[]" value="<?= $term->slug ?>" <?= $checked['age_type']["$term->slug"] ?> onclick="selectItem(this)" style="display: none;">
                                                <?php echo $term->name; ?>
                                            </label>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="search_actions">
                                <input type="submit" value="この条件で検索する" class="search_button"></input>
                                <button type="button" class="clear_button" onclick="clearSelections('age_type')">すべてクリア</button>
                            </div>
                        </div>
                        <div class="filter_row">
                            <span class="filter_label">ジャンル</span>
                            <span class="filter_value"><?= $term_name['classtype'] ?></span>
                            <button type="button" class="change_btn" onclick="togglePopup('popup_genre')">変更</button>
                        </div>
                        <div class="overlay"></div>
                        <div class="search_container" id="popup_genre" style="display: none;">
                            <div class="close_button" onclick="closePopup()">×</div>
                            <div class="search_header">
                                <h2>ジャンルを選ぶ</h2>
                            </div>
                            <div class="search_options">
                                <?php
                                $parent_terms = get_terms(array(
                                    'taxonomy' => 'classtype',
                                    'hide_empty' => false,
                                    'orderby' => 'slug',
                                    'order' => 'ASC',
                                ));
                                ?>
                                <?php if (!empty($parent_terms) && !is_wp_error($parent_terms)): ?>
                                    <?php foreach ($parent_terms as $parent_term): ?>
                                        <?php if ($parent_term->parent == 0): ?>
                                            <button type="button" class="search_option_suboption" onclick="toggleAccordion('<?php echo $parent_term->slug; ?>')"><?php echo $parent_term->name; ?> <span class="plus">+</span></button>
                                            <div id="<?php echo $parent_term->slug; ?>" class="accordion_content">
                                                <label class="accordion_item  full_width">
                                                    <input name="classtype[]" type="checkbox" onclick="selectAll('<?php echo $parent_term->slug; ?>', this);" style="display: none;">
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
                                                    ?>




                                                    <?php if (!empty($child_terms) && !is_wp_error($child_terms)): ?>
                                                        <?php foreach ($child_terms as $child_term): ?>
                                                            <label class="accordion_item <?= $checked['classtype']["$child_term->slug"] ?>">
                                                                <input type="checkbox" name="classtype[]" value="<?php echo esc_attr($child_term->slug); ?>" <?= $checked['classtype']["$child_term->slug"] ?> onclick="selectItem(this)" style="display: none;">
                                                                <?php echo esc_html($child_term->name); ?>
                                                            </label>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <div class="search_actions">
                                    <input type="submit" value="この条件で検索する" class="search_button"></input>
                                    <button type="button" class="clear_button" onclick="clearSelections('classtype')">すべてクリア</button>
                                </div>
                            </div>
                        </div>
                        <div class="filter_row">
                            <span class="filter_label">曜日・時間帯</span>
                            <span class="filter_value"><?= $term_name['weektimes'] ?></span>
                            <button type="button" class="change_btn" onclick="togglePopup('popup_day_time')">変更</button>
                        </div>
                        <div class="overlay"></div>
                        <div class="search_container" id="popup_day_time" style="display: none;">
                            <div class="close_button" onclick="closePopup()">×</div>
                            <div class="search_header">
                                <h2>曜日・時間帯を選ぶ</h2>
                            </div>
                            <div class="search_options">
                                <?php
                                $parent_terms = get_terms(array(
                                    'taxonomy' => 'weektimes',
                                    'hide_empty' => false,
                                    'orderby' => 'slug',
                                    'order' => 'ASC',
                                ));
                                ?>
                                <?php if (!empty($parent_terms) && !is_wp_error($parent_terms)): ?>
                                    <?php foreach ($parent_terms as $parent_term): ?>
                                        <?php if ($parent_term->parent == 0): ?>
                                            <button type="button" class="search_option_suboption" onclick="toggleAccordion('<?= $parent_term->slug ?>')"><?= $parent_term->name ?><span class="plus">+</span></button>
                                            <div id="<?= $parent_term->slug ?>" class="accordion_content">
                                                <label class="accordion_item full_width">
                                                    <input name="weektimes[]" value="<?= $parent_term->slug ?>" type="checkbox" onclick="selectAll('<?php echo $parent_term->slug; ?>', this);" style="display: none;">
                                                    時間帯をすべて選択
                                                </label>
                                                <div id="<?php echo $parent_term->slug; ?>_list" class="double_column">
                                                    <?php
                                                    $child_terms = get_terms(array(
                                                        'taxonomy' => 'weektimes',
                                                        'parent' => $parent_term->term_id,
                                                        'hide_empty' => false,
                                                        'orderby' => 'slug',
                                                        'order' => 'ASC',
                                                    ));
                                                    ?>
                                                    <?php if (!empty($child_terms) && !is_wp_error($child_terms)): ?>
                                                        <?php foreach ($child_terms as $child_term): ?>
                                                            <label class="accordion_item <?= $checked['weektimes']["$child_term->slug"] ?>">
                                                                <input type="checkbox" name="weektimes[]" value="<?php echo esc_attr($child_term->slug); ?>" <?= $checked['weektimes']["$child_term->slug"] ?> onclick="selectItem(this)" style="display: none;">
                                                                <?php echo esc_html($child_term->name); ?>
                                                            </label>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="search_actions">
                                <button class="search_button">この条件で検索する</button>
                                <button type="button" class="clear_button" onclick="clearSelections('weektimes')">すべてクリア</button>
                            </div>
                        </div>
                        <div class="filter_row">
                            <span class="filter_label">こだわり条件</span>
                            <span class="filter_value"><?= $term_name['cost_type'] ?></span>
                            <button type="button" class="change_btn" onclick="togglePopup('popup_conditions')">変更</button>
                        </div>
                        <div class="overlay"></div>
                        <div class="search_container" id="popup_conditions" style="display: none;">
                            <div class="close_button" onclick="closePopup()">×</div>
                            <div class=" search_header">
                                <h2>こだわり条件を選ぶ</h2>
                            </div>
                            <div class="search_options">
                                <div class="double_column">
                                    <?php
                                    $terms = get_terms(array(
                                        'taxonomy' => 'cost_type',
                                        'hide_empty' => false,
                                        'orderby' => 'slug',
                                        'order' => 'ASC',
                                    ));
                                    ?>
                                    <?php if (!empty($terms) && ! is_wp_error($terms)): ?>
                                        <?php foreach ($terms as $term): ?>
                                            <label class="accordion_item <?= $checked['cost_type']["$term->slug"] ?>">
                                                <input type="checkbox" name="cost_type[]" value="<?php echo $term->slug; ?>" <?= $checked['cost_type']["$term->slug"] ?> onclick="selectItem(this)" style="display: none;">
                                                <?php echo $term->name; ?>
                                            </label>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="search_actions">
                                <button class="search_button">この条件で検索する</button>
                                <button class="clear_button" onclick="clearSelections('cost_type')">すべてクリア</button>
                            </div>
                        </div>
                        <div class="filter_row">
                            <span class="filter_label">子供の性格</span>
                            <span class="filter_value"><?= $term_name['personality_type'] ?></span>
                            <button type="button" class="change_btn" onclick="togglePopup('popup_personality')">変更</button>
                        </div>
                        <div class="overlay"></div>
                        <div class="search_container" id="popup_personality" style="display: none;">
                            <div class="close_button" onclick="closePopup()">×</div>
                            <div class="search_header">
                                <h2>子供の性格を選ぶ</h2>
                            </div>
                            <div class="search_options">
                                <div class="double_column">
                                    <?php
                                    $terms = get_terms(array(
                                        'taxonomy' => 'personality_type',
                                        'hide_empty' => false,
                                        'orderby' => 'slug',
                                        'order' => 'ASC',
                                    ));
                                    ?>
                                    <?php if (!empty($terms) && ! is_wp_error($terms)): ?>
                                        <?php foreach ($terms as $term): ?>
                                            <label class="accordion_item <?= $checked['personality_type']["$term->slug"] ?>">
                                                <input type="checkbox" name="personality_type[]" value="<?php echo $term->slug; ?>" <?= $checked['personality_type']["$term->slug"] ?> onclick="selectItem(this)" style="display: none;">
                                                <?php echo $term->name; ?>
                                            </label>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="search_actions">
                                <button class="search_button">この条件で検索する</button>
                                <button type="button" class="clear_button" onclick="clearSelections('personality_type')">すべてクリア</button>
                            </div>
                        </div>
                        <div class="filter_row">
                            <span class="filter_label">UPさせたいスキル</span>
                            <span class="filter_value"><?= $term_name['skill_type'] ?></span>
                            <button type="button" class="change_btn" onclick="togglePopup('popup_skills')">変更</button>
                        </div>
                        <div class="overlay"></div>
                        <div class="search_container" id="popup_skills" style="display: none;">
                            <div class="close_button" onclick="closePopup()">×</div>
                            <div class="search_header">
                                <h2>UPさせたいスキルを選ぶ</h2>
                            </div>
                            <div class="search_options">
                                <div class="double_column">
                                    <?php
                                    $terms = get_terms(array(
                                        'taxonomy' => 'skill_type',
                                        'hide_empty' => false,
                                        'orderby' => 'slug',
                                        'order' => 'ASC',
                                    ));
                                    ?>
                                    <?php if (!empty($terms) && ! is_wp_error($terms)): ?>
                                        <?php foreach ($terms as $term): ?>
                                            <label class="accordion_item <?= $checked['skill_type']["$term->slug"] ?>">
                                                <input type="checkbox" name="skill_type[]" value="<?php echo $term->slug; ?>" <?= $checked['skill_type']["$term->slug"] ?> onclick="selectItem(this)" style="display: none;">
                                                <?php echo $term->name; ?>
                                            </label>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="search_actions">
                                <button class="search_button">この条件で検索する</button>
                                <button type="button" class="clear_button" onclick="clearSelections('skill_type')">すべてクリア</button>
                            </div>
                        </div>
                    </form>
                </div>
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
            </section>

            <!-- 検索結果一覧カード -->
            <!-- フリーワード検索の結果 -->
            <?php if (!empty(get_search_query())): ?>
                <h1 class="results_count">検索結果：<?php echo $wp_query->found_posts; ?>件</h1>
                <!-- （1-6件表示）　仮でコメントアウト -->
                <?php if (have_posts()) : ?>
                    <div class="results_card">
                        <?php while (have_posts()) : the_post(); ?>
                            <?php get_template_part('template-parts/loop', 'classroom'); ?>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <h2 class="not__found">条件に合う習いごとは見つかりませんでした。</h2>
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
                    'order' => 'DESC',
                    'orderby' => 'ID',
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
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args['posts_per_page'] = 6; //表示件数の指定
                $args['paged'] = $paged;
                $args['tax_query'] = $taxquerysp;
                $the_query = new WP_Query($args);
                ?>
                <!-- 条件検索の結果 -->
                <h1 class="results_count">検索結果：<?php echo $the_query->found_posts; ?>件</h1>
                <!-- （1-6件表示）仮でコメントアウト -->
                <?php if ($the_query->have_posts()): ?>
                    <div class="results_card">
                        <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                            <?php get_template_part('template-parts/loop', 'classroom'); ?>
                            <?php wp_reset_postdata(); ?>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <h2 class="not__found">条件に合う習いごとは見つかりませんでした。</h2>
                <?php endif; ?>
            <?php endif; ?>

            <section class="footer_results">
                <?php if (function_exists('wp_pagenavi')): ?>
                    <?php wp_pagenavi(); ?>
                <?php endif; ?>
            </section>
        </div>
    </div>
</main>
<?php get_footer(); ?>
