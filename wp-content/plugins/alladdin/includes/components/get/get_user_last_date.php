<?php
function get_user_last_date() {
  global $wpdb;
  $conn = $wpdb->get_results('SELECT last_date FROM wp_t9smq8bdpj_users WHERE ID = '.get_current_user_id().' LIMIT 1');
  foreach ($conn as $row) {
    return $row->last_date;
  };
}
