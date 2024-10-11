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
$args = array(
    'post_type' => 'classroom', // カスタム投稿タイプ
    'posts_per_page' => 3,  // 表示する教室の数
    'post__not_in' => array(get_the_ID()), // 現在の教室を除外
    'orderby' => 'rand' // ランダム表示
);

$recommended_classes = new WP_Query($args);



// 現在の投稿に関連付けられたタクソノミー 'classtype' を取得
$terms = wp_get_post_terms(get_the_ID(), 'classtype');
// 親タクソノミーと子タクソノミーのスラッグを格納する変数
$parent_slug = '';
$child_slug = '';

if (!empty($terms)) {
    foreach ($terms as $term) {
        // 親か子かを確認
        if ($term->parent == 0) {
            $parent_slug = $term->slug; // 親のスラッグを取得
        } else {
            $child_slug = $term->slug; //取得
            $child_taxonomy = $term;
        }
    }
}



$image1 = get_field('pic1');
$image2 = get_field('pic2');
$image3 = get_field('pic3');
$image4 = get_field('pic4');
$cost = get_field('fee');
$age = get_field('age');
$weekday_time = get_field('dayhours');
$tel = get_field('tel');
$memo = get_field('memo');
$genre = get_field('genre');
$address = get_field('address');
$sub_pic = get_field('sub_pic');



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
    <div class="inner_main">
        <div class="container_bread-crumb">
            <div class="breadCrumb">
                <p>TOP&nbsp;&gt;&nbsp;検索結果&nbsp;&gt;<span class="under-Line">
                        <?php the_title(); ?></span>
                </p>
            </div>
        </div>

        <!-- 施設写真スライド -->
        <section class="outline_results">
            <div class="details_slide">
                <div class="container_slide">
                    <div class="slider_area">
                        <div class="slider">
                            <div class="wrap_mainImg">
                                <img src="<?php echo esc_url($image1['url']); ?>" alt="施設写真1">
                            </div>
                            <div class="wrap_mainImg">
                                <img src="<?php echo esc_url($image2['url']); ?>" alt="施設写真2">
                            </div>
                        </div>
                        <a href="" class="tag_favorite">
                            <?php the_favorites_button(get_the_ID()); ?>
                        </a>
                    </div>
                    <div class="thumbnail">
                        <div class="wrap_thumbnailImg">
                            <img src="<?php echo esc_url($image3['url']); ?>" alt="サムネイル1" />
                        </div>
                        <div class="wrap_thumbnail">
                            <img src="<?php echo esc_url($image4['url']); ?>" alt="サムネイル2" />
                        </div>
                    </div>
                </div>
                <!-- <div class="ball">
                    あとでボールのイラスト追加します
                </div> -->
            </div>

            <div class="details_info">
                <div class="inner_details-info">
                    <div class="wrap_details-outline">
                        <div class="details_title">
                            <h2><?php the_title(); ?></h2>
                        </div>
                        <div class="details_address">
                            <div class="details_address">
                                <p><?php echo esc_html($address); ?></p>
                            </div>
                        </div>
                        <ul class="container_keywords">
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
                        <div class="details_description">
                            <p><?php echo  the_content(); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="details_container">
            <div class="details_containerL">
                <div class="details_genre">
                    <h4>ジャンル</h4>
                    <p><?php echo esc_html($child_taxonomy->name); ?></p>
                </div>
                <div class="details_genre">
                    <h4>対象年齢</h4>
                    <p><?php echo esc_html($age); ?></p>
                </div>
                <div class="details_genre">
                    <h4>料金について</h4>
                    <p><?php echo esc_html($cost); ?></p>
                </div>
                <div class="details_genre">
                    <h4>おすすめのコース</h4>
                    <?php
                    for ($i = 0; $i < count($course); $i++) {
                        if (!empty($course[$i])) { ?>
                            <p><?php echo esc_html($course[$i]); ?></p>
                    <?php }
                    } ?>
                </div>

            </div>
            <div class="details_containerR">
                <div class="details_genre">
                    <h4>曜日・時間</h4>
                    <p><?php echo $weekday_time ?></p>
                </div>
                <div class="details_genre">
                    <h4>備考</h4>
                    <p><?php echo $memo ?></p>
                </div>
                <div class="details_genre">
                    <h4>電話番号</h4>
                    <a href="tel:<?php echo $phone_number; ?>"><?php echo $tel ?></a>
                </div>
                <div class="details_genre">
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
    </div>
    </section>

    <section class="details_review">
        <div class="wrap_accordion">
            <div class="accordion-header">
                <div class="details_map">
                    <img src="../../assets/images/map.png" alt="Mapマーク">
                    <p>地図を開く</p>
                </div>
            </div>
            <div class="accordion-content">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d826.2106883809922!2d134.5518020695891!3d34.07354500918475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x35536d61a9b3083f%3A0x55449d0bb908b4b2!2z44Kv44Oq44OD44OX77yI77yx77ys77yp77yw77yJ44OX44Ot44Kw44Op44Of44Oz44Kw44K544Kv44O844Or!5e0!3m2!1sja!2sjp!4v1727533581130!5m2!1sja!2sjp" width="100%" height="300px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>




        <div class="wrap_details-review">
            <div class="review_list">
                <div class="review_title">
                    <h3>|&nbsp;レビュー&nbsp;一覧&lpar;1件&rpar;
                    </h3>
                </div>
                <div class="review_item">
                    <p class="review_name">●●さん</p>
                    <p class="review_date">●年●月●日&nbsp;00:00</p>
                    <p class="review_comment">とても丁寧に教えていただきました！</p>
                </div>
            </div>
            <button class="reply_btn">
                返信
            </button>
        </div>
        <div class="wrap_reviewForm">
            <div class="reviewForm">
                <h5>お名前*</h5>
                <input type="text" name="name" id="input_name" />
                <h5>メールアドレス*</h5>
                <input type="email" name="email" id="input_email" />
                <h5>レビュー内容*</h5>
                <textarea name="review" id="input_comment" cols="30" rows="10"></textarea>
                <div class="btn_container">
                    <button class="reviewSend_btn">
                        レビューを送信
                    </button>
                </div>
            </div>
    </section>


    <div class="relatedReview_title">
        <p>おすすめの習い事</p>
        <img src="../../assets/images/checkmark.png">
    </div>
    <section class="results_card">
        <!-- 検索結果一覧カード -->
        <div class="wrap_card">
            <?php if ($recommended_classes->have_posts()) : ?>
                <?php while ($recommended_classes->have_posts()) : $recommended_classes->the_post(); ?>
                    <div class="inner_card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="container_cardimg">
                                <span class="card_img"><?php the_post_thumbnail('medium'); ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="container_cardinfo">
                            <div class="card_title">
                                <h2><?php the_title(); ?></h2>
                            </div>
                            <div class="card_details">
                                <div class="card_detail">
                                    <span class="detail_label">住所</span>
                                    <span class="detail_value"><?php echo get_post_meta(get_the_ID(), 'address', true); ?></span>
                                </div>
                                <div class="card_detail">
                                    <span class="detail_label">ジャンル</span>
                                    <span class="detail_value"><?php echo esc_html($child_taxonomy->name); ?></span>
                                </div>
                                <div class="card_detail">
                                    <span class="detail_label">対象年齢</span>
                                    <span class="detail_value"><?php echo get_post_meta(get_the_ID(), 'age', true); ?></span>
                                </div>
                            </div>
                            <img class="icon_category" src="<?php echo get_template_directory_uri() ?>/assets/icon/icon_<?php echo $child_slug ?>.png" alt="カテゴリーアイコン" />
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <?php wp_reset_postdata(); ?>
        <script>
            // 結果一覧カード 繰り返し表示
            // for (let i = 0; i < 2; i++) {
            //     const card = document.querySelector('.wrap_card');
            //     const clone = card.cloneNode(true);
            //     document.querySelector('.results_card').appendChild(clone);
            // }
        </script>

    </section>
    <!-- 検索結果一覧カードここまで -->
    </div>
</main>

<?php get_footer(); ?>
