<?php get_header(); ?>

<main>
    <div class="breadCrumb__wrap">
        <div class="breadCrumb">
            <?php get_template_part('template-parts/breadcrumb'); ?>
        </div>
    </div>

    <div class="landing">
        <div class="inner__kv">
            <div class="wrap__question-kv">
                <div class="container__question-kv-mo">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/question_banner_mo.png"
                        alt="question_kv_mo" />
                </div>
                <div class="container__question-kv-p">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/question_kv_p.png"
                        alt="question_kv_p" />
                </div>
            </div>
        </div>
    </div>

    <div class="inner__main">
        <div class="inner__question">
            <div class="title__question">
                <h1>「いつ、何を、どう選ぶ？」徳島の習いごとを徹底調査！</h1>
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
                <h2 class="top__10">人気の習いごと TOP10</h2>
            </div>

            <div class="order__question-1">
                <ul>
                    <li class="order" data-order="1">水泳</li>
                    <li class="order" data-order="2">ピアノ</li>
                    <li class="order" data-order="3">書道・硬筆</li>
                </ul>
                <img
                    src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/swimming_i.png"
                    alt="水泳"
                    class="order__image-1" />
            </div>

            <div class="order__question-2">
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

            <div class="title__question">
                <h2 class="top__10">将来通わせたい習いごと TOP10</h2>
            </div>

            <div class="order__question-1">
                <ul>
                    <li class="order" data-order="1">英会話</li>
                    <li class="order" data-order="2">ピアノ</li>
                    <li class="order" data-order="3">書道・硬筆</li>
                </ul>
                <img
                    src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/english_conversation1.png"
                    alt="英会話"
                    class="order__image-2" />
            </div>

            <div class="order__question-2">
                <ul>
                    <li class="order" data-order="4">水泳</li>
                    <li class="order" data-order="5">プログラミング</li>
                    <li class="order" data-order="6">体操</li>
                    <li class="order" data-order="7">そろばん</li>
                    <li class="order" data-order="8">阿波踊り</li>
                    <li class="order" data-order="9">絵画・造形</li>
                    <li class="order" data-order="10">HIPHOP</li>
                </ul>
            </div>

            <div class="chart">
                <div class="container__chart">
                    <div class="image__chart">
                        <h2 class="title__decor">現在、習いごとに通わせていますか？</h2>
                        <img
                            src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/lesson_situation.png"
                            alt="chart" />
                    </div>

                    <div class="image__chart">
                        <h2 class="title__decor">お子様が通われている習いごとの数は？</h2>
                        <img
                            src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/lesson_number.png"
                            alt="chart" />
                    </div>
                </div>
            </div>

            <div class="chart">
                <div class="container__chart">
                    <div class="image__chart">
                        <h2 class="title__decor">何歳頃から習いごとを始めましたか？</h2>
                        <img
                            src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/lesson_age.png"
                            alt="chart" />
                    </div>

                    <div class="image__chart">
                        <h2 class="title__decor">習いごとの費用は1人あたり毎月いくら？</h2>
                        <img
                            src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/lesson_cost.png"
                            alt="chart" />
                    </div>
                </div>
            </div>

            <div class="chart">
                <div class="container__chart">
                    <div class="image__chart">
                        <h2 class="title__decor">習いごと選びで重視するポイントは？</h2>
                        <img
                            src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/lesson_point.png"
                            alt="chart" />
                    </div>

                    <div class="image__chart">
                        <h2 class="title__decor">習いごとでアップさせたいスキルは？</h2>
                        <img
                            src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/lesson_skill.png"
                            alt="chart" />
                    </div>
                </div>
            </div>

            <div class="question__comment">
                <h3 class="comment__title">―まとめ―</h3>
                <p>
                    今回のアンケート結果から、徳島県の保護者の皆さんは、お子様の「好き」を第一に考え、習いごとを選んでいることがわかりました。
                </p>
                <br />
                <p>
                    水泳やピアノといった定番の習いごとはもちろん、地域ならではの阿波踊りや、グローバルな社会で活躍するための英会話、プログラミングなどへの関心も強まっていることが注目されます。今後も、子どもたちが楽しみながら成長できる学びごとの選択が、保護者の皆さんにとって大切なテーマとなりそうです。お子様の「好き」を伸ばし、可能性をさらに広げるような習いごとに出会いたいですね。
                </p>
                <br />
                <p>今回のアンケートは2024年10月実施、121人にご協力いただきました。</p>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
