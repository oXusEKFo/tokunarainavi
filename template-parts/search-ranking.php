 <?php
    $args = [
        'taxonomy'   => 'classtype',
        'meta_key'   => 'view_count',
        'orderby'    => 'meta_value_num',
        'order'      => 'DESC',
        'hide_empty' => false,
        // 'number'     => 5,
    ];
    $argc = [
        'taxonomy'   => 'classtype',
        'orderby' => 'slug',
    ];

    $terms = get_terms($args);
    $termc = get_terms($argc);

    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            if (strpos($term->slug, 'class') !== false) {
                continue;
            }
            $view_count = get_term_meta($term->term_id, 'view_count', true);
            $term_link = get_term_link($term);
            if (!is_wp_error($term_link)) {

                echo '<p><a href="' . esc_url($term_link) . '">' . esc_html($term->name) . '</a> - ブラウズ回数: ' . esc_html($view_count) . '</p>';
            }
        }
    } else {
        echo '分類されていない、または分類されていないブラウズ回数レコード。';
    }
    ?>
