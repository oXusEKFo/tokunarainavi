<?php get_header(); ?>
<main>
    <!--  -->
    <div class="inner_main">
        <div class="container_breadCrumb">
            <div class="breadCrumb">
                <p>TOP &gt;コラム一覧 &gt;
                    <span class="underLine">コラム詳細</span>
                </p>
            </div>
        </div>

        <!-- コラム一覧カード -->
        <section class="column_area">
            <div class="inner_column-area">
                <article class="wrap_column">
                    <div class="wrap_edit-date">
                        <div class="edit-icon">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/pencil.png" alt="編集アイコン">
                        </div>
                        <time class="edit_date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日') ?>
                        </time>
                    </div>
                    <div class="column_title">
                        <h2><?php the_title(); ?></h2>
                    </div>
                    <div class="column_content">
                        <?php the_content(); ?>
                    </div>
                </article>
            </div>
            <aside class="related">
                <div class="wrap_related">
                    <div class="container_related-title">
                        <h2>関連記事</h2>
                    </div>
                    <div class="inner_related-area">
                        <div class="wrap_column-card">
                            <!-- <div class="inner_column-card"> -->
                            <div class="container_card-img">
                                <img class="related_img" src="../../assets/images/pcchild.jpg" alt="施設写真" />
                            </div>
                            <div class="container_cardInfo">
                                <div class="card_title">
                                    <h2>PROGRAMMING SCHOOL GEEK</h2>
                                </div>
                                <div class="card_note">
                                    <p>みんな パソコン教室に行ったことある？この間 ぼくは初めてパソコン教室に行ったよ！まずは タイピング練習！先生がわかりやすく教えてくれるから すぐできるようになったんだ。それから、プログラミングで自分だけのゲームを作る体験もできたよ。自分のゲームが動いた瞬間は、思わず「やったー！」って声が出た！すごく楽しい一日だったよ。みんなも体験してみて！</p>
                                </div>
                                <div class="wrap_edit-date">
                                    <div class="edit-icon">
                                        <img src="../../assets/images/pencil.png" alt="編集アイコン">
                                    </div>
                                    <div class="edit_date">
                                        2024年&#9679;月&#9679;日
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <script>
                            // コラムカード 繰り返し表示
                            for (let i = 0; i < 4; i++) {
                                const card = document.querySelector('.wrap_column-card');
                                const clone = card.cloneNode(true);
                                document.querySelector('.inner_related-area').appendChild(clone);
                            }
                        </script>
                    </div>
                </div>
            </aside>
        </section>
        <!-- コラムカードここまで -->

        <section class="footer_column">
            <div class="container_pageNum">
                <div class="column_pageNum">
                    <p>
                        &lt　1　2　3　&gt
                    </p>
                </div>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>
