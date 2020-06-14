<?php
function get_second_question($firstQ) {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT * FROM wp_questions WHERE ID != $firstQ->ID AND category = '$firstQ->category' ORDER BY RAND() LIMIT 1");
  foreach ($conn as $row) {
    return $row;
  };
}
