<?php
function update_user_new_day() {
  global $wpdb;
  $conn = $wpdb->update('wp_t9smq8bdpj_users', array('last_date'=> date("Y-m-d"), 'questions_today' => 0), array('ID'=> get_current_user_id()));
}
