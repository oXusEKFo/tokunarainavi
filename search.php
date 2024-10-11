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
  $taxonomy_name[] = $value[0]->taxonomy;
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
          <h1 class="results_count">条件検索</h1>
          <?php
          //選択項目の保持と選択項目の名前の取得（エリア）
          //各タクソノミーでループ 名前の取得まで(area)
          foreach ($data as $terms) {
            $term_name[$taxonomy_name[$count]] = '指定なし';
            $select = filter_input(INPUT_GET, "$taxonomy_name[$count]", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?: [];
            foreach ($terms as $value) {
              $checked["$taxonomy_name[$count]"][$value->slug] = "";
            }
            foreach ($select as $value) {
              $checked["$taxonomy_name[$count]"][$value] = "checked";

              foreach ($terms as $slug) {
                if ($value === "$slug->slug") {
                  $term_name_array[$slug->taxonomy][] = "$slug->name";
                }
              }
            }

            if (!empty($term_name_array[$taxonomy_name[$count]])) {
              $term_name[$taxonomy_name[$count]] = implode(",", $term_name_array[$taxonomy_name[$count]]);
            }
            $count++;
          }
          //確認
          echo '<pre>';
          // print_r($_GET);
          // print_r($checked);
          // print_r($term_name_array);
          // print_r($term_name);
          echo '</pre>';
          ?>

        </div>
        <div class="search_filters">
          <form method="GET" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="hidden" name="s" value="">
            <div class="filter_row">
              <span class="filter_label">エリア</span>
              <span class="filter_value"><?= $term_name['area'] ?></span>
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
                      <label class="accordion_item <?= $checked['area']["$child_term->slug"] ?>">
                        <input type="checkbox" name="area[]" value="<?php echo $child_term->slug; ?>" <?= $checked['area']["$child_term->slug"] ?> onclick="selectItem(this)">
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
                      <label class="accordion_item <?= $checked['area']["$child_term->slug"] ?>">
                        <input type="checkbox" name="area[]" value="<?php echo $child_term->slug; ?>" <?= $checked['area']["$child_term->slug"] ?> onclick="selectItem(this)">
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
                        <label class="accordion_item <?= $checked['area']["$term->slug"] ?>">
                          <input type="checkbox" name="area[]" value="<?php echo $term->slug; ?>" <?= $checked['area']["$term->slug"] ?> onclick="selectItem(this)">
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
                  <button type="button" class="clear_button" onclick="clearSelections()">すべてクリア</button>
                </div>
              </div>
            </div>
            <div class="filter_row">
              <span class="filter_label">年齢</span>
              <span class="filter_value"><?= $term_name['age_type'] ?></span>
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
                      <label class="accordion_item <?= $checked['age_type']["$term->slug"] ?>">
                        <input type="checkbox" name="age_type[]" value="<?= $term->slug ?>" <?= $checked['age_type']["$term->slug"] ?> onclick="selectItem(this)">
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
                <button type="button" class="clear_button" onclick="clearSelections()">すべてクリア</button>
              </div>
            </div>
            <div class="filter_row">
              <span class="filter_label">ジャンル</span>
              <span class="filter_value"><?= $term_name['classtype'] ?></span>
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
                      <button type="button" class="search_option_suboption" onclick="toggleAccordion('<?php echo $parent_term->slug; ?>')"><?php echo $parent_term->name; ?> <span class="plus">+</span></button>
                      <div id="<?php echo $parent_term->slug; ?>" class="accordion_content">
                        <label class="accordion_item  full_width">
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
                              <label class="accordion_item <?= $checked['classtype']["$child_term->slug"] ?>">
                                <input type="checkbox" name="classtype[]" value="<?php echo esc_attr($child_term->slug); ?>" <?= $checked['classtype']["$child_term->slug"] ?> onclick="selectItem(this)">
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
                  <input type="submit" value="この条件で検索する" class="search_button"></input>
                  <!-- <div class="additional-buttons">
                  <button>エリアも選ぶ</button>
                  <button>年齢も選ぶ</button>
                </div> -->
                  <button type="button" class="clear_button" onclick="clearSelections()">すべてクリア</button>
                </div>
              </div>
            </div>
            <div class="filter_row">
              <span class="filter_label">曜日・時間帯</span>
              <span class="filter_value"><?= $term_name['weektimes'] ?></span>
              <button type="button" class="change_btn" onclick="togglePopup('popup_day_time')">変更</button>
            </div>
            <div class="overlay"></div>
            <div class="search_container" id="popup_day_time" style="display: none;">
              <div class="close_button" onclick="closePopup()">×</div>
              <div class="search_header">
                <h1>曜日・時間帯を選ぶ</h1>
              </div>
              <div class="search_options">
                <?php
                $parent_terms = get_terms(array(
                  'taxonomy' => 'weektimes',
                  'hide_empty' => false,
                  'orderby' => 'slug',
                  'order' => 'ASC',
                ));

                if (!empty($parent_terms) && !is_wp_error($parent_terms)):
                  foreach ($parent_terms as $parent_term):
                    if ($parent_term->parent == 0): // 只获取父分类
                ?>
                      <button type="button" class="search_option_suboption" onclick="toggleAccordion('<?= $parent_term->slug ?>')"><?= $parent_term->name ?><span class="plus">+</span></button>
                      <div id="<?= $parent_term->slug ?>" class="accordion_content">
                        <label class="accordion_item full_width">
                          <input type="checkbox" onclick="selectAll('<?php echo $parent_term->slug; ?>', this);">
                          <?php echo $parent_term->name; ?> をすべて選択
                        </label>
                        <div id="<?php echo $parent_term->slug; ?>_list" class="double_column">
                          <?php
                          $child_terms = get_terms(array(
                            'taxonomy' => 'weektimes',
                            'parent' => $parent_term->term_id,
                            'hide_empty' => false,
                            'orderby' => 'slug',
                            'order' => 'ASC',
                          ));

                          if (!empty($child_terms) && !is_wp_error($child_terms)):
                            foreach ($child_terms as $child_term):
                          ?>
                              <label class="accordion_item <?= $checked['weektimes']["$child_term->slug"] ?>">
                                <input type="checkbox" name="weektimes[]" value="<?php echo esc_attr($child_term->slug); ?>" <?= $checked['weektimes']["$child_term->slug"] ?> onclick="selectItem(this)">
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
              </div>
              <div class="search_actions">
                <button class="search_button">この条件で検索する</button>
                <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
              </div>
            </div>
            <div class="filter_row">
              <span class="filter_label">こだわり条件</span>
              <span class="filter_value"><?= $term_name['cost_type'] ?></span>
              <button type="button" class="change_btn" onclick="togglePopup('popup_conditions')">変更</button>
            </div>
            <div class="overlay"></div>
            <div class="search_container" id="popup_conditions" style="display: none;">
              <div class="close_button" onclick="closePopup()">×</div>
              <div class=" search_header">
                <h1>こだわり条件を選ぶ</h1>
              </div>
              <div class="search_options">
                <div class="double_column">
                  <?php
                  $terms = get_terms(array(
                    'taxonomy' => 'cost_type',
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'order' => 'ASC',

                  ));
                  if (!empty($terms) && ! is_wp_error($terms)):
                    foreach ($terms as $term):
                  ?>
                      <label class="accordion_item <?= $checked['cost_type']["$term->slug"] ?>">
                        <input type="checkbox" name="cost_type[]" value="<?php echo $term->slug; ?>" <?= $checked['cost_type']["$term->slug"] ?> onclick="selectItem(this)">
                        <?php echo $term->name; ?>
                      </label>
                  <?php
                    endforeach;
                  endif;
                  ?>
                </div>
              </div>
              <div class="search_actions">
                <button class="search_button">この条件で検索する</button>
                <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
              </div>
            </div>
            <div class="filter_row">
              <span class="filter_label">子供の性格</span>
              <span class="filter_value"><?= $term_name['personality_type'] ?></span>
              <button type="button" class="change_btn" onclick="togglePopup('popup_personality')">変更</button>
            </div>
            <div class="overlay"></div>
            <div class="search_container" id="popup_personality" style="display: none;">
              <div class="close_button" onclick="closePopup()">×</div>
              <div class="search_header">
                <h1>子供の性格を選ぶ</h1>
              </div>
              <div class="search_options">
                <div class="double_column">
                  <?php
                  $terms = get_terms(array(
                    'taxonomy' => 'personality_type',
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'order' => 'ASC',

                  ));
                  if (!empty($terms) && ! is_wp_error($terms)):
                    foreach ($terms as $term):
                  ?>
                      <label class="accordion_item <?= $checked['personality_type']["$term->slug"] ?>">
                        <input type="checkbox" name="personality_type[]" value="<?php echo $term->slug; ?>" <?= $checked['personality_type']["$term->slug"] ?> onclick="selectItem(this)">
                        <?php echo $term->name; ?>
                      </label>
                  <?php
                    endforeach;
                  endif;
                  ?>
                </div>
              </div>
              <div class="search_actions">
                <button class="search_button">この条件で検索する</button>
                <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
              </div>
            </div>
            <div class="filter_row">
              <span class="filter_label">UPさせたいスキル</span>
              <span class="filter_value"><?= $term_name['skill_type'] ?></span>
              <button type="button" class="change_btn" onclick="togglePopup('popup_skills')">変更</button>
            </div>
            <div class="overlay"></div>
            <div class="search_container" id="popup_skills" style="display: none;">
              <div class="close_button" onclick="closePopup()">×</div>
              <div class="search_header">
                <h1>UPさせたいスキルを選ぶ</h1>
              </div>
              <div class="search_options">
                <div class="double_column">
                  <?php
                  $terms = get_terms(array(
                    'taxonomy' => 'skill_type',
                    'hide_empty' => false,
                    'orderby' => 'slug',
                    'order' => 'ASC',

                  ));
                  if (!empty($terms) && ! is_wp_error($terms)):
                    foreach ($terms as $term):
                  ?>
                      <label class="accordion_item <?= $checked['skill_type']["$term->slug"] ?>">
                        <input type="checkbox" name="skill_type[]" value="<?php echo $term->slug; ?>" <?= $checked['skill_type']["$term->slug"] ?> onclick="selectItem(this)">
                        <?php echo $term->name; ?>
                      </label>
                  <?php
                    endforeach;
                  endif;
                  ?>
                </div>
              </div>
              <div class="search_actions">
                <button class="search_button">この条件で検索する</button>
                <button class="clear_button" onclick="clearSelections()">すべてクリア</button>
              </div>
            </div>
          </form>
        </div>

        <h1 class="results_count">フリーワード検索</h1>
        <form action="<?php echo home_url('/'); ?>" method="get">
          <input type="text" name="s" value="<?php the_search_query(); ?>" placeholder="キーワードを入力してください">
          <button type="submit">🔍</button>
        </form>
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
