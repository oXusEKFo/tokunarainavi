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
            <section class="wrap__about">
                <h1 class="title__about">
                    <?php the_title(); ?>
                </h1>
                <div class="wrap__description">
                    <div class="description__about">
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
        </main>

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
