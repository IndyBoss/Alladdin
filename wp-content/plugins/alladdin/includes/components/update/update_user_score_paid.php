<?php
function update_user_score_paid($Price,$user_points) {
  global $wpdb;
  $points_after_purchase = $user_points - $Price;
  $conn = $wpdb->update('wp_t9smq8bdpj_users', array('price_points'=> $points_after_purchase), array('ID'=> get_current_user_id()));
  return $points_after_purchase;
}
