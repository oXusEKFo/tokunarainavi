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

        <!-- category-name -->
        <!-- <?php
                $categories = get_the_category();
                if ($categories):
                ?>
            <div class="card_label">
                <?php foreach ($categories as $category): ?>
                    <span class="label label-black"><?php echo $category->name; ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?> -->


        <div class="card_body">

            <h2 class="card_title"><?php the_title(); ?></h2>
            <p> <?php echo the_excerpt(); ?></p> <!-- 抜粋 -->
            <time datetime="<?php the_time('y-m-d'); ?>"><?php the_time('Y年m月d日') ?> </time>
        </div>
    </a>
</section>
