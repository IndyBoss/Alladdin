<?php
function get_user_questions_today() {
  global $wpdb;
  $conn = $wpdb->get_results('SELECT questions_today FROM wp_t9smq8bdpj_users WHERE ID = '.get_current_user_id().' LIMIT 1');
  foreach ($conn as $row) {
    return $row->questions_today;
  };
}
