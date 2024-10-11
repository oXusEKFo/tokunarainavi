<?php get_header(); ?>
<?php
//各タクソノミーのデータを取得
$data = [
  $area_terms = get_terms(['taxonomy' => 'area', 'orderby' => 'slug', 'hide_empty' => false]), //hide_empty 0件の項目を表示する場合は必要
  $age_type_terms = get_terms(['taxonomy' => 'age_type', 'orderby' => 'slug', 'hide_empty' => false]),
  $classtype_terms = get_terms(['taxonomy' => 'classtype', 'orderby' => 'slug', 'hide_empty' => false]),
  $weektimes_terms = get_terms(['taxonomy' => 'weektimes', 'orderby' => 'slug', 'hide_empty' => false]),
  $cost_type_terms = get_terms(['taxonomy' => 'cost_type', 'orderby' => 'slug', 'hide_empty' => false]),
  $personality_type_terms = get_terms(['taxonomy' => 'personality_type', 'orderby' => 'slug', 'hide_empty' => false]),
  $skill_type_terms = get_terms(['taxonomy' => 'skill_type', 'orderby' => 'slug', 'hide_empty' => false]),
];

// echo '<pre>';
// print_r($area_terms);
// echo '</pre>';
foreach ($data as $value) {
  $taxonomy_name[] = $value[1]->taxonomy;
}
$count = 0; //タクソノミー名取得用
$count2 = 0;
?>

