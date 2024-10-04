<section id="post-<?php the_ID(); ?>" <?php post_class('cardList_item'); ?>>


    <section class="results_card">
        <div class="wrap_card">
            <div class="inner_card">

                <!-- アイキャッチ画像 -->
                <div class="container_cardImg">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('medium', array('class' => 'card_img')); ?>
                        <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/noimage.png" alt="">
                        <?php endif; ?>
                    </a>
                    <?php if (function_exists('the_favorites_button')) {
                        the_favorites_button($post->ID);
                    }
                    ?>
                    <img class="tag_favorite" src="<?php echo get_template_directory_uri(); ?>/assets/images/add_favorite.png" alt="お気に入りリストに追加" />
                </div>

                <div class="container_cardInfo">
                    <!-- 教室名 -->
                    <div class="card_title">
                        <a href="<?php the_permalink(); ?>">
                            <h2 class="card_title"><?php the_title(); ?></h2>
                        </a>
                    </div>

                    <!-- 住所 -->
                    <p>住所： <?php echo get_field('address'); ?>
                    </p>

                    <!-- ジャンル -->
                    <p>ジャンル：
                        <?php
                        $terms = wp_get_post_terms(get_the_ID(), 'classtype');
                        if (!empty($terms) && !is_wp_error($terms)) {
                            foreach ($terms as $term) {
                                echo  esc_html($term->name) . ' ';
                            }
                        } ?>
                    </p>

                    <!-- 対象年齢 -->
                    <p>対象年齢：
                        <?php echo get_field('age'); ?>
                    </p>
                    <ul>



                    </ul>
                </div>
            </div>
        </div>
    </section>

</section>
