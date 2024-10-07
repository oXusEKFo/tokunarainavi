<?php get_header();
?>

<main>
    <!--パンくずリスト-->
    <?php get_template_part('template-parts/breadcrumb'); ?>

    <!--検索フォーム-->
    <div>
        <h1>条件検索</h1>
        <form method="GET" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="hidden" name="s" value="">
            <?php
            // チェックしたものを検索した後も保持するための記述
            // 「エリア」のチェックを保持
            $select_area = filter_input(INPUT_GET, "area", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?: [];
            $checked["area"] = ["area01" => "", "area02" => "", "area03" => "", "area04" => "", "area05" => "", "area06" => "", "area07" => "", "area08" => "", "area09" => ""];
            foreach ($select_area as $val) {
                $checked["area"][$val] = " checked";
            }
            ?>

            <!--エリア検索-->
            <table>
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
            </table>

            <!--対象年齢検索-->
            <table>
                <th>対象年齢</th>
                <tr>
                    <td>
                        <label><input type="checkbox" name="age_type[]" value="age01">べビー（0~2歳）</label>
                    </td>
                    <td>
                        <label><input type="checkbox" name="age_type[]" value="age02">年少 （3~4歳）</label>
                    </td>
                    <td>
                        <label><input type="checkbox" name="age_type[]" value="age03">年中（4~5歳）</label>
                    </td>
                    <td>
                        <label><input type="checkbox" name="age_type[]" value="age04">年長（5~6歳）</label>
                    </td>
                    <td>
                        <label><input type="checkbox" name="age_type[]" value="age05">小１（6~7歳）</label>
                    </td>
                    <td>
                        <label><input type="checkbox" name="age_type[]" value="age06">小２（7~8歳）</label>
                    </td>
                    <td>
                        <label><input type="checkbox" name="age_type[]" value="age07">小３（8~9歳）</label>
                    </td>
                </tr>
            </table>

            <!--タクソノミーをワードプレスから取得(10/04 未実装)-->
            <!-- <table>
                <th>対象年齢</th>
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

            $area_slug = get_query_var('area');
            $age_type_slug = get_query_var('age_type');

            $args = [
                'post_type' => 'classroom',
                'posts_per_page' => -1,
            ];
            $taxquerysp = ['relation' => 'AND'];

            if (!empty($area_slug)) {
                $taxquerysp[] = [
                    'taxonomy' => 'area',
                    'terms' => $area_slug,
                    'field' => 'slug',
                    'operator' => 'IN',
                ];
            }
            if (!empty($age_type_slug)) {
                $taxquerysp[] = [
                    'taxonomy' => 'age_type',
                    'terms' => $age_type_slug,
                    'field' => 'slug',
                    'operator' => 'IN',
                ];
            }

            $args['tax_query'] = $taxquerysp;
            $the_query = new WP_Query($args);
            ?>
            <!-- 条件検索の結果 -->
            <h1>検索結果（<?php echo $the_query->found_posts; ?>件）</h1>

            <div>
                <?php if ($the_query->have_posts()): ?>
                    <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                        <div>
                            <?php get_template_part('template-parts/loop', 'classroom');
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
