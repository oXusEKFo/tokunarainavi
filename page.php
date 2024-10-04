<?php get_header(); ?>

<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <main>
      <?php get_template_part('template-parts/breadcrumb'); ?>
      <section class="section">
        <div class="section_inner">
          <div class="contact_form">
            <h2 class=""><?php the_title(); ?></h2>
          </div>

          <div class="section_body">
            <div class="content">

              <?php the_content(); ?>

            </div>
          </div>
        </div>
      </section>
    </main>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer() ?>
