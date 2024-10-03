<?php get_header(); ?>

<main>
    <div class="inner_main">
        <!-- パンくずリスト -->
        <section class="container_bread-crumb">
            <div class="bread-crumb">
                <p><a href="<?php echo home_url(); ?>">TOP</a> &gt;
                    <span class="under-line"><?php the_title(); ?></span>
                </p>
            </div>
        </section>

        <!-- 本文記述 -->
        <section class="wrap_about">
            <h1 class="title_about">
                <?php the_title(); ?>
            </h1>
            <div class="wrap_description">
                <div class="description_about">
                    <h2>とくしま習いごとナビとは</h2>
                    <div class="note_about">
                        「とくしま習いごとナビ」は、徳島県内で習い事やワークショップに参加する機会を提供することで、地域社会の発展と文化・技術の継承を支援します。ユーザー、クライアント、そして制作側すべてにとって価値のあるプラットフォームを構築し、徳島の魅力を広く発信することを目指します。
                    </div>
                </div>
                <div class="description_howto">
                    <h2>このサイトの使い方</h2>
                    <div class="note_howto">
                        検索の仕方など、こども食堂ナビのようなのが必要？・・・・
                    </div>
                </div>
                <div class="description_for-class">
                    <h2>掲載されている教室の方へ</h2>
                    <div class="note_for-class">
                        掲載内容に変更がある場合は、お問い合わせフォームよりお問い合わせください。確認後、ご連絡させていただきます。
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
