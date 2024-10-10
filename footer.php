<footer>
    <!-- Topへ戻るボタン -->
    <div class="back-to-top">
        <a href="#">
            <span>BACK<br />to<br />TOP</span>
        </a>
    </div>
    <!-- フッター -->
    <div class="inner__footer">
        <div class="container__sitemap">
            <ul class="wrap__items">
                <li>
                    <a href="<?php echo home_url(); ?>/?s=" class="search__sitemap">
                        条件検索
                    </a>
                </li>
                <li>
                    <a href="<?php echo home_url('/fushion'); ?>">
                        徳島の習いごと調査
                    </a>
                </li>
                <li>
                    <a href="<?php echo home_url('/column'); ?>" class="column__sitemap">
                        コラム
                    </a>
                </li>
                <li>
                    <a href="<?php echo home_url('/category/news'); ?>" class="news__sitemap">
                        新着情報
                    </a>
                </li>
                <li>
                    <a href="<?php echo home_url('/favor') ?>" class="favorite__sitemap">お気に入りリスト
                    </a>
                </li>
                <li>
                    <a href="<?php echo home_url('/contact') ?>" class="input__sitemap">
                        お問い合わせ
                    </a>
                </li>
            </ul>
            <!-- footer-menu -->
            <?php
            $args = [
                'menu' => 'footer_nav', //管理画面で作成したメニューの名前
                'menu_class' => 'wrap__rules', //メニューを構成するulタグのクラス名
                'container' => false, //<ul>タグを囲んでいるdivタグを消除
            ];
            wp_nav_menu($args);
            ?>
        </div>
        <div class="copy-rights">
            <p>&copy;2024&nbsp;QLIP&nbsp;とくしま習いごとナビ&#44;&nbsp;All&nbsp;rights&nbsp;reserved</p>
        </div>
    </div>
    <?php wp_footer(); ?>
</footer>

</body>

</html>
