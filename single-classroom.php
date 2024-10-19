<!-- ランキング用 -->
<?php
$post_id = get_the_ID();
$terms = wp_get_post_terms($post_id, 'classtype');
if (!empty($terms) && !is_wp_error($terms)) {
    $term_ids = [];
    foreach ($terms as $term) {
        $term_ids[] = $term->term_id;
        increment_term_view_count($term->term_id);
    }
}
wp_reset_postdata();



// タクソノミーを配列へ（主にタグ表示）
$post_id = get_the_ID();
$taxonomies = array(
    // 'classtype',
    // 'area',
    'date_type',
    // 'access_type',
    // 'age_type',
    'skill_type',
    'personality_type',
    'cost_type',
    // 'weektimes',
    'column_type'
);


$terms = wp_get_post_terms(get_the_ID(), 'classtype'); // タクソノミー 'classtype' で現在の教室の用語を取得

// 親タクソノミーと子タクソノミーのスラッグを格納する変数
$parent_slug = '';
$child_slug = '';
$parent_taxonomy = null;
$child_taxonomy = null;

if (!empty($terms)) {
    foreach ($terms as $term) {
        // 親か子かを確認
        if ($term->parent == 0) {
            $parent_slug = $term->slug; // 親のスラッグを取得
            $parent_taxonomy = $term;    // 親タクソノミーを格納
        } else {
            $child_slug = $term->slug; // 子のスラッグを取得
            $child_taxonomy = $term;   // 子タクソノミーを格納
        }
    }
}


// 教室の投稿IDを取得
$classroom_id = get_the_ID();

// 教室に紐付けられたコラムを取得するクエリ
$args = array(
    'post_type' => 'column', // コラムの投稿タイプ
    'meta_query' => array(
        array(
            'key' => 'class-room-id',  // コラム記事に登録されている教室IDのフィールド
            'value' => $classroom_id,
            'compare' => '='
        )
    )
);
// WP_Queryを使用してコラム記事を取得
$related_columns = new WP_Query($args);


// カスタムフィールドを変数へ
$cost = get_field('fee');
$age = get_field('age');
$weekday_time = get_field('dayhours');
$tel = get_field('tel');
$memo = get_field('memo');
$genre = get_field('genre');
$address = get_field('address');
$sub_pic = get_field('sub_pic');
$map = get_field('iframe');
$site_url = get_field('link');
$instagram_url = get_field('instagram'); // インスタグラムのURLをカスタムフィールドから取得
$facebook_url = get_field('facebook'); // フェイスブックのURLをカスタムフィールドから取得
$x_url = get_field('xlink');
$blog_link = get_field('blog_link');
$line_link = get_field('line');


//コースのフィールドを読み込む
for ($i = 1; $i <= 5; $i++) {
    // カスタムフィールドの値を取得
    $course[] = get_post_meta(get_the_ID(), 'course' . $i, true);
}
?>

<?php get_header(); ?>

