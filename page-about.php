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
            <section class="wrap_about">
                <h1 class="title__about">
                    <?php the_title(); ?>
                </h1>
                <div class="wrap_description">
                    <div class="description_about">
                        <div class="note_about">
                            <?php the_content(); ?>
                        </div>
                    </div>

                </div>
            </section>
        </main>

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
