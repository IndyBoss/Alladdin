<?php
function show_points() {
  global $wpdb;
  $conn = $wpdb->get_results('SELECT price_points FROM wp_t9smq8bdpj_users WHERE ID = '.get_current_user_id().' LIMIT 1');
  foreach ($conn as $row) {
    return "Prizes: " . $row->price_points. "P";
  };
}
add_shortcode( 'points', 'show_points' );
