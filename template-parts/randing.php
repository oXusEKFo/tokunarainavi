<?php
// 获取当前页面的分类法和分类ID
if (is_tax()) {
    $term = get_queried_object(); // 获取当前分类对象
    $term_id = $term->term_id;
    $taxonomy = $term->taxonomy;  // 获取当前分类法

    // 检查当前的分类法是否为 'classtype', 'weektimes', 'age_type', 'skill_type', 'cost_type'
    if (
        $taxonomy == 'classtype' ||
        $taxonomy == 'weektimes' ||
        $taxonomy == 'age_type' ||
        $taxonomy == 'skill_type' ||
        $taxonomy == 'cost_type'
    ) {
        increment_term_view_count($term_id); // 增加查看次数
    }
}
