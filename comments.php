<?php
// コメントがある場合の処理
if (have_comments()) : ?>
    <div class="wrap__details-review">
        <div class="review__list">
            <div class="review__title">
                <h3>|&nbsp;クチコミ&nbsp;一覧&nbsp;(<?php echo get_comments_number(); ?>件)</h3>
            </div>
            <?php
            // カスタムコメント表示のコールバック関数

            function custom_comment_list($comment, $args, $depth)
            {
                global $reply_to_comment_id;

                // 返信モードかどうかを確認
                $is_reply_mode = !is_null($reply_to_comment_id);
                // 返信対象のコメントのみ表示する
                if ($is_reply_mode && $comment->comment_ID != $reply_to_comment_id) {
                    // 返信対象ではないコメントを非表示にする
                    return;
                }
            ?>

                <div class="review__item" style="position: relative;">
                    <p class="review__name"><?php echo get_comment_author(); ?>さん</p>
                    <p class="review__date"><?php echo get_comment_date(); ?>&nbsp;<?php echo get_comment_time(); ?></p>
                    <p class="review__comment"><?php comment_text(); ?></p>
                    <?php
                    // URLにreplytocomがある場合は返信ボタンを表示しない
                    if (!isset($_GET['replytocom'])) {
                        comment_reply_link(array_merge($args, array(
                            'reply_text' => '返信',
                            'depth' => $depth,
                            'max_depth' => $args['max_depth'],
                            'add_below' => 'comment',
                            'before' =>
                            '<button class="reply__btn" style="position: absolute; right: 0; bottom: 0;">',
                            'after' => '</button>',
                        )));
                    }

                    ?>
                </div>
            <?php
            }
            ?>
            <?php
            $reply_to_comment_id = isset($_GET['replytocom']) ? intval($_GET['replytocom']) : null;

            // コメントリストの出力
            if ($reply_to_comment_id) {
                // 返信対象のコメントだけを表示
                $specific_comment = get_comment($reply_to_comment_id);
                if ($specific_comment) {
                    wp_list_comments(array(
                        'style'      => 'div',
                        'short_ping' => true,
                        'avatar_size' => 50,
                        'callback'   => 'custom_comment_list',
                        'per_page'   => 1, // 1つのコメントだけを表示
                        'reverse_top_level' => false,
                        'type'       => 'comment',
                    ), array($specific_comment)); // 特定のコメントをリストに渡す
                } else {
                    echo '<p>指定されたコメントは存在しません。</p>';
                }
            } else {
                // 通常のコメントリストを表示
                wp_list_comments(array(
                    'style'      => 'li',
                    'short_ping' => true,
                    'avatar_size' => 50,
                    'callback'   => 'custom_comment_list',
                    'max_depth'   => 2, // コメントの階層を最大3段階まで許可
                ));
            }
            ?>
        </div>

    </div>
<?php endif; ?>


<?php
// 返信フォームのボタンラベルを動的に変更する
$is_reply = isset($_GET['replytocom']) && !empty($_GET['replytocom']);
$reply_comment_author = ''; // 返信するコメントの名前を格納する変数

if ($is_reply) {
    // 返信対象のコメントIDを取得
    $comment_id = intval($_GET['replytocom']);
    // コメントの詳細情報を取得
    $comment = get_comment($comment_id);
    if ($comment) {
        // 返信対象のコメント投稿者の名前を取得
        $reply_comment_author = $comment->comment_author;
    }
}

// ボタンのラベルを設定
if ($is_reply && !empty($reply_comment_author)) {
    // 返信時は「（名前）に返信」というラベルを表示
    $button_label = esc_html($reply_comment_author) . 'さんへ返信';
} else {
    // 通常の送信フォームのラベル
    $button_label = 'クチコミを送信';
}

// コメントフォームのカスタムフィールド
$fields = array(
    'author' => '<p>お名前*</p>' .
        '<input type="text" id="input__name" name="author" value="' . esc_attr($commenter['comment_author']) . '" placeholder="お名前を入力してください" required />',
    'email' => '<p>メールアドレス*</p>' .
        '<input type="email" id="input__email" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="メールアドレスを入力してください" required />',
);


?>

<?php
// コメントフォームの引数
$args = array(
    'fields' => $fields, // 上記で定義したカスタムフィールドを使用
    'comment_field' => '<p>クチコミ内容*</p>' .
        '<textarea id="input__comment" name="comment" cols="30" rows="10" placeholder="レビューを入力してください" required></textarea>',
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
                <?php cancel_comment_reply_link('<button type="button" class="cancel-reply-btn">返信をキャンセル</button>'); ?>
                <button type="submit" class="reviewSend__btn"><?php echo esc_html($button_label); ?></button>
            </div>
        </form>
    </div>
</div>
