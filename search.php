<?php get_header(); ?>
<?php get_template_part('template-parts/ranking'); ?>
<?php
// echo "<pre>";
// var_dump();

$area_slug = get_query_var('area');
$age_type_slug = get_query_var('age_type');

$args = [
    'post_type' => 'classroom',
    'posts_per_page' => -1,
];
$taxquerysp = ['relation' => 'AND'];

// if (!empty($area_slug)) {
//     $taxquerysp[] = [
//         'taxonomy' => 'area',
//         'terms' => $area_slug,
//         'field' => 'slug',
//         'operator' => 'IN',
//     ];
// }
// if (!empty($age_type_slug)) {
//     $taxquerysp[] = [
//         'taxonomy' => 'age_type',
//         'terms' => $age_type_slug,
//         'field' => 'slug',
//         'operator' => 'IN',
//     ];
// }

$args['tax_query'] = $taxquerysp;
$the_query = new WP_Query($args);
?>

<main>
    <h1>条件検索</h1>
    <form method="GET" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="hidden" name="s" value="">
        <h2>検索</h2>
        <!-- <table>
            <th>エリア</th>
            <tr>
                <td>
                    <label><input type="checkbox" name="area[]" value="area01">徳島市全域</label>
                </td>
                <td>
                    <label><input type="checkbox" name="area[]" value="area02">板野郡全域</label>
                </td>
                <td>
                    <label><input type="checkbox" name="area[]" value="area03">阿南市</label>
                </td>
                <td>
                    <label><input type="checkbox" name="area[]" value="area04">鳴門市</label>
                </td>
                <td>
                    <label><input type="checkbox" name="area[]" value="area05">吉野川市</label>
                </td>
                <td>
                    <label><input type="checkbox" name="area[]" value="area06">小松島市</label>
                </td>
                <td>
                    <label><input type="checkbox" name="area[]" value="area07">阿波市</label>
                </td>
                <td>
                    <label><input type="checkbox" name="area[]" value="area08">名西郡</label>
                </td>
                <td>
                    <label><input type="checkbox" name="area[]" value="area09">美馬市</label>
                </td>
            </tr>
        </table>
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
        </table> -->
        <table>
            <th></th>
        </table>
        <input type="text" name="" value="<?php the_search_query(); ?>" placeholder="キーワードを入力" aria-label="Search">
        <input type="submit" value="この条件で探す">
    </form>

    <h1>検索結果（<?php echo $the_query->found_posts;
                ?>件）</h1>

    <div>
        <?php if ($the_query->have_posts()): ?>
            <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                <div>
                    <?php the_title(); ?>
                    <?php get_template_part('template-parts/loop', 'searchresult');
                    ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endwhile; ?>
        <?php else: ?>
            <h4>条件に合う習いごとは見つかりませんでした。</h4>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
