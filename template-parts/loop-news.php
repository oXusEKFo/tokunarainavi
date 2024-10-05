<li class="news_list_item">
    <a href="<?php the_permalink(); ?>">
        <div class="news_list_date">
            <h3 class="news_title"><?php the_title(); ?></h3>
            <time datetime="<?php the_time('y-m-d'); ?>"><?php the_time('y.m.d') ?> </time>
        </div>
        <p><?php echo the_excerpt(); ?></p>
    </a>
</li>
