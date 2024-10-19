<?php
// コメントがある場合の処理
if (have_comments()) : ?>
    <div class="wrap__details-review">
        <div class="review__list">
            <div class="review__title">
                <p><?php echo get_comments_number(); ?>件</p>
            </div>
            <?php
            // カスタムコメント表示のコールバック関数
            function custom_comment_list($comment, $args, $depth)
            {
            ?>
                <div class="review__item" style="position: relative;">
                    <p class="review__name"><?php echo get_comment_author(); ?>さん</p>
                    <p class="review__date"><?php echo get_comment_date(); ?>&nbsp;<?php echo get_comment_time(); ?></p>
                    <p class="review__comment"><?php comment_text(); ?></p>
                </div>
            <?php
            }
            ?>

            <?php
            // 通常のコメントリストを表示
            wp_list_comments(array(
                'style'      => 'li',
                'short_ping' => true,
                'avatar_size' => 50,
                'callback'   => 'custom_comment_list',
                'max_depth'   => 1, // 階層は1段階まで許可（返信機能なし）
            ));
            ?>
        </div>
    </div>
<?php endif; ?>

<?php
// コメントフォームのカスタムフィールド
$fields = array(
    'author' => '<p>お名前*（ニックネーム可）</p>' .
        '<input type="text" id="input__name" name="author" value="' . esc_attr($commenter['comment_author']) . '" placeholder="お名前を入力してください" required />',
    'email' => '<p>メールアドレス*（公開されません）</p>' .
        '<input type="email" id="input__email" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="メールアドレスを入力してください" required />',
);

// コメントフォームの引数
$args = array(
    'fields' => $fields, // 上記で定義したカスタムフィールドを使用
    'comment_field' => '<p>クチコミ内容*</p>' .
        '<textarea id="input__comment" name="comment" cols="30" rows="10" placeholder="クチコミを入力してください" required></textarea>',
    'label_submit' => '', // submit_buttonは空にする
    'submit_button' => '', // ここでボタン出力を無効化
);
?>

<div class="wrap__reviewForm">
    <div class="review__Form">
        <form id="commentform" method="post" action="<?php echo esc_url(site_url('/wp-comments-post.php')); ?>">
            <!-- 隠しフィールドでポストIDを指定 -->
            <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" />

            <?php
            // カスタムフィールドを手動で出力
            foreach ($args['fields'] as $field) {
                echo $field;
            }

            // コメントフィールドを出力
            echo $args['comment_field'];
            ?>
            <div class="btn__container">
                <button type="submit" class="reviewSend__btn">クチコミを送信</button>
            </div>
        </form>
    </div>
</div>
