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
?>

<!-- 投稿のランキング用 -->
<?php
$cookie_name = 'post_views_' . $post->ID;

if (!isset($_COOKIE[$cookie_name])) {
    global $post;

    $current_views = get_post_meta($post->ID, 'post_views', true);
    if ($current_views === '') {
        $current_views = 0;
    }
    $current_views = intval($current_views);

    $new_views = $current_views + 1;
    update_post_meta($post->ID, 'post_views', $new_views);
    setcookie($cookie_name, '1', time() + 3600, COOKIEPATH, COOKIE_DOMAIN);
}
?>

<?php
$post_id = get_the_ID();
$taxonomies = array('classtype', 'area', 'date_type', 'access_type', 'age_type', 'skill_type', 'personality_type', 'cost_type', 'week', 'column_type');

// おすすめ教室を取得するクエリ
// $args = array(
//     'post_type' => 'classroom', // カスタム投稿タイプ
//     'posts_per_page' => 3,  // 表示する教室の数
//     'post__not_in' => array(get_the_ID()), // 現在の教室を除外
//     'orderby' => 'rand' // ランダム表示
// );

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

if ($parent_taxonomy && !is_wp_error($parent_taxonomy)) {
    // 親タクソノミーに属する教室を取得するためのterm_idリスト
    $term_ids = wp_list_pluck($terms, 'term_id');

    // おすすめ教室を取得するクエリ
    $args = array(
        'post_type' => 'classroom', // カスタム投稿タイプ
        'posts_per_page' => 3,  // 表示する教室の数
        'post__not_in' => array(get_the_ID()), // 現在の教室を除外
        'orderby' => 'rand', // ランダム表示
        'tax_query' => array(
            'relation' => 'AND', // 親と子の両方で絞り込み
            array(
                'taxonomy' => 'classtype', // 教室のジャンル
                'field' => 'term_id',
                'terms' => $parent_taxonomy->term_id, // 親タクソノミーに属する教室を取得
                'include_children' => false, // 子タクソノミーは別途扱う
            ),
            array(
                'taxonomy' => 'classtype', // 子タクソノミー (ジャンル)
                'field' => 'term_id',
                'terms' => $child_taxonomy ? $child_taxonomy->term_id : $term_ids, // 子が存在すればその子を使用
            ),
        ),
    );

    // WP_Query を使用して投稿を取得
    $recommended_classes = new WP_Query($args);
}







$main_image1 = get_field('pic1');
$main_image2 = get_field('pic2');
$thumbnail1 = get_field('pic3');
$thumbnail2 = get_field('pic4');
$cost = get_field('fee');
$age = get_field('age');
$weekday_time = get_field('dayhours');
$tel = get_field('tel');
$memo = get_field('memo');
$genre = get_field('genre');
$address = get_field('address');
$sub_pic = get_field('sub_pic');
$map = get_field('iframe');



for ($i = 1; $i <= 5; $i++) {
    // カスタムフィールドの値を取得
    $course[] = get_post_meta(get_the_ID(), 'course' . $i, true);
}
?>

<?php get_header(); ?>
<?php
if (have_posts()):
    while (have_posts()): the_post();
?>
        <h1><?php echo the_title(); ?></h1>
<?php
    endwhile;
    wp_reset_postdata();
endif;
?>
<p><?php echo esc_html($genre); ?></p>
<main>
    <!--  -->
    <div class="inner__main">
        <div class="container__bread-crumb">
            <div class="breadCrumb">
                <p>TOP&nbsp;&gt;&nbsp;検索結果&nbsp;&gt;<span class="under-Line">
                        <?php the_title(); ?></span>
                </p>
            </div>
        </div>

        <!-- 施設写真スライド -->
        <section class="outline__results">
            <div class="details__slide">
                <div class="container__slide">
                    <div class="slider__area">
                        <div class="slider">
                            <div class="wrap__mainImg">
                                <?php if ($main_image1): ?>
                                    <img src="<?php echo esc_url($main_image1['url']); ?>" alt="<?php echo esc_attr($main_image1['alt']); ?>" />
                                <?php endif; ?>

                            </div>
                            <?php if ($main_image2): ?>
                                <div class="wrap__mainImg">
                                    <img src="<?php echo esc_url($main_image2['url']); ?>" alt="<?php echo esc_attr($main_image2['alt']); ?>" />
                                </div>
                            <?php endif; ?>
                        </div>
                        <a href="" class="tag__favorite1">
                            <?php if (function_exists('the_favorites_button')) {
                                the_favorites_button($post->ID);
                            } ?>
                        </a>
                    </div>
                    <div class="thumbnail">
                        <?php // サムネイルがある場合のみ表示
                        if ($thumbnail1): ?>
                            <div class="wrap__thumbnailImg">
                                <img src="<?php echo esc_url($thumbnail1['url']); ?>" alt="<?php echo esc_attr($thumbnail1['alt']); ?>" />
                            </div>
                        <?php endif; ?>

                        <?php if ($thumbnail2): ?>
                            <div class="wrap__thumbnailImg">
                                <img src="<?php echo esc_url($thumbnail2['url']); ?>" alt="<?php echo esc_attr($thumbnail2['alt']); ?>" />
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- <div class="ball">
                    あとでボールのイラスト追加します
                </div> -->
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
                    <p><a href="#">この教室についての<br>コラムはこちら→</a></p>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/matcha.png" alt="緑丸" class="circle__matcha">
                </div>
                <div class="details__genre">

                    <h4>ジャンル</h4>
                    <?php
                    // $child_taxonomy が null でないかをチェック
                    if ($child_taxonomy) {
                        echo '<p>' . esc_html($child_taxonomy->name) . '</p>';
                    } else {
                        echo '<p>子タクソノミーは存在しません。</p>';
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
                    <h4>曜日・時間</h4>
                    <p><?php echo $weekday_time ?></p>
                </div>
                <div class="details__genre">
                    <h4>備考</h4>
                    <p><?php echo $memo ?></p>
                </div>
                <div class="details__genre">
                    <h4>電話番号</h4>
                    <a href="tel:<?php echo $phone_number; ?>"><?php echo $tel ?></a>
                </div>
                <div class="details__genre">
                    <h4>公式サイト・SNSはこちら</h4>
                    <a href="#">
                        <img class="" src="<?php echo get_template_directory_uri(); ?>/assets/icon/site_icon.png" alt="公式サイトURL" />
                    </a>
                    <a href="#">
                        <img class="" src="<?php echo get_template_directory_uri(); ?>/assets/icon/Instagram_icon.png" alt="インスタグラムURL" />
                    </a>
                    <a href="#">
                        <img class="" src="<?php echo get_template_directory_uri(); ?>/assets/icon/fb_icon.png" alt="フェイスブックURL" />
                    </a>
                </div>
            </div>
        </section>


        <div class="details__review">
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
            <?php comments_template() ?>
        </div>

        <section class="relatedReview__title">
            <p>おすすめの習い事</p>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/60.png">
        </section>
        <section class="results__card">
            <!-- 検索結果一覧カード -->
            <?php if ($recommended_classes->have_posts()) : ?>
                <?php while ($recommended_classes->have_posts()) : $recommended_classes->the_post();
                    get_template_part('template-parts/loop', 'classroom') ?>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </section>
        <!-- 検索結果一覧カードここまで -->
    </div>
</main>

<?php get_footer(); ?>
