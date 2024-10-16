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
<aside class="entry_form">
  <h2>ご掲載を希望される施設の方はこちら</h2>
  <p>ご掲載をご希望の方は入力フォームに</p>
  <p>入力して送信してください。</p>
  <a href="<?php echo home_url('') ?>" class="entry_btn">入力フォームへ</a>
  </asid>
  <?php get_footer() ?>
