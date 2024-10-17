<?php get_header(); ?>

<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <main>

      <!-- パンくず -->
      <div class="breadCrumb__wrap">
        <div class="breadCrumb">
          <?php get_template_part('template-parts/breadcrumb'); ?>
        </div>
      </div>

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
