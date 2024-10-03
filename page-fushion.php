<?php get_header(); ?>

<main>
    <?php
    // 获取所有一级分类
    $terms = get_terms(array(
        'taxonomy' => 'classtype', // 自定义分类法名称
        'hide_empty' => false, // 是否隐藏没有关联内容的分类项
        'parent' => 0, // 获取一级分类
        // 'number' => '5',
    ));

    // 检查一级分类
    if (empty($terms) || is_wp_error($terms)) {
        echo '没有找到一级分类。';
        return; // 如果没有一级分类，终止执行
    }

    // 初始化一个存储二级分类的数组
    $all_child_terms = array();

    // 获取每个一级分类下的二级分类
    foreach ($terms as $term) {
        // 获取该一级分类下的二级分类
        $child_terms = get_terms(array(
            'taxonomy' => 'classtype',
            'hide_empty' => false,
            'parent' => $term->term_id, // 获取该一级分类下的二级分类
            // 'meta_key' => 'view_count', // 根据查看次数排序
            // 'orderby' => 'meta_value_num',
            // 'order' => 'DESC',
            'number' => '2',
        ));

        // 检查二级分类
        if (empty($child_terms) || is_wp_error($child_terms)) {
            echo '一级分类 ' . esc_html($term->name) . ' 下没有找到二级分类。';
            continue; // 如果没有二级分类，继续下一个一级分类
        }

        // 将二级分类存入数组
        $all_child_terms = array_merge($all_child_terms, $child_terms);
    }

    // 检查并输出所有的二级分类
    if (empty($all_child_terms)) {
        echo '没有找到任何二级分类。';
    } else {
        echo '<ul>'; // 输出二级分类列表
        foreach ($all_child_terms as $child_term) {
            $term_link = get_term_link($child_term);
            $view_count = get_term_meta($child_term->term_id, 'view_count', true); // 获取查看次数
            if (!is_wp_error($term_link)) {
                // 输出二级分类的名称并添加链接
                echo '<li><a href="' . esc_url($term_link) . '">' . esc_html($child_term->name) . '</a> </li>';
            }
        }
        echo '</ul>'; // 结束二级分类列表
    }

    // 增加当前分类的查看次数
    if (is_tax('class-room-type')) {
        $term_id = get_queried_object_id();
        increment_term_view_count($term_id); // 增加查看次数
    }
    ?>

</main>

<?php get_footer(); ?>
