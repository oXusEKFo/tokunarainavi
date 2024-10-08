<?php
get_header();

//各タクソノミーのデータを取得
$data = [
    $area_terms = get_terms(['taxonomy' => 'area'], ['orderby' => 'slug']),
    $age_type_terms = get_terms(['taxonomy' => 'age_type'], ['orderby' => 'slug']),
    $classtype_terms = get_terms(['taxonomy' => 'classtype'], ['orderby' => 'slug']),
    $weektimes_terms = get_terms(['taxonomy' => 'weektimes'], ['orderby' => 'slug']),
    $cost_type_terms = get_terms(['taxonomy' => 'cost_type'], ['orderby' => 'slug']),
    $personality_type_terms = get_terms(['taxonomy' => 'personality_type'], ['orderby' => 'slug']),
    $skill_type_terms = get_terms(['taxonomy' => 'skill_type'], ['orderby' => 'slug']),
];
echo '<pre>';
print_r($classtype_terms);
echo '</pre>';

foreach ($data as $value) {
    $taxonomy_name[] = $value[0]->taxonomy;
}
echo 'taxonomy_name<pre>';
print_r($taxonomy_name);
echo '</pre>';
$count = 0; //タクソノミー名取得用
$count2 = 0;
?>

<main>
    <!--パンくずリスト-->
    <?php get_template_part('template-parts/breadcrumb'); ?>

    <!--検索フォーム-->
    <div>
        <h1>条件検索</h1>
        <form method="GET" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="hidden" name="s" value="">
            <?php foreach ($data as $value): ?>
                <?php
                // チェックしたものを検索した後も保持するための記述
                // 「エリア」のチェックを保持
                $select = filter_input(INPUT_GET, "$taxonomy_name[$count]", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?: [];
                foreach ($value as $value2) {
                    $checked[$value2->taxonomy][$value2->slug] = "";
                }
                foreach ($select as $val) {
                    $checked[$taxonomy_name[$count]][$val] = " checked";
                }
                // echo '<pre>';
                // print_r($select);
                // echo "確認用";
                // echo '</pre>';
                ?>
                <!-- <table>
                <th><?php
                    //対象年齢
                    $a = get_taxonomy($taxonomy_name[$count]);
                    $b = $a->labels;
                    echo "" . $b->name;

                    ?></th>
                <tr>
                    <td>
                        <?php foreach ($age_type_terms as $info) : ?>
                            <label><input type="checkbox" name="<?= $taxonomy_name[$count] ?>[]" value="<?php echo $info->slug ?>" <?= $checked['age_type']['age01']; ?>>
                                <?php
                                // echo '<pre>';
                                // print_r($checked);
                                // echo '</pre>';
                                echo $info->name ?></label>
                        <?php endforeach; ?>
                    </td>
                </tr>
            </table> -->
                <?php //$count++;
                ?>

                <!--対象年齢検索-->
                <table>
                    <th><?php
                        $a = get_taxonomy($taxonomy_name[$count]);
                        $b = $a->labels;
                        echo "" . $b->name; ?></th>
                    <tr>
                        <td>
                            <?php foreach ($value as $value2) : ?>
                                <label><input type="checkbox" name="<?= $taxonomy_name[$count] ?>[]" value="<?php echo $value2->slug ?>" <?= $checked["$taxonomy_name[$count]"]["$value2->slug"] ?>><?php echo $value2->name ?></label>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                </table>
                <?php $count++; ?>
            <?php endforeach; ?>

            <!--エリア検索-->
            <!-- <table>
                <th>エリア</th>
                <tr>
                    <td>
                        <label><input type="checkbox" name="area[]" value="area01" <?= $checked["area"]["area01"] ?>>徳島市全域</label>
                    </td>
                    <td>
                        <label><input type="checkbox" name="area[]" value="area02" <?= $checked["area"]["area02"] ?>>板野郡全域</label>
                    </td>
                    <td>
                        <label><input type="checkbox" name="area[]" value="area03" <?= $checked["area"]["area03"] ?>>阿南市</label>
                    </td>
                    <td>
                        <label><input type="checkbox" name="area[]" value="area04" <?= $checked["area"]["area04"] ?>>鳴門市</label>
                    </td>
                    <td>
                        <label><input type="checkbox" name="area[]" value="area05" <?= $checked["area"]["area05"] ?>>吉野川市</label>
                    </td>
                    <td>
                        <label><input type="checkbox" name="area[]" value="area06" <?= $checked["area"]["area06"] ?>>小松島市</label>
                    </td>
                    <td>
                        <label><input type="checkbox" name="area[]" value="area07" <?= $checked["area"]["area07"] ?>>阿波市</label>
                    </td>
                    <td>
                        <label><input type="checkbox" name="area[]" value="area08" <?= $checked["area"]["area08"] ?>>名西郡</label>
                    </td>
                    <td>
                        <label><input type="checkbox" name="area[]" value="area09" <?= $checked["area"]["area09"] ?>>美馬市</label>
                    </td>
                </tr>
            </table> -->

            <input type="submit" value="この条件で探す">
        </form>

        <h1>フリーワード検索</h1>
        <form action="<?php echo home_url('/'); ?>" method="get">
            <input type="text" name="s" value="<?php the_search_query(); ?>" placeholder="キーワードを入力してください">
            <button type="submit">🔍</button>
        </form>
    </div>

    <!--検索結果-->
    <div>
        <?php if (!empty(get_search_query())) : ?>
            <!-- フリーワード検索の結果 -->
            <h1>検索結果（<?php echo count($posts); ?>件）</h1>
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/loop', 'classroom');
                    ?>
                <?php endwhile; ?>
            <?php else : ?>
                <h4 class="no_search_results">
                    条件に合う習いごとはありませんでした。
                </h4>
            <?php endif; ?>

        <?php else: ?>
            <!--条件検索のサブクエリ-->
            <?php
            // foreach ($data as $value) {
            //     $result[] = get_query_var("");
            // }

            $result = [
                $area_slug = get_query_var('area'),
                $age_type_slug = get_query_var('age_type'),
                $classtype_slug = get_query_var('classtype'),
                $weektimes_slug = get_query_var('weektimes'),
                $cost_type_slug = get_query_var('cost_type'),
                $personality_type_slug = get_query_var('personality_type'),
                $skill_type_slug = get_query_var('skill_type'),
            ];

            $classtype_slug = get_query_var('classtype'); //仮
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

            // if (!empty($classtype_slug)) {
            //     $taxquerysp[] = [
            //         'taxonomy' => "classtype", //↑と違うカウントを使う
            //         'terms' => $classtype_slug,
            //         'field' => 'slug',
            //         'operator' => 'IN',
            //     ];
            // }

            $args['tax_query'] = $taxquerysp;
            $the_query = new WP_Query($args);
            // echo '<pre>';
            // print_r($the_query);
            // echo '</pre>';
            ?>
            <!-- 条件検索の結果 -->
            <h1>検索結果（<?php echo $the_query->found_posts; ?>件）</h1>

            <div>
                <?php if ($the_query->have_posts()): ?>
                    <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                        <div>
                            <?php
                            get_template_part('template-parts/loop', 'classroom');
                            ?>
                        </div>
                        <?php wp_reset_postdata(); ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <h4>条件に合う習いごとは見つかりませんでした。</h4>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
