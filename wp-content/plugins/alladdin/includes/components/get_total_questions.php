<?php
function get_total_questions() {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT COUNT(*) AS total FROM wp_questions");
  foreach ($conn as $row) {
    return $row->total;
  };
}
