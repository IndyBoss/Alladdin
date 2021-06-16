<?php

function get_groupid() {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT group_id FROM wp_t9smq8bdpj_usergroups WHERE user_id = ". get_current_user_id() );
  if (isset($conn[0])) {
    $g_id = $conn[0]->group_id;
  } else {
    $g_id = 7;
  }
  return $g_id;
}