<main>
  <?php
  // echo '<pre>';
  // print_r($taxonomy_name);
  // echo '<pre>';
  ?>
  <div class="results">
    <div class="inner_main">
      <!--パンくずリスト-->
      <div class="container_breadcrumb">
        <div class="breadcrumb">
          <?php get_template_part('template-parts/breadcrumb'); ?>
        </div>
      </div>
      <section class="search_results">
        <!--検索フォーム-->
        <div>
          <h1>条件検索</h1>
          <?php foreach ($data as $value) {
            // チェックしたものを検索した後も保持するための記述
            // 「エリア」のチェックを保持
            $select = filter_input(INPUT_GET, "$taxonomy_name[$count]", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?: [];
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
          }
          $name_imp = "エリアを選択";
          if (!empty($aaa)) {
            $name_imp = implode(",", $aaa);
          }
          ?>

          <!-- <div class="search_filters">
            <div class="filter_row">
              <span class="filter_label">エリア</span>
              <span class="filter_value"><?= $name_imp ?></span>
              <button class="change_btn" onclick="togglePopup('popup_area')">変更</button>
            </div>
            <div class="search_container" id="popup_area" style="display: none;">
              <form method="GET" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="hidden" name="s" value="">
                <div class="close_button" onclick="closePopup()">×</div>
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
                    <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                  </div>
                </div>
              </form>
            </div>
          </div> -->

          <h1>フリーワード検索</h1>
          <form action="<?php echo home_url('/'); ?>" method="get">
            <input type="text" name="s" value="<?php the_search_query(); ?>" placeholder="キーワードを入力してください">
            <button type="submit">🔍</button>
          </form>
        </div>
        <div class="search_filters">
          <form method="GET" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="hidden" name="s" value="">
            <div class="filter_row">
              <span class="filter_label">エリア</span>
              <span class="filter_value"><?= $name_imp ?></span>
              <button type="button" class="change_btn" onclick="togglePopup('popup_area')">変更</button>
            </div>
            <div class="overlay" style="display: none;"></div>
            <div class="search_container" id="popup_area" style="display: none;">
              <div class="close_button" onclick="closePopup()">×</div>
              <div class="search_header">
                <h1>エリアを選ぶ</h1>
              </div>
              <div class="search_options">
                <label class="accordion_item full_width"><input type="checkbox" onclick="selectAll('tokushima', this);">徳島市全域</label>
                <div id="tokushima" class="single_column">
                  <?php
                  $parent_term = get_term_by('slug', 'area01', 'area');
                  $child_terms = get_terms(array(
                    'taxonomy' => 'area',
                    'parent' => $parent_term->term_id,
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'order' => 'ASC',
                  ));
                  if (! empty($child_terms) && ! is_wp_error($child_terms)):
                    foreach ($child_terms as $child_term) :
                  ?>
                      <label class="accordion_item">
                        <input type="checkbox" name="area[]" value=" <?php echo $child_term->slug; ?>" onclick="selectItem(this)">
                        <?php echo $child_term->name; ?></label>
                  <?php
                    endforeach;
                  // wp_reset_postdata();
                  endif;
                  ?>
                </div>
                <label class="accordion_item full_width">
                  <input type="checkbox" onclick="selectAll('itano', this);">板野郡全域
                </label>
                <div id="itano" class="double_column">
                  <?php
                  $parent_term = get_term_by('slug', 'area02', 'area');
                  $child_terms = get_terms(array(
                    'taxonomy' => 'area',
                    'parent' => $parent_term->term_id,
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'order' => 'ASC',
                  ));
                  if (!empty($child_terms) && ! is_wp_error($child_terms)):
                    foreach ($child_terms as $child_term) :
                  ?>
                      <label class="accordion_item">
                        <input type="checkbox" name="area[]" value="<?php echo $child_term->slug; ?>" onclick="selectItem(this)">
                        <?php echo $child_term->name; ?>
                      </label>
                  <?php

                    endforeach;
                  // wp_reset_postdata();
                  endif;
                  ?>
                </div>
                <div class="double_column">
                  <?php
                  $terms = get_terms(array(
                    'taxonomy' => 'area',
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'order' => 'ASC',

                  ));
                  if (!empty($terms) && ! is_wp_error($terms)):
                    foreach ($terms as $term):
                      if ($term->parent == 0):
                        if ($term->slug == 'area01' || $term->slug == 'area02') {
                          continue;
                        }
                  ?>
                        <label class="accordion_item">
                          <input type="checkbox" name="area[]" value="<?php echo $term->slug; ?>" onclick="selectItem(this)">
                          <?php echo $term->name; ?>
                        </label>
                  <?php
                      endif;
                    endforeach;
                  // wp_reset_postdata();
                  endif;
                  ?>
                </div>
                <div class="search_actions">
                  <input type="submit" value="この条件で検索する" class="search_button"></input>
                  <!-- <div class="additional-buttons">
                  <button>年齢も選ぶ</button>
                  <button>ジャンルも選ぶ</button>
                </div> -->
                  <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                </div>
              </div>
            </div>
            <div class="filter_row">
              <span class="filter_label">年齢</span>
              <span class="filter_value">小学生（8-9歳）</span>
              <button type="button" class="change_btn" onclick="togglePopup('popup_age')">変更</button>
            </div>
            <div class="overlay"></div>
            <div class="search_container" id="popup_age" style="display: none;">
              <div class="close_button" onclick="closePopup()">×</div>
              <div class="search_header">
                <h1>年齢を選ぶ</h1>
              </div>
              <div class="search_options">
                <div class="double_column">
                  <?php
                  $terms = get_terms(array(
                    'taxonomy' => 'age_type',
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'order' => 'ASC',
                  ));
                  if (!empty($terms)):
                    foreach ($terms as $term) :
                  ?>
                      <label class="accordion_item">
                        <input type="checkbox" name="age_type[]" value="<?= $term->slug ?>" onclick="selectItem(this)">
                        <?php echo $term->name; ?>
                      </label>
                  <?php
                    endforeach;
                    wp_reset_postdata();
                  endif;
                  ?>
                </div>
              </div>
              <div class="search_actions">
                <input type="submit" value="この条件で検索する" class="search_button"></input>
                <!-- <div class="additional-buttons">
                <button>エリアも選ぶ</button>
                <button>ジャンルも選ぶ</button>
              </div> -->
                <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
              </div>
            </div>
            <div class="filter_row">
              <span class="filter_label">ジャンル</span>
              <span class="filter_value">プログラミング</span>
              <button type="button" class="change_btn" onclick="togglePopup('popup_genre')">変更</button>
            </div>
            <div class="overlay"></div>
            <div class="search_container" id="popup_genre" style="display: none;">
              <div class="close_button" onclick="closePopup()">×</div>
              <div class="search_header">
                <h1>ジャンルを選ぶ</h1>
              </div>
              <div class="search_options">
                <?php
                $parent_terms = get_terms(array(
                  'taxonomy' => 'classtype',
                  'hide_empty' => false,
                  'orderby' => 'slug',
                  'order' => 'ASC',
                ));

                if (!empty($parent_terms) && !is_wp_error($parent_terms)):
                  foreach ($parent_terms as $parent_term):
                    if ($parent_term->parent == 0): // 只获取父分类
                ?>
                      <button class="search_option_suboption" onclick="toggleAccordion('<?php echo $parent_term->slug; ?>')"><?php echo $parent_term->name; ?> <span class="plus">+</span></button>
                      <div id="<?php echo $parent_term->slug; ?>" class="accordion_content">
                        <label class="accordion_item full_width">
                          <input type="checkbox" onclick="selectAll('<?php echo $parent_term->slug; ?>', this);">
                          <?php echo $parent_term->name; ?> をすべて選択
                        </label>
                        <div id="<?php echo $parent_term->slug; ?>_list" class="double_column">
                          <?php
                          $child_terms = get_terms(array(
                            'taxonomy' => 'classtype',
                            'parent' => $parent_term->term_id,
                            'hide_empty' => false,
                            'orderby' => 'slug',
                            'order' => 'ASC',
                          ));

                          if (!empty($child_terms) && !is_wp_error($child_terms)):
                            foreach ($child_terms as $child_term):
                          ?>
                              <label class="accordion_item">
                                <input type="checkbox" value="<?php echo esc_attr($child_term->name); ?>" onclick="selectItem(this)">
                                <?php echo esc_html($child_term->name); ?>
                              </label>
                          <?php
                            endforeach;
                          endif;
                          ?>
                        </div>
                      </div>
                <?php
                    endif;
                  endforeach;
                endif;
                ?>
                <div class="search_actions">
                  <input type="submit" class="search_button">この条件で検索する</input>
                  <!-- <div class="additional-buttons">
                  <button>エリアも選ぶ</button>
                  <button>年齢も選ぶ</button>
                </div> -->
                  <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
                </div>
              </div>
            </div>
            <div class="filter_row">
              <span class="filter_label">曜日・時間帯</span>
              <span class="filter_value">水曜、夕方</span>
              <button type="button" class="change_btn" onclick="togglePopup('popup_day_time')">変更</button>
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
              <button type="button" class="change_btn" onclick="togglePopup('popup_conditions')">変更</button>
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
              <button type="button" class="change_btn" onclick="togglePopup('popup_personality')">変更</button>
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
              <button type="button" class="change_btn" onclick="togglePopup('popup_skills')">変更</button>
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
          </form>
        </div>
      </section>

      <!-- 検索結果一覧カード -->
      <!-- フリーワード検索の結果 -->
      <?php if (!empty(get_search_query())): ?>
        <h1 class="results_count">検索結果：<?php echo count($posts); ?>件（1-5件表示）</h1>
        <?php if (have_posts()) : ?>
          <div class="results_card">
            <?php while (have_posts()) : the_post(); ?>
              <div class="wrap_card">
                <div class="inner_card">
                  <?php get_template_part('template-parts/loop', 'classroom');
                  ?>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
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
        <?php if ($the_query->have_posts()): ?>
          <div class="results_card">
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

      </section>
      <!-- 検索結果一覧カードここまで -->
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
