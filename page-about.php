<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <main>

            <div class="inner_main">

                <!-- 本文記述 -->
                <section class="wrap_about">
                    <h1 class="title_about">
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
            </div>
        </main>

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
