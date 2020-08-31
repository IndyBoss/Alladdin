<?php
function update_user_score_paid() {
  global $wpdb;
  $price_points = get_user_points();
  $conn = $wpdb->update('wp_t9smq8bdpj_users', array('price_points'=> ($price_points + 5)), array('ID'=> get_current_user_id()));
}
