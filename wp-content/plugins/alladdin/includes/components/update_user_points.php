<?php
function update_user_points($pos, $neg) {
  global $wpdb;
  $posQPoints = $wpdb->get_results('SELECT pos FROM wp_users WHERE ID = '.$pos);
  $wpdb->update('wp_questions', array('pos'=> $posQPoints+1), array('ID'=> $_POST['form_id']));

  $negQPoints = $wpdb->get_results('SELECT neg FROM wp_users WHERE ID = '.$neg);
  $wpdb->update('wp_questions', array('neg'=> $negQPoints+1), array('ID'=> $_POST['form_id']));
}
