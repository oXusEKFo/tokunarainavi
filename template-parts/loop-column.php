<div class="inner__slider">
    <div class="wrap__card">
        <a href="<?php echo the_permalink(); ?>">
            <div class="container__card">
                <div class="container__img">
                    <img class="img__card" src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="施設写真">
                </div>
                <div class="container__info">
                    <div class="title__info">
                        <h2><?php echo the_title(); ?></h2>
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
        </a>
    </div>
</div>
