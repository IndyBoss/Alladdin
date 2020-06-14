<?php
function get_first_question() {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT * FROM wp_questions ORDER BY RAND() LIMIT 1");
  foreach ($conn as $row) {
    return $row;
  };
}
