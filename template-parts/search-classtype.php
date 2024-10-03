<?php
$terms = get_terms(array(
    'taxonomy' => 'classtype', // 自定义分类法名称
    'hide_empty' => false, // 是否隐藏没有关联内容的分类项
    'orderby' => 'slug',
    'order' => 'ASC',
));

if (! empty($terms) && ! is_wp_error($terms)) {
    // 输出一级分类
    foreach ($terms as $term) {
        if ($term->parent == 0) { // 判断是否是一级分类
            echo '<h3>' . $term->name . '</h3>'; // 输出一级分类名称
            // echo '<p>' . $term->slug . '</p>'; // 输出一级分类别名

            // 查找并输出该一级分类下的二级分类
            $child_terms = get_terms(array(
                'taxonomy' => 'classtype',
                'parent' => $term->term_id, // 获取该一级分类下的子分类
                'hide_empty' => false,
            ));

            if (! empty($child_terms) && ! is_wp_error($child_terms)) {
                echo '<ul>';
                foreach ($child_terms as $child_term) {
                    echo '<li>' . $child_term->name . '</li>'; // 输出二级分类名称
                    // echo '<li>' . $child_term->slug . '</li>'; // 输出二级分类别名

                }
                echo '</ul>';
            }
        }
    }
}
wp_reset_postdata();
