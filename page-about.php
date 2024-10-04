<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <main>

            <div class="inner_main">


            </div>
            </section>
            <!-- 本文記述 -->
            <section class="wrap_about">
                <h1 class="title_about">
                    <?php the_title(); ?>

                </h1>
                <div class="wrap_description">
                    <div class="description_about">
                        <h2>
                            <?php the_content(); ?>

                        </h2>
                        <div class="note_about">

                        </div>
                    </div>
                    <div class="description_howto">
                        <h2>
                            <?php the_content(); ?>

                        </h2>
                        <div class="note_howto">

                        </div>
                    </div>
                    <div class="description_for-class">
                        <h2>
                            <?php the_content(); ?>

                        </h2>
                        <div class="note_for-class">



                        </div>
                    </div>
                </div>
            </section>
            </div>
        </main>

    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
