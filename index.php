<?php get_header(); ?>

<!-- ランキング用 -->
<?php
add_action('wp', function () {
    // 检查是否是在 'classroom' 文章类型的 'class-room-type' 分类页面
    if (is_tax('class-room-type')) {
        $term_id = get_queried_object_id(); // 获取当前分类的 ID
        increment_term_view_count($term_id); // 增加浏览次数
    }
});
?>

<main>
    <!-- パンくずリスト -->
    <?php get_template_part('template-parts/breadcrumb'); ?>

    <h2>新着情報</h2>

    <!-- 新着情報一覧 -->
    <div class="">

        <div class="">
            <p>イベント情報</p>
            <p>○月○日</p><br>
            <p>テキストが入ります。テキストが入ります。</p>
        </div>

        <div class="">
            <p>イベント情報</p>
            <p>○月○日</p><br>
            <p>テキストが入ります。テキストが入ります。</p>
        </div>

        <div class="">
            <p>イベント情報</p>
            <p>○月○日</p><br>
            <p>テキストが入ります。テキストが入ります。</p>
        </div>

    </div>
</main>


<?php get_footer(); ?>