<main>
    <!--  -->
    <div class="inner__main">
        <!--パンくずリスト-->
        <div class="container_breadcrumb">
            <div class="breadCrumb">
                <?php get_template_part('template-parts/breadcrumb'); ?>
            </div>
        </div>

        <!-- 施設写真スライド -->
        <section class="outline__results">
            <div class="details__slide">
                <div class="container__slide">
                    <div class="slider__area">
                        <div class="slider">
                            <!-- メイン画像を動的に取得 -->
                            <?php for ($i = 1; $i <= 4; $i++): ?>
                                <?php
                                // 画像のカスタムフィールドを取得
                                $main_image = get_field('pic' . $i);
                                ?>
                                <?php if ($main_image): ?>
                                    <div class="wrap__mainImg">
                                        <img src="<?php echo esc_url($main_image['url']); ?>" alt="<?php echo esc_attr($main_image['alt']); ?>" />
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <!-- お気に入りボタン -->
                        <a href="" class="tag__favorite1">
                            <?php if (function_exists('the_favorites_button')) {
                                the_favorites_button($post->ID);
                            } ?>
                        </a>
                    </div>

                    <!-- サムネイル画像 -->
                    <div class="thumbnail">
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <?php
                            // サムネイル画像のカスタムフィールドを取得
                            $thumbnail = get_field('pic' . $i);
                            ?>
                            <?php if ($thumbnail): ?>
                                <div class="wrap__thumbnailImg">
                                    <img src="<?php echo esc_url($thumbnail['url']); ?>" alt="<?php echo esc_attr($thumbnail['alt']); ?>" data-slide-index="<?php echo $i - 1; ?>" />
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>

                    </div>
                </div>
            </div>
            <div class="details__info">
                <div class="inner__details-info">
                    <div class="wrap__details-outline">
                        <div class="details__title">
                            <h2><?php the_title(); ?></h2>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/greencircle.png" alt="グリーンサークル" class="circle__green">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/yellowcircle.png" alt="イエローサークル" class="circle__yellow">
                        </div>
                        <div class="details__address">
                            <div class="details__address">
                                <p><?php echo esc_html($address); ?></p>
                            </div>
                        </div>
                        <ul class="container__keywords">
                            <?php
                            foreach ($taxonomies as $taxonomy) {
                                $terms = get_the_terms($post_id, $taxonomy);
                                if (!empty($terms) && !is_wp_error($terms)) {
                                    foreach ($terms as $term) {
                                        echo '<li class="keyword">' . '<a href="">' . esc_html($term->name) . '</a>' . '</li>';
                                    }
                                }
                            }
                            ?>
                        </ul>
                        <div class="details__description">
                            <p><?php echo the_content(); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="details__container">
            <div class="details__containerL">
                <div class="info__overlay">
                    <h3>詳細情報</h3>
                    <?php
                    if ($related_columns->have_posts()) {
                        while ($related_columns->have_posts()) {
                            $related_columns->the_post();
                    ?>
                            <p><a href="<?php the_permalink(); ?>">この教室についての<br>コラムはこちら→</a></p>
                        <?php
                        }
                        ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/matcha.png" alt="緑丸" class="circle__matcha">
                    <?php  }
                    // 投稿データをリセット
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="details__genre">
                    <h4>ジャンル</h4>
                    <?php
                    // $child_taxonomy が null でないかをチェック
                    if ($child_taxonomy) {
                        echo '<p>' . esc_html($child_taxonomy->name) . '</p>';
                    } ?>
                </div>
                <div class="details__genre">
                    <h4>対象年齢</h4>
                    <p><?php echo esc_html($age); ?></p>
                </div>
                <div class="details__genre">
                    <h4>料金について</h4>
                    <p><?php echo $cost; ?></p>
                </div>
                <div class="details__genre">
                    <h4>おすすめのコース</h4>
                    <?php
                    for ($i = 0; $i < count($course); $i++) {
                        if (!empty($course[$i])) { ?>
                            <p><?php echo esc_html($course[$i]); ?></p>
                    <?php }
                    } ?>
                </div>
            </div>
            <div class="details__containerR">
                <div class="details__genre">
                    <h4>曜日・時間帯</h4>
                    <p><?php echo $weekday_time ?></p>
                </div>
                <div class="details__genre">
                    <h4>備考</h4>
                    <p><?php echo $memo ?></p>
                </div>
                <?php if ($tel): ?>
                    <div class="details__genre">
                        <h4>電話番号</h4>
                        <p><a class="class__tel" href="tel:<?php echo $tel ?>"><?php echo $tel ?></a></p>
                        <p class="pc_tel"><?php echo $tel ?></p>
                    </div>
                <?php endif; ?>
                <?php if ($site_url || $x_url || $instagram_url || $facebook_url || $blog_link || $line_link): ?>
                    <div class="details__genre">
                        <h4>公式サイト・SNSはこちら</h4>
                        <?php if ($site_url): ?>
                            <a href="<?php echo esc_url($site_url); ?>" target="_blank" rel="noopener noreferrer">
                                <img class="icon__sns" src="<?php echo get_template_directory_uri(); ?>/assets/icon/website.png" alt="公式サイトURL" />
                            </a>
                        <?php endif; ?>
                        <?php if ($x_url): ?>
                            <a href="<?php echo esc_url($x_url); ?>" target="_blank" rel="noopener noreferrer">
                                <img class="icon__sns" src="<?php echo get_template_directory_uri(); ?>/assets/icon/twitter_x.svg" alt="X_URL" /></a>
                        <?php endif; ?>
                        <?php if ($instagram_url): ?>
                            <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" rel="noopener noreferrer">
                                <img class="icon__sns" src="<?php echo get_template_directory_uri(); ?>/assets/icon/instagram.svg" alt="インスタグラムURL" />
                            </a>
                        <?php endif; ?>
                        <?php if ($facebook_url): ?>
                            <a href="<?php echo esc_url($facebook_url); ?>" target="_blank" rel="noopener noreferrer">
                                <img class="icon__sns" src="<?php echo get_template_directory_uri(); ?>/assets/icon/facebook.svg" alt="フェイスブックURL" />
                            </a>
                        <?php endif; ?>
                        <?php if ($blog_link): ?>
                            <a href="<?php echo esc_url($blog_link); ?>" target="_blank" rel="noopener noreferrer">
                                <img class="icon__sns" src="<?php echo get_template_directory_uri(); ?>/assets/icon/blog.png" alt="ブログ" />
                            </a>
                        <?php endif; ?>
                        <?php if ($line_link): ?>
                            <a href="<?php echo esc_url($line_link); ?>" target="_blank" rel="noopener noreferrer">
                                <img class="icon__sns" src="<?php echo get_template_directory_uri(); ?>/assets/icon/line.svg" alt="ライン" />
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif ?>
            </div>
        </section>
        <section class="details__review">
            <div class="wrap__accordion">
                <div class="accordion__header">
                    <div class="details__map">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/map.png" alt="Mapマーク">
                        <p>地図を見る</p>
                    </div>
                </div>
                <div class="accordion__content">
                    <iframe src="https://www.google.co.jp/maps?q= <?php echo esc_html($address); ?> &output=embed&t=m&z=16&hl=ja" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="review__title">
                <h3>｜クチコミ</h3>
            </div>
            <?php comments_template() ?>
        </section>
        <section class="relatedReview__title">
            <p>おすすめの習い事</p>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/60.png">
        </section>
        <section class="results__card">
            <!-- 検索結果一覧カード -->
            <?php
            $terms = wp_get_post_terms(get_the_ID(), 'classtype'); // 現在の教室のジャンル取得
            $parent_taxonomy = null;
            $child_taxonomy = null;

            if (!empty($terms)) {
                foreach ($terms as $term) {
                    if ($term->parent == 0) {
                        $parent_taxonomy = $term;
                    } else {
                        $child_taxonomy = $term;
                    }
                }
            }

            if ($parent_taxonomy && !is_wp_error($parent_taxonomy)) {
                // 親タクソノミーに属する教室のterm_idリスト
                $term_ids = wp_list_pluck($terms, 'term_id');

                // 同じジャンルの教室を取得
                $args_same_genre = array(
                    'post_type' => 'classroom',
                    'posts_per_page' => 3, // 最大3件
                    'post__not_in' => array(get_the_ID()), // 現在の教室を除外
                    'orderby' => 'rand',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'classtype',
                            'field' => 'term_id',
                            'terms' => $child_taxonomy ? $child_taxonomy->term_id : $parent_taxonomy->term_id, // 子タクソノミーがあればそれを使用
                        ),
                    ),
                );

                $same_genre_classes = new WP_Query($args_same_genre);

                $count_same_genre = $same_genre_classes->found_posts; // 同じジャンルの教室の数

                if ($count_same_genre < 3) {
                    // 同じジャンルの教室が3件未満の場合、他のジャンルの教室を補う
                    $args_other_classes = array(
                        'post_type' => 'classroom',
                        'posts_per_page' => 3 - $count_same_genre, // 足りない数だけ取得
                        'post__not_in' => array_merge(array(get_the_ID()), wp_list_pluck($same_genre_classes->posts, 'ID')), // 現在の教室と同じジャンルの教室を除外
                        'orderby' => 'rand',
                    );

                    $other_classes = new WP_Query($args_other_classes);
                }

                // 出力処理
                if ($same_genre_classes->have_posts()) {
                    while ($same_genre_classes->have_posts()) {
                        $same_genre_classes->the_post();
                        get_template_part('template-parts/loop', 'classroom');
                    }
                    wp_reset_postdata(); // グローバル $post をリセット
                }

                if (isset($other_classes) && $other_classes->have_posts()) {
                    while ($other_classes->have_posts()) {
                        $other_classes->the_post();
                        get_template_part('template-parts/loop', 'classroom');
                    }
                    wp_reset_postdata();
                }
            }
            ?>
        </section>
        <!-- 検索結果一覧カードここまで -->
    </div>
</main>

<?php get_footer(); ?>
