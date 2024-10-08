<div class="inner__slider" id="post-<?php the_ID(); ?>" <?php post_class('cardList_item'); ?>>
    <div class="wrap__card">
        <div class="container__card">
            <a href="<?php echo the_permalink(); ?>">
                <div class="container__img">
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('medium'); ?>
                    <?php else: ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/noimage.png" alt="">
                    <?php endif; ?>
                </div>
                <div class="container__info">
                    <div class="title__info">
                        <h2><?php the_title(); ?></h2>
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
</div>
