<?php
if (is_tax('classtype')) {
    $term_id = get_queried_object_id();
    increment_term_view_count($term_id); // 表示回数を増やす
}
