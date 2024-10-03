<?php
$terms = get_terms(array(
    'taxonomy' => 'classtype',
    'hide_empty' => false,
    'orderby' => 'slug',
    'order' => 'ASC',
));

if (! empty($terms) && ! is_wp_error($terms)) {
    // 输出一级分类
    foreach ($terms as $term) {
        if ($term->parent == 0) { // 判断是否是一级分类
            $term_link = get_term_link($term); // 获取一级分类链接
            echo '<h3><a href="' . esc_url($term_link) . '">' . esc_html($term->name) . '</a></h3>'; // 输出一级分类名称并加上链接

            // 查找并输出该一级分类下的二级分类
            $child_terms = get_terms(array(
                'taxonomy' => 'classtype',
                'parent' => $term->term_id, // 获取该一级分类下的子分类
                'hide_empty' => false,
            ));

            if (! empty($child_terms) && ! is_wp_error($child_terms)) {
                echo '<ul>';
                foreach ($child_terms as $child_term) {
                    $child_term_link = get_term_link($child_term); // 获取二级分类链接
                    echo '<li><a href="' . esc_url($child_term_link) . '">' . esc_html($child_term->name) . '</a></li>'; // 输出二级分类名称并加上链接
                }
                echo '</ul>';
            }
        }
    }
}
wp_reset_postdata();
