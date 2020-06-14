<?php
function update_question_totals() {
  global $wpdb;
  $score = $wpdb->get_results('SELECT score FROM wp_users WHERE ID = '.get_current_user_id().' LIMIT 1');
  $conn = $wpdb->update('wp_users', array('score'=> $score), array('ID'=> get_current_user_id()));
}
