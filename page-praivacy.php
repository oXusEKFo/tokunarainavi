<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <main>

            <section class="container_bread-crumb">
                <div class="bread-crumb">
                    <p><a href="<?php echo home_url(); ?>">TOP</a> &gt;
                        <span class="under-line"><?php the_title(); ?></span>
                    </p>
                </div>
            </section>
            <!-- 本文記述 -->
            <section class="wrap__privacy">
                <h1 class="title__privacy">
                    <?php the_title(); ?>
                </h1>
                <div class="wrap__description">
                    <div class="description__privacy">
                        <div class="note__privacy">
                            <?php the_content(); ?>
                        </div>
                    </div>

                </div>
            </section>
        </main>

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
