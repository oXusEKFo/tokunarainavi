<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <main>
            <div class="breadCrumb__wrap">
                <div class="breadCrumb">
                    <?php get_template_part('template-parts/breadcrumb'); ?>
                </div>
            </div>
            <!-- 本文記述 -->
            <section class="wrap__rule">
                <h1 class="title__rule">
                    <?php the_title(); ?>
                </h1>
                <div class="wrap_description">
                    <div class="description__rule">
                        <div class="note__rule">
                            <?php the_content(); ?>
                        </div>
                    </div>

                </div>
            </section>
        </main>

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
