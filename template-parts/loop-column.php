<div class="inner__slider">
    <div class="wrap__card">
        <a href="<?php echo the_permalink(); ?>">
            <div class="container__card">
                <div class="container__img">
                    <?php
                    $img_link = get_the_post_thumbnail_url(get_the_ID());

                    if ($img_link): ?>
                        <img class="img__card" src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="施設写真">
                    <?php else: ?>
                        <img class="img__card" src="<?php echo get_template_directory_uri(); ?>/assets/images/noimage.png" alt="施設写真">
                    <?php endif; ?>
                </div>
                <div class="container__info">
                    <div class="title__info">
                        <h2>
                            <?php
                            $days = 7;  // NEWを付ける最新記事の期間(日数)
                            $today = date_i18n('U');  // 現在の時間
                            $entry = get_the_time('U');  // 投稿日の時間
                            $term = date('U', ($today - $entry)) / 86400;   // 投稿日からの日数を算出(60x60x24=86400s)
                            if ($days > $term) {
                                echo '<span class="new">NEW</span>'; //  条件合致時に表示する文字
                            }
                            ?>
                            <?php echo the_title(); ?>
                        </h2>
                    </div>
                    <div class="note__column">
                        <?php echo the_excerpt(); ?><!-- 抜粋 -->
                    </div>
                    <div class="container__date">
                        <div class="icon__edit">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pencil.png" alt="編集アイコン">
                        </div>
                        <time class="date__edit" datetime="<?php the_time('y-m-d'); ?>">
                            <?php the_time('Y年m月d日') ?>
                        </time>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
