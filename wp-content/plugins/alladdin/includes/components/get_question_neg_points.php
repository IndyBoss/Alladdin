<?php
function get_question_neg_points($neg) {
  global $wpdb;
  $conn = $wpdb->get_results('SELECT neg FROM wp_t9smq8bdpj_questions WHERE ID = '.$neg);
  foreach ($conn as $row) {
    return $row->neg;
  };
}
