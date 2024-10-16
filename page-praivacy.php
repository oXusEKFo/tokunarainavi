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
