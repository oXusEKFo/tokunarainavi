<section id="post-<?php the_ID(); ?>" <?php post_class('cardList_item'); ?>>
    <a href="<?php the_permalink(); ?>" class="card">

        <!-- アイキャッチ画像 -->
        <div class="card_pic">
            <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('medium'); ?>
            <?php else: ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/common/noimage.png" alt="">
            <?php endif; ?>
        </div>

        <div class="card_body">

            <h2 class="card_title"><?php the_title(); ?></h2>
            <?php echo get_field('address'); ?>
            <ul>

            </ul>

        </div>
    </a>
</section>
