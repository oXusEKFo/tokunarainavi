<div class="wrap_card">
    <div class="inner_card">

        <!-- アイキャッチ画像 -->
        <div class="container_cardImg">
            <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('medium', array('class' => 'card_img')); ?>
                <?php else: ?>
                    <img class="card_img" src="<?php echo get_template_directory_uri(); ?>/assets/images/noimage.png" alt="">
                <?php endif; ?>
            </a>

            <!-- お気に入りボタン -->
            <div class="tag__favorite">
                <!-- ※ 以下svgはプラグイン内に直接記述しています -->
                <!-- <svg class="layer_2" data-name="layer_2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 132 37">
                <g class="layer_1" data-name="layer_1">
                    <g>
                        <polygon class="cls-1" points="131 1 1 1 1 36 131 36 120.02 18.5 131 1" />
                        <path class="cls-2" d="M131,37H1c-.55,0-1-.45-1-1V1C0,.45.45,0,1,0h130c.36,0,.7.2.88.52s.17.71-.03,1.02l-10.64,16.97,10.64,16.97c.19.31.2.7.03,1.02s-.51.52-.88.52ZM2,35h127.19l-10.02-15.97c-.2-.32-.2-.74,0-1.06l10.02-15.97H2v33Z" />
                    </g>
                </g>
            </svg> -->
                <?php if (function_exists('the_favorites_button')) {
                    the_favorites_button($post->ID);
                } ?>
            </div>
        </div> <!-- container_cardImgここまで -->


        <div class="container_cardInfo">
            <!-- 教室名 -->
            <div class="card_title">
                <a href="<?php the_permalink(); ?>">
                    <h2><?php the_title(); ?></h2>
                </a>
            </div>

            <div class="card_details">
                <!-- 住所 -->
                <div class="card_detail">
                    <span class="detail_label">住所</span>
                    <span class="detail_value"><?php echo get_field('address'); ?></span>
                </div>

                <!-- 対象年齢 -->
                <div class="card_detail">
                    <span class="detail_label">対象年齢</span>
                    <span class="detail_value"><?php echo get_field('age'); ?></span>
                </div>
            </div>

            <!-- ジャンル -->
            <div class="card_area">
                <div class="design_area">
                    <img class="icon_design" src="<?php echo get_template_directory_uri(); ?>/assets/images/LINE1.png" alt="デザイン画像" />
                    <img class="icon_category" src="<?php echo get_template_directory_uri(); ?>/assets/icon/icon_<?php $terms = wp_get_post_terms(get_the_ID(), 'classtype');
                                                                                                                    if (!empty($terms) && !is_wp_error($terms)) {
                                                                                                                        foreach ($terms as $term) {
                                                                                                                            // 子カテゴリーが選択されていればそのスラッグを使用
                                                                                                                            if ($term->parent != 0) {
                                                                                                                                echo esc_attr($term->slug);
                                                                                                                                break; // 最初の子カテゴリーのみ取得
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>.png" alt="カテゴリーアイコン" />
                </div> <!-- design_areaここまで -->

                <div class="genre_area">
                    <div class="genre_detail">
                        <span class="genre_label">ジャンル</span>
                        <span class="genre_value">
                            <?php
                            $parent_terms = [];
                            foreach ($terms as $term) {
                                // 親カテゴリーが選択されていればそのまま表示
                                if ($term->parent == 0) {
                                    $parent_terms[] = $term;
                                } else {
                                    // 子カテゴリーしか選択されていない場合、その親カテゴリーを取得
                                    $parent_term = get_term($term->parent, 'classtype');
                                    if (!is_wp_error($parent_term) && $parent_term) {
                                        $parent_terms[] = $parent_term;
                                    }
                                }
                            }

                            // 親カテゴリーを一度だけ表示するように、重複を排除
                            $parent_terms = array_unique($parent_terms, SORT_REGULAR);

                            // 親カテゴリーを表示
                            foreach ($parent_terms as $parent_term) {
                                echo esc_html($parent_term->name) . ' ';
                            }
                            ?>
                        </span>
                    </div>
                </div> <!-- genre_areaここまで -->
            </div> <!-- card_areaここまで -->

        </div> <!-- container_cardInfoここまで -->

    </div> <!-- inner_cardここまで -->
</div> <!-- wrap_cardここまで -->
