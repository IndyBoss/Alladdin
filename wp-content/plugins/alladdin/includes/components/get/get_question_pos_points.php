<?php
function get_question_pos_points($pos) {
  global $wpdb;
  $conn = $wpdb->get_results('SELECT pos FROM wp_t9smq8bdpj_questions WHERE ID = '.$pos);
  foreach ($conn as $row) {
    return $row->pos;
  };
}
