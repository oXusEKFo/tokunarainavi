<li>
    <a href="<?php the_permalink(); ?>">
        <div class="tag__news">
            <h3><?php the_title(); ?></h3>
            <time datetime="<?php the_time('y-m-d'); ?>"><?php the_time('y.m.d') ?> </time>
        </div>
        <div class="note__news">
            <?php echo the_excerpt(); ?>
        </div>

    </a>
</li>
