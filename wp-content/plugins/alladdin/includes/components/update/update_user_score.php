<?php
function update_user_score() {
  global $wpdb;
  $price_points = get_user_points();
  $questions_today = get_user_questions_today();
  $conn = $wpdb->update('wp_t9smq8bdpj_users', array('price_points'=> ($price_points + 5), 'questions_today' => ($questions_today + 1)), array('ID'=> get_current_user_id()));
}
