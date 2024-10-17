<!-- 使いません -->

<?php get_header(); ?>
<main>
    <h1>条件検索</h1>
    <form method="GET" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="hidden" name="s" value="">
        <h2>検索</h2>
        <table>
            <th>エリア</th>
            <tr>
                <td>
                    <label><input type="checkbox" name="area[]" value="toku-east">徳島市東部</label>
                </td>
                <td>
                    <label><input type="checkbox" name="area[]" value="toku-west">徳島市西部</label>
                </td>
                <td>
                    <label><input type="checkbox" name="area[]" value="toku-north">徳島市北部</label>
                </td>
                <td>
                    <label><input type="checkbox" name="area[]" value="toku-south">徳島市南部</label>
                </td>
            </tr>
        </table>
        <input type="submit" value="この条件で探す">
    </form>
</main>
<?php get_footer(); ?>
