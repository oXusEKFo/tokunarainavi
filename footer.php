<footer>

    <!-- フッター -->
    <div class="footer__container">
        <div class="footer__links">
            <ul>
                <li>
                    <a href="<?php echo home_url(); ?>/?s=" class="search__sitemap">条件検索</a>
                </li>
                <li>
                    <a href="<?php echo home_url('/fushion'); ?>">徳島の習いごと事情</a>
                </li>
                <li>
                    <a href="<?php echo home_url('/column'); ?>" class="column__sitemap">コラム</a>
                </li>
                <li>
                    <a href="<?php echo home_url('/infos'); ?>" class="news__sitemap">新着情報</a>
                </li>
                <li>
                    <a href="<?php echo home_url('/favor') ?>" class="favorite__sitemap">お気に入りリスト</a>
                </li>
                <li>
                    <a href="<?php echo home_url('/contact') ?>" class="input__sitemap">お問い合わせ</a>
                </li>
            </ul>
        </div>
        <!-- footer-menu -->
        <div class="footer__info">
            <?php
            $args = [
                'menu' => 'footer_nav', //管理画面で作成したメニューの名前
                'menu_class' => '', //メニューを構成するulタグのクラス名
                'container' => false, //<ul>タグを囲んでいるdivタグを消除
            ];
            wp_nav_menu($args);
            ?>
        </div>
        <div class="footer__illustration">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/birds.png" class="fade__in" alt="Illustration" />
        </div>
    </div>

    <div class="footer__bottom">
        <small>&copy;QLIP とくしま習いごとナビ</small>
    </div>
</footer>
<!-- Topへ戻るボタン -->

<a href="">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/TOPbtn.png" class="back-to-top" alt="Back to top" /></a>
<!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/images/TOPbtn.png" alt="Back to top" /> -->


<?php wp_footer(); ?>
</body>

</html>
