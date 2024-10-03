<?php get_header(); ?>

<main>

    <!--メモ：タイトルを取得して何らかの加工をしたい場合は「get_the_title()」に変更するといいかもしれません。ただ出力するだけなら↓のものでOK。 -->


    <!-- 取得したタイトルを出力する -->
    <h1><?php the_title(); ?></h1>

    <!-- 取得した日付を出力する -->
    <?php echo get_the_date(); ?>

    <!-- 投稿の記事本文を出力する -->
    <p><?php the_content(); ?></p>

</main>

<?php get_footer(); ?>
