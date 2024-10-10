<?php get_header(); ?>
<main>
    <div class="inner__main">
        <h2>コラム<?php single_term_title(''); ?></h2>
        <div class="container__breadCrumb">
            <div class="breadCrumb">
                <?php get_template_part('template-parts/breadcrumb'); ?>
            </div>
        </div>


        <!-- コラム一覧カード -->
        <div class="column__area">
            <div class="column__title">
                <h1>COLUMN</h1>
                <p>コラム</p>
            </div>

            <div class="inner__column-area">
                <?php
                $column_terms=get_terms(['taxonomy'=>'column']);
                if(!empty($column_terms)):?>
                <?php foreach($column_terms as $value):?>
                    <div>
                        <div>
                            <a href="<?php echo get_term_link($value); ?>"><?php echo $value->name;?></a>
                        </div>
                    </div>

                <div class="wrap__column-card">
                    <div class="inner__column-card">
                        <?php if (have_posts()): ?>
                            <?php while (have_posts()): the_post(); ?>
                                <?php get_template_part('template-parts/loop', 'column'); ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <!-- <div class="container__card-img">
                            <img class="card_img" src="../../assets/images/pcchild.jpg" alt="施設写真" width="300" height="200" />
                        </div>
                        <div class="container__card-info">
                            <div class="card_title">
                                <h2>PROGRAMMING SCHOOL GEEK</h2>
                            </div>
                            <div class="card__note">
                                <p>みんな パソコン教室に行ったことある？この間 ぼくは初めてパソコン教室に行ったよ！まずは タイピング練習！先生がわかりやすく教えてくれるから すぐできるようになったんだ。それから、プログラミングで自分だけのゲームを作る体験もできたよ。自分のゲームが動いた瞬間は、思わず「やったー！」って声が出た！すごく楽しい一日だったよ。みんなも体験してみて！</p>
                            </div>
                            <div class="wrap__card-date">
                                <div class="card__edit-icon">
                                    <img src="../../assets/images/pencil.png" alt="編集アイコン" width="30" height="30">
                                </div>
                                <div class="card__date">
                                    2024年&#9679;月&#9679;日
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- <script>
                    // コラムカード 繰り返し表示
                    for (let i = 0; i < 3; i++) {
                        const card = document.querySelector('.wrap__column-card');
                        const clone = card.cloneNode(true);
                        document.querySelector('.inner__column-area').appendChild(clone);
                    }
                </script> -->
            </div>
        </div>
    </div>
</main>
