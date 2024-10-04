<?php get_header(); ?>

<main>
    <!-- 人気なジャンル -->
    <section>
        <?php
        $args = [
            'taxonomy'   => 'classtype',
            'meta_key'   => 'view_count',
            'orderby'    => 'meta_value_num',
            'order'      => 'DESC',
            'hide_empty' => false,
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
        wp_reset_postdata();
        ?>
    </section>

    <!-- 人気な教室 -->
    <section>
        <?php
        $args = [
            'post_type'   => 'classroom',
            'meta_key'       => 'post_views',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC',

        ];
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()):
            while ($the_query->have_posts()): $the_query->the_post();
        ?>
                <?php get_template_part('template-parts/loop', 'classroom'); ?>

        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </section>


</main>

<?php get_footer(); ?>
