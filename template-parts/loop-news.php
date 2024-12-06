<li>
    <a href="<?php the_permalink(); ?>">
        <div class="tag__news">
            <h3>
                <?php
                $days = 7;  // NEWを付ける最新記事の期間(日数)
                $today = date_i18n('U');  // 現在の時間
                $entry = get_the_time('U');  // 投稿日の時間
                $term = date('U', ($today - $entry)) / 86400;   // 投稿日からの日数を算出(60x60x24=86400s)
                if ($days > $term) {
                    echo '<span class="new">NEW</span>'; //  条件合致時に表示する文字
                }
                ?>
                <?php the_title(); ?>
            </h3>
            <time datetime="<?php the_time('y-m-d'); ?>"><?php the_time('y.m.d') ?> </time>
        </div>
        <div class="note__news">
            <?php echo the_excerpt(); ?>
        </div>

    </a>
</li>
