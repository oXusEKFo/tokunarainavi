<!-- Topへ戻るボタン -->
<div class="back-to-top">
    <a href="#">
        <span>BACK<br />to<br />TOP</span>
    </a>
</div>

<footer class="footer">
    <div class="inner__footer">
        <div class="container__sitemap">
            <!-- gnav -->
            <?php
            $args = [
                'menu' => 'Gnav', //管理画面で作成したメニューの名前
                'menu_class' => 'wrap__pages', //メニューを構成するulタグのクラス名
                'container' => false, //<ul>タグを囲んでいるdivタグを消除
            ];
            wp_nav_menu($args);
            ?>
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
    </div>
</footer>

<?php wp_footer(); ?> <!-- wordpress 管理bar表示するのため。必ず書いてください -->

</body>

</html>
