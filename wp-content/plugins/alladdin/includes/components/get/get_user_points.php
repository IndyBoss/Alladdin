<?php
function get_user_points() {
  global $wpdb;
  $conn = $wpdb->get_results('SELECT price_points FROM wp_t9smq8bdpj_users WHERE ID = '.get_current_user_id().' LIMIT 1');
  foreach ($conn as $row) {
    return $row->price_points;
  };
}
