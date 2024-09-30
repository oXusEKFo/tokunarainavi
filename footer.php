<footer class="footer">



    <!-- footer-menu -->
    <?php
    $args = [
        'menu' => 'footer_sns', //管理画面で作成したメニューの名前
        'menu_class' => '', //メニューを構成するulタグのクラス名
        'container' => false, //<ul>タグを囲んでいるdivタグを消除
    ];
    wp_nav_menu($args);
    ?>


</footer>

<div class="pageTop js-toTop">
    <a href="#"><i class="fas fa-arrow-up"></i><span>TOP PAGE</span></a>
</div>

<?php wp_footer(); ?> <!-- wordpress 管理bar表示するのため。必ず書いてください -->

</body>

</html>
