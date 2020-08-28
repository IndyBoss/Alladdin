<?php
function get_prizes() {
  global $wpdb;
  $conn = $wpdb->get_results('SELECT * FROM wp_t9smq8bdpj_prize');
  $result = "<div id='prizes'>";
  foreach ($conn as $row) {
    $result .= '<a href="../coupon"><img src="../wp-content/plugins/alladdin/assets/images/'.$row->name.'.jpg"></a>';
  };

  $result .= "</div>";
  return $result;
}
