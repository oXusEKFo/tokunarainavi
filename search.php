<?php get_header(); ?>
<?php
//各タクソノミーのデータを取得
$data = [
    $area_terms = get_terms(['taxonomy' => 'area', 'orderby' => 'slug', 'hide_empty' => false]), //hide_empty 0件の項目を表示する場合は必要
    $age_type_terms = get_terms(['taxonomy' => 'age_type', 'orderby' => 'slug']),
    $classtype_terms = get_terms(['taxonomy' => 'classtype', 'orderby' => 'slug', 'hide_empty' => false]),
    $weektimes_terms = get_terms(['taxonomy' => 'weektimes', 'orderby' => 'slug']),
    $cost_type_terms = get_terms(['taxonomy' => 'cost_type', 'orderby' => 'slug']),
    $personality_type_terms = get_terms(['taxonomy' => 'personality_type'], ['orderby' => 'slug']),
    $skill_type_terms = get_terms(['taxonomy' => 'skill_type'], ['orderby' => 'slug']),
];

// echo '<pre>';
// print_r($area_terms);
// echo '</pre>';


foreach ($data as $value) {
    $taxonomy_name[] = $value[0]->taxonomy;
}
$count = 0; //タクソノミー名取得用
$count2 = 0;
?>


<main>
    <h1>フリーワード検索</h1>
    <form action="<?php echo home_url('/'); ?>" method="get">
        <input type="text" name="s" value="<?php the_search_query(); ?>" placeholder="キーワードを入力してください">
        <button type="submit">🔍</button>
    </form>
    </div>


    <!--パンくずリスト-->

    <div class="results">
        <div class="inner_main">
            <div class="container_breadcrumb">
                <div class="breadcrumb">
                    <?php get_template_part('template-parts/breadcrumb'); ?>
                </div>
            </div>
            <section class="search_results">
                <!--検索フォーム-->
                <div>
                    <h1>条件検索</h1>

                    <?php
                    // echo '<pre>';
                    // print_r($_GET);
                    // echo '</pre>';
                    ?>

                    <?php foreach ($data as $value) {
                        // チェックしたものを検索した後も保持するための記述
                        // 「エリア」のチェックを保持
                        $select = filter_input(INPUT_GET, "$taxonomy_name[$count]", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?: [];
                        // echo 'select<pre>';
                        // print_r($select);
                        // echo '</pre>';
                        foreach ($value as $value2) {
                            $checked[$value2->taxonomy][$value2->slug] = "";
                        }
                        foreach ($select as $val) {
                            $checked[$taxonomy_name[$count]][$val] = " checked";
                        }
                        $count++;

                        //選択項目の名前の取得
                        foreach ($value as $value2) {
                            foreach ($select as $val) {
                                if ($val === $value2->slug) {
                                    $aaa[] = $value2->name;
                                }
                            }
                        }
                        // print_r($aaa);
                    }
                    $name_imp = "エリアを選択";
                    if (!empty($aaa)) {
                        $name_imp = implode(",", $aaa);
                    }

                    ?>

                    <div class="search_filters">
                        <div class="filter_row">
                            <span class="filter_label">エリア</span>
                            <span class="filter_value"><?= $name_imp ?></span>
                            <button class="change_btn" onclick="togglePopup('popup_area')">変更</button>
                        </div>
                        <div class="search_container" id="popup_area" style="display: none;">
                            <form method="GET" action="<?php echo esc_url(home_url('/')); ?>">
                                <input type="hidden" name="s" value="">
                                <div class="close_button" onclick="">×</div>
                                <div class="search_header">
                                    <h1>エリアを選ぶ</h1>
                                </div>
                                <div class="search_options">
                                    <div class="single_column">
                                        <?php foreach ($area_terms as $value): ?>
                                            <label class="accordion_item <?= $checked["area"]["$value->slug"] ?>"><input type="checkbox" name="area[]" value="<?php echo $value->slug ?>" <?= $checked["area"]["$value->slug"] ?> onclick="selectItem(this)"><?php echo $value->name ?></label>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="search_actions">
                                        <input class="search_button" type="submit" value="この条件で探す">
                                        <div class="additional-buttons">
                                            <button>年齢も選ぶ</button>
                                            <button>ジャンルも選ぶ</button>
                                        </div>
                                        <!-- <input type="reset" value="すべてクリア"> -->
                                        <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- <h1>フリーワード検索</h1>
                    <form action="<?php echo home_url('/'); ?>" method="get">
                        <input type="text" name="s" value="<?php the_search_query(); ?>" placeholder="キーワードを入力してください">
                        <button type="submit">🔍</button>
                    </form> -->
                </div>

                <div class="search_filters">
                    <div class="filter_row">
                        <span class="filter_label">エリア</span>
                        <span class="filter_value">徳島市中心部</span>
                        <button class="change_btn" onclick="togglePopup('popup_area')">変更</button>
                    </div>
                    <div class="overlay" style="display: none;"></div>
                    <!-- <div class="search_container" id="popup_area" style="display: none;">
                        <div class="close_button">×</div>
                        <div class="search_header">
                            <h1>エリアを選ぶ</h1>
                        </div>
                        <div class="search_options">
                            <button class="accordion_item full_width" onclick="selectAll('tokushima', this);">徳島市全域</button>
                            <div id="tokushima" class="single_column">
                                <button class="accordion_item" onclick="selectItem(this)">徳島市中心部(徳島駅前周辺)</button>
                                <button class="accordion_item" onclick="selectItem(this)">徳島市北部(応神〜川内周辺)</button>
                                <button class="accordion_item" onclick="selectItem(this)">徳島市南部(昭和〜新浜周辺)</button>
                                <button class="accordion_item" onclick="selectItem(this)">徳島市東部(住吉〜沖洲周辺)</button>
                                <button class="accordion_item" onclick="selectItem(this)">徳島市西部(田宮〜国府周辺)</button>
                            </div>
                            <button class="accordion_item full_width" onclick="selectAll('itano',this);">板野郡全域</button>
                            <div id="itano" class="double_column">
                                <button class="accordion_item" onclick="selectItem(this)">板野郡藍住町</button>
                                <button class="accordion_item" onclick="selectItem(this)">板野郡北島町</button>
                                <button class="accordion_item" onclick="selectItem(this)">板野郡松茂町</button>
                                <button class="accordion_item" onclick="selectItem(this)">板野郡板野町</button>
                                <button class="accordion_item" onclick="selectItem(this)">板野郡上板町</button>
                            </div>
                            <div class="double_column">
                                <button class="accordion_item" onclick="selectItem(this)">阿南市</button>
                                <button class="accordion_item" onclick="selectItem(this)">鳴門市</button>
                                <button class="accordion_item" onclick="selectItem(this)">吉野川市</button>
                                <button class="accordion_item" onclick="selectItem(this)">小松島市</button>
                                <button class="accordion_item" onclick="selectItem(this)">阿波市</button>
                                <button class="accordion_item" onclick="selectItem(this)">名西郡</button>
                                <button class="accordion_item" onclick="selectItem(this)">美馬市</button>
                                <button class="accordion_item" onclick="selectItem(this)">三好市</button>
                                <button class="accordion_item" onclick="selectItem(this)">海部郡</button>
                                <button class="accordion_item" onclick="selectItem(this)">美馬郡</button>
                                <button class="accordion_item" onclick="selectItem(this)">那賀郡</button>
                                <button class="accordion_item" onclick="selectItem(this)">三好郡</button>
                                <button class="accordion_item" onclick="selectItem(this)">勝浦郡</button>
                                <button class="accordion_item" onclick="selectItem(this)">名東郡</button>
                            </div>
                            <div class="search_actions">
                                <button class="search_button">この条件で検索する</button>
                                <div class="additional-buttons">
                                    <button>年齢も選ぶ</button>
                                    <button>ジャンルも選ぶ</button>
                                </div>
                                <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                            </div>
                        </div>
                    </div> -->
                    <div class="filter_row">
                        <span class="filter_label">年齢</span>
                        <span class="filter_value">小学生（8-9歳）</span>
                        <button class="change_btn" onclick="togglePopup('popup_age')">変更</button>
                    </div>
                    <div class="overlay"></div>
                    <div class="search_container" id="popup_age" style="display: none;">
                        <div class="close_button">×</div>
                        <div class="search_header">
                            <h1>年齢を選ぶ</h1>
                        </div>
                        <div class="search_options">
                            <div class="double_column">
                                <button class="accordion_item" onclick="selectItem(this)">ベビー(0-2歳)</button>
                                <button class="accordion_item" onclick="selectItem(this)">年少(3-4歳)</button>
                                <button class="accordion_item" onclick="selectItem(this)">年中(4-5歳)</button>
                                <button class="accordion_item" onclick="selectItem(this)">年長(5-6歳)</button>
                                <button class="accordion_item" onclick="selectItem(this)">小1(6-7歳)</button>
                                <button class="accordion_item" onclick="selectItem(this)">小2(7-8歳)</button>
                                <button class="accordion_item" onclick="selectItem(this)">小3(8-9歳)</button>
                                <button class="accordion_item" onclick="selectItem(this)">小4(9-10歳)</button>
                                <button class="accordion_item" onclick="selectItem(this)">小5(10-11歳)</button>
                                <button class="accordion_item" onclick="selectItem(this)">小6(11-12歳)</button>
                                <button class="accordion_item" onclick="selectItem(this)">中学生</button>
                                <button class="accordion_item" onclick="selectItem(this)">高校生</button>
                            </div>
                        </div>
                        <div class="search_actions">
                            <button class="search_button">この条件で検索する</button>
                            <div class="additional-buttons">
                                <button>エリアも選ぶ</button>
                                <button>ジャンルも選ぶ</button>
                            </div>
                            <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                        </div>
                    </div>
                    <div class="filter_row">
                        <span class="filter_label">ジャンル</span>
                        <span class="filter_value">プログラミング</span>
                        <button class="change_btn" onclick="togglePopup('popup_genre')">変更</button>
                    </div>
                    <div class="overlay"></div>
                    <div class="search_container" id="popup_genre" style="display: none;">
                        <div class="close_button">×</div>
                        <div class="search_header">
                            <h1>ジャンルを選ぶ</h1>
                        </div>
                        <div class="search_options">
                            <button class="search_option_suboption" onclick="toggleAccordion('sports')">スポーツ <span class="plus">+</span></button>
                            <div id="sports" class="accordion_content">
                                <button class="accordion_item full_width" onclick="selectAll('sports', this);">スポーツをすべて選択</button>
                                <div id="sports_list" class="double_column">
                                    <button class="accordion_item" onclick="selectItem(this)">テニス</button>
                                    <button class="accordion_item" onclick="selectItem(this)">サッカー</button>
                                    <button class="accordion_item" onclick="selectItem(this)">バスケットボール</button>
                                    <button class="accordion_item" onclick="selectItem(this)">バドミントン</button>
                                    <button class="accordion_item" onclick="selectItem(this)">バレーボール</button>
                                    <button class="accordion_item" onclick="selectItem(this)">ゴルフ</button>
                                    <button class="accordion_item" onclick="selectItem(this)">ボクシング</button>
                                    <button class="accordion_item" onclick="selectItem(this)">水泳</button>
                                    <button class="accordion_item" onclick="selectItem(this)">体操</button>
                                    <button class="accordion_item" onclick="selectItem(this)">ヨガ</button>
                                    <button class="accordion_item" onclick="selectItem(this)">空手</button>
                                    <button class="accordion_item" onclick="selectItem(this)">剣道</button>
                                    <button class="accordion_item" onclick="selectItem(this)">柔道</button>
                                    <button class="accordion_item" onclick="selectItem(this)">少林寺拳法</button>
                                    <button class="accordion_item" onclick="selectItem(this)">合気道</button>
                                </div>
                            </div>
                            <button class="search_option_suboption" onclick="toggleAccordion('dance')">ダンス <span class="plus">+</span></button>
                            <div id="dance" class="accordion_content">
                                <button class="accordion_item full_width" onclick="selectAll('dance', this);">ダンスをすべて選択</button>
                                <div id="dance_list" class="double_column">
                                    <button class="accordion_item" onclick="selectItem(this)">HIPHOP</button>
                                    <button class="accordion_item" onclick="selectItem(this)">ジャズダンス</button>
                                    <button class="accordion_item" onclick="selectItem(this)">フラダンス</button>
                                    <button class="accordion_item" onclick="selectItem(this)">阿波踊り</button>
                                    <button class="accordion_item" onclick="selectItem(this)">バレエ</button>
                                </div>
                            </div>
                            <button class="search_option_suboption" onclick="toggleAccordion('music')">音楽 <span class="plus">+</span></button>
                            <div id="music" class="accordion_content">
                                <button class="accordion_item full_width" onclick="selectAll('music', this);">音楽をすべて選択</button>
                                <div id="music_list" class="double_column">
                                    <button class="accordion_item" onclick="selectItem(this)">ピアノ</button>
                                    <button class="accordion_item" onclick="selectItem(this)">ギター</button>
                                    <button class="accordion_item" onclick="selectItem(this)">バイオリン</button>
                                    <button class="accordion_item" onclick="selectItem(this)">ボイストレーニング</button>
                                    <button class="accordion_item" onclick="selectItem(this)">ドラム</button>
                                    <button class="accordion_item" onclick="selectItem(this)">管楽器</button>
                                    <button class="accordion_item" onclick="selectItem(this)">リトミック</button>
                                </div>
                            </div>
                            <button class="search_option_suboption" onclick="toggleAccordion('art')">アート <span class="plus">+</span></button>
                            <div id="art" class="accordion_content">
                                <button class="accordion_item full_width" onclick="selectAll('art', this);">アートをすべて選択</button>
                                <div id="art_list" class="double_column">
                                    <button class="accordion_item" onclick="selectItem(this)">絵画・造形</button>
                                    <button class="accordion_item" onclick="selectItem(this)">書道・硬筆</button>
                                    <button class="accordion_item" onclick="selectItem(this)">手芸</button>
                                    <button class="accordion_item" onclick="selectItem(this)">生け花</button>
                                </div>
                            </div>
                            <button class="search_option_suboption" onclick="toggleAccordion('cooking')">料理 <span class="plus">+</span></button>
                            <div id="cooking" class="accordion_content">
                                <button class="accordion_item full_width" onclick="selectAll('cooking', this);">料理をすべて選択</button>
                                <div id="cooking_list" class="double_column">
                                    <button class="accordion_item" onclick="selectItem(this)">料理</button>
                                    <button class="accordion_item" onclick="selectItem(this)">お菓子作り</button>
                                    <button class="accordion_item" onclick="selectItem(this)">パン作り</button>
                                </div>
                            </div>
                            <button class="search_option_suboption" onclick="toggleAccordion('crafts')">伝統工芸 <span class="plus">+</span></button>
                            <div id="crafts" class="accordion_content">
                                <button class="accordion_item full_width" onclick="selectAll('crafts', this);">伝統工芸をすべて選択</button>
                                <div id="crafts_list" class="double_column">
                                    <button class="accordion_item" onclick="selectItem(this)">藍染</button>
                                    <button class="accordion_item" onclick="selectItem(this)">大谷焼・陶芸</button>
                                    <button class="accordion_item" onclick="selectItem(this)">木工・絵付け(遊山箱)</button>
                                    <button class="accordion_item" onclick="selectItem(this)">和紙作り(阿波和紙)</button>
                                    <button class="accordion_item" onclick="selectItem(this)">和傘作り</button>
                                </div>
                            </div>
                            <button class="search_option_suboption" onclick="toggleAccordion('academics')">学習 <span class="plus">+</span></button>
                            <div id="academics" class="accordion_content">
                                <button class="accordion_item full_width" onclick="selectAll('academics', this);">学習をすべて選択</button>
                                <div id="academics_list" class="double_column">
                                    <button class="accordion_item" onclick="selectItem(this)">英会話</button>
                                    <button class="accordion_item" onclick="selectItem(this)">そろばん</button>
                                </div>
                            </div>
                            <button class="search_option_suboption" onclick="toggleAccordion('it')">IT・コンピュータ <span class="plus">+</span></button>
                            <div id="it" class="accordion_content">
                                <button class="accordion_item full_width" onclick="selectAll('it', this);">IT・コンピュータをすべて選択</button>
                                <div id="it_list" class="double_column">
                                    <button class="accordion_item" onclick="selectItem(this)">プログラミング</button>
                                    <button class="accordion_item" onclick="selectItem(this)">ロボット工学</button>
                                </div>
                            </div>
                            <div class="search_actions">
                                <button class="search_button">この条件で検索する</button>
                                <div class="additional-buttons">
                                    <button>エリアも選ぶ</button>
                                    <button>年齢も選ぶ</button>
                                </div>
                                <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                            </div>
                        </div>
                    </div>
                    <div class="filter_row">
                        <span class="filter_label">曜日・時間帯</span>
                        <span class="filter_value">水曜、夕方</span>
                        <button class="change_btn" onclick="togglePopup('popup_day_time')">変更</button>
                    </div>
                    <div class="overlay"></div>
                    <div class="search_container" id="popup_day_time" style="display: none;">
                        <div class="close_button">×</div>
                        <div class="search_header">
                            <h1>曜日・時間帯を選ぶ</h1>
                        </div>
                        <div class="search_options">

                            <button class="search_option_suboption" onclick="toggleAccordion('day')">曜日 <span class="plus">+</span></button>
                            <div id="day" class="accordion_content">
                                <div class="double_column">
                                    <button class="accordion_item" onclick="selectItem(this)">月曜</button>
                                    <button class="accordion_item" onclick="selectItem(this)">火曜</button>
                                    <button class="accordion_item" onclick="selectItem(this)">水曜</button>
                                    <button class="accordion_item" onclick="selectItem(this)">木曜</button>
                                    <button class="accordion_item" onclick="selectItem(this)">金曜</button>
                                    <button class="accordion_item" onclick="selectItem(this)">土曜</button>
                                    <button class="accordion_item" onclick="selectItem(this)">日曜</button>
                                </div>
                            </div>
                            <button class="search_option_suboption" onclick="toggleAccordion('time')">時間帯 <span class="plus">+</span></button>
                            <div id="time" class="accordion_content">
                                <div class="double_column">
                                    <button class="accordion_item" onclick="selectItem(this)">朝(午前)</button>
                                    <button class="accordion_item" onclick="selectItem(this)">昼(12:00～16:00)</button>
                                    <button class="accordion_item" onclick="selectItem(this)">夕方(16:00～18:00)</button>
                                    <button class="accordion_item" onclick="selectItem(this)">夜(18:00以降)</button>
                                </div>
                            </div>
                        </div>
                        <div class="search_actions">
                            <button class="search_button">この条件で検索する</button>
                            <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                        </div>
                    </div>
                    <div class="filter_row">
                        <span class="filter_label">こだわり条件</span>
                        <span class="filter_value">指定なし</span>
                        <button class="change_btn" onclick="togglePopup('popup_conditions')">変更</button>
                    </div>
                    <div class="overlay"></div>
                    <div class="search_container" id="popup_conditions" style="display: none;">
                        <div class="close_button">×</div>
                        <div class="search_header">
                            <h1>こだわり条件を選ぶ</h1>
                        </div>
                        <div class="search_options">

                            <div class="double_column">
                                <button class="accordion_item" onclick="selectItem(this)">無料体験あり</button>
                                <button class="accordion_item" onclick="selectItem(this)">親子参加可</button>
                                <button class="accordion_item" onclick="selectItem(this)">月謝制</button>
                                <button class="accordion_item" onclick="selectItem(this)">チケット制</button>
                                <button class="accordion_item" onclick="selectItem(this)">材料費込み</button>
                                <button class="accordion_item" onclick="selectItem(this)">初回割引あり</button>
                                <button class="accordion_item" onclick="selectItem(this)">入会金あり</button>
                                <button class="accordion_item" onclick="selectItem(this)">電子決済あり</button>
                                <button class="accordion_item" onclick="selectItem(this)">送迎あり</button>
                                <button class="accordion_item" onclick="selectItem(this)">駐車場あり</button>
                            </div>
                        </div>
                        <div class="search_actions">
                            <button class="search_button">この条件で検索する</button>
                            <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                        </div>

                    </div>
                    <div class="filter_row">
                        <span class="filter_label">子供の性格</span>
                        <span class="filter_value">指定なし</span>
                        <button class="change_btn" onclick="togglePopup('popup_personality')">変更</button>
                    </div>
                    <div class="overlay"></div>
                    <div class="search_container" id="popup_personality" style="display: none;">
                        <div class="close_button">×</div>
                        <div class="search_header">
                            <h1>子供の性格を選ぶ</h1>
                        </div>
                        <div class="search_options">

                            <div class="double_column">
                                <button class="accordion_item" onclick="selectItem(this)">体を動かすのが好き</button>
                                <button class="accordion_item" onclick="selectItem(this)">楽器や歌が好き</button>
                                <button class="accordion_item" onclick="selectItem(this)">食べるのが好き</button>
                                <button class="accordion_item" onclick="selectItem(this)">手先が器用</button>
                                <button class="accordion_item" onclick="selectItem(this)">いろんな人と話すのが好き</button>
                                <button class="accordion_item" onclick="selectItem(this)">絵を描いたり、物を作るのが好き</button>
                                <button class="accordion_item" onclick="selectItem(this)">コツコツと取り組むのが好き</button>
                                <button class="accordion_item" onclick="selectItem(this)">集中力や忍耐力がある</button>
                                <button class="accordion_item" onclick="selectItem(this)">パズルやクイズを解くのが好き</button>
                            </div>
                        </div>
                        <div class="search_actions">
                            <button class="search_button">この条件で検索する</button>
                            <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                        </div>

                    </div>
                    <div class="filter_row">
                        <span class="filter_label">UPさせたいスキル</span>
                        <span class="filter_value">指定なし</span>
                        <button class="change_btn" onclick="togglePopup('popup_skills')">変更</button>
                    </div>
                    <div class="overlay"></div>
                    <div class="search_container" id="popup_skills" style="display: none;">
                        <div class="close_button">×</div>
                        <div class="search_header">
                            <h1>UPさせたいスキルを選ぶ</h1>
                        </div>
                        <div class="search_options">

                            <div class="double_column">
                                <button class="accordion_item" onclick="selectItem(this)">体力・持久力UP</button>
                                <button class="accordion_item" onclick="selectItem(this)">集中力UP</button>
                                <button class="accordion_item" onclick="selectItem(this)">忍耐力UP</button>
                                <button class="accordion_item" onclick="selectItem(this)">表現力・創造力UP</button>
                                <button class="accordion_item" onclick="selectItem(this)">挑戦する力UP</button>
                                <button class="accordion_item" onclick="selectItem(this)">自己管理能力UP</button>
                                <button class="accordion_item" onclick="selectItem(this)">計画力・段取り力UP</button>
                                <button class="accordion_item" onclick="selectItem(this)">コミュニケーション能力UP</button>
                            </div>
                        </div>
                        <div class="search_actions">
                            <button class="search_button">この条件で検索する</button>
                            <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                        </div>

                    </div>
                </div>


            </section>

            <!-- 検索結果一覧カード -->
            <!-- フリーワード検索の結果 -->
            <?php if (!empty(get_search_query())): ?>
                <h1 class="results_count">検索結果：<?php echo count($posts); ?>件（1-5件表示）</h1>
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="results_card">
                            <div class="wrap_card">
                                <div class="inner_card">
                                    <?php get_template_part('template-parts/loop', 'classroom');
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <h4>条件に合う習い事はありませんでした。</h4>
                <?php endif; ?>
            <?php else: ?>
                <!--条件検索のサブクエリ-->
                <?php

                $result = [
                    $area_slug = get_query_var('area'),
                    $age_type_slug = get_query_var('age_type'),
                    $classtype_slug = get_query_var('classtype'),
                    $weektimes_slug = get_query_var('weektimes'),
                    $cost_type_slug = get_query_var('cost_type'),
                    $personality_type_slug = get_query_var('personality_type'),
                    $skill_type_slug = get_query_var('skill_type'),
                ];

                $args = [
                    'post_type' => 'classroom',
                    'posts_per_page' => -1,
                ];
                $taxquerysp = ['relation' => 'AND'];

                foreach ($result as $value) {
                    if (!empty($value)) {
                        $taxquerysp[] = [
                            'taxonomy' => "$taxonomy_name[$count2]", //↑と違うカウントを使う
                            'terms' => $value,
                            'field' => 'slug',
                            'operator' => 'IN',
                        ];
                    }
                    $count2++;
                }

                $args['tax_query'] = $taxquerysp;
                $the_query = new WP_Query($args);
                ?>
                <!-- 条件検索の結果 -->
                <h1 class="results_count">検索結果：<?php echo $the_query->found_posts; ?>件（1-5件表示）</h1>
                <div>

                    <div class="results_card">
                        <?php if ($the_query->have_posts()): ?>
                            <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                                <div class="wrap_card">
                                    <div class="inner_card">
                                        <?php
                                        get_template_part('template-parts/loop', 'classroom');
                                        ?>
                                    </div>
                                </div>
                                <?php wp_reset_postdata(); ?>
                            <?php endwhile; ?>
                    </div>

                <?php else: ?>
                    <h4>条件に合う習いごとは見つかりませんでした。</h4>
                <?php endif; ?>


            <?php endif; ?>
                </div>

                </section>
                <!-- 検索結果一覧カードここまで -->

                <section class="footer_results">
                    <div class="containerpagenum">
                        <div class="results_pagenum">
                            <h3>
                                <?php if (function_exists('wp_pagenavi')): ?>
                                    <?php wp_pagenavi(); ?>
                                <?php endif; ?>
                            </h3>
                        </div>
                    </div>
                </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
