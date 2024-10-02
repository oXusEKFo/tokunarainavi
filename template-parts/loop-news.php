<section id="post-<?php the_ID(); ?>" <?php post_class('cardList_item'); ?>>
    <a href="<?php the_permalink(); ?>" class="card">




        <div class="card_body">

            <h2 class="card_title"><?php the_title(); ?></h2>

            <time datetime="<?php the_time('m-d'); ?>"><?php the_time('m月d日') ?> </time>
            <p> <?php echo the_excerpt(); ?></p> <!-- 抜粋 -->
        </div>
    </a>
</section>
