<?php
function paid() {
  global $wpdb;
  $conn = $wpdb->update('wp_t9smq8bdpj_users', array('price_points'=> ($price_points - $_POST["price"])), array('ID'=> get_current_user_id()));
  return "Punten afgetrokken van je totaal. Je hebt nog: " . get_user_points() . " punten";
}
add_shortcode( 'paid', 'paid' );
