<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <main>
            <!-- パンくずリスト -->
            <section class="container_bread-crumb">
                <div class="bread-crumb">
                    <p>
                        <a href="<?php echo home_url(); ?>">TOP</a> &gt;
                        <span class="under-line"><?php the_title(); ?></span>
                    </p>
                </div>
            </section>


            <!-- 固定の部分 -->
            <section class="wrap_fixed_content">
                <div class="inner_main">
                    <div class="landing">
                        <div class="inner__kv">
                            <div class="wrap__question_kv">
                                <div class="container__question_kv_mo">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/question_kv_mo.png" alt="question_kv_mo" />
                                </div>
                                <div class="container__question_kv_p">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/question_kv_p.png" alt="question_kv_p" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 他の固定内容を追加 -->
                    <div class="question">
                        <div class="inner__question">
                            <div class="title__question">
                                <p>
                                    最近では、子どもの習いごとがますます注目されています。習いごとは、スキルを身につけるだけでなく、子どもたちが自分を表現したり、社会性を育んだりする場にもなっています。
                                </p>
                                <br />
                                <p>
                                    徳島県内では、いろいろなジャンルの習いごとが提供されており、保護者の方々も子どもの興味や将来を考えて、どの教室に通わせるか悩んでいるようです。
                                </p>
                                <br />
                                <p>
                                    そこで、当サイトでは徳島県内の保護者の皆さんにアンケートを実施し、今どんな習いごとが人気なのか、また保護者の期待や心配ごとについてお聞きしました。ここでは、そのアンケート結果をもとに、最近の習いごとの状況をご紹介します。
                                </p>
                                <h2 class="top10">人気の習いごと TOP10</h2>
                            </div>

                            <div class="order__question1">
                                <ul>
                                    <li class="order" data-order="1">水泳</li>
                                    <li class="order" data-order="2">ピアノ</li>
                                    <li class="order" data-order="3">書道・硬筆</li>
                                </ul>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/swimming_i.png" alt="水泳" class="order_image1" />
                            </div>

                            <div class="order__question2">
                                <ul>
                                    <li class="order" data-order="4">体操</li>
                                    <li class="order" data-order="5">サッカー</li>
                                    <li class="order" data-order="6">英会話</li>
                                    <li class="order" data-order="7">リトミック</li>
                                    <li class="order" data-order="8">HIPHOP</li>
                                    <li class="order" data-order="9">そろばん</li>
                                    <li class="order" data-order="10">バスケットボール</li>
                                </ul>
                            </div>

                            <!-- 他のセクションを追加 -->
                            <div class="chart">
                                <div class="container__chart">
                                    <div class="image__chart">
                                        <h2 class="title_decor">現在、習いごとに通わせていますか？</h2>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/lesson_situation.png" alt="chart" />
                                    </div>
                                    <div class="image__chart">
                                        <h2 class="title_decor">お子様が通われている習いごとの数は？</h2>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/lesson_number.png" alt="chart" />
                                    </div>
                                </div>
                            </div>

                            <div class="chart">
                                <div class="container__chart">
                                    <div class="image__chart">
                                        <h2 class="title_decor">何歳頃から習いごとを始めましたか？</h2>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/lesson_age.png" alt="chart" />
                                    </div>
                                    <div class="image__chart">
                                        <h2 class="title_decor">習いごとの費用は1人あたり毎月いくら？</h2>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/lesson_cost.png" alt="chart" />
                                    </div>
                                </div>
                            </div>

                            <div class="chart">
                                <div class="container__chart">
                                    <div class="image__chart">
                                        <h2 class="title_decor">習いごと選びで重視するポイントは？</h2>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/lesson_point.png" alt="chart" />
                                    </div>
                                    <div class="image__chart">
                                        <h2 class="title_decor">習いごとでアップさせたいスキルは？</h2>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/lesson_skill.png" alt="chart" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </main>

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
