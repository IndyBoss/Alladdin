<?php
function get_prizes() {
  global $wpdb;
  $conn = $wpdb->get_results('SELECT * FROM wp_t9smq8bdpj_prize');
  $result = "<div id='prizes'>";
  foreach ($conn as $row) {
    if (get_user_points() >= $row->price) {
      $result .= '<form action="../coupon" method="post">
                    <input type="hidden" name="pos_id" value="'.$firstQ->ID.'">
                    <button type="submit">
                      <img src="../wp-content/plugins/alladdin/assets/images/'.$row->name.'.jpg">
                      <p>'.$row->price.' points</p>
                    </button>
                  </form>';
    } else {
      $result .= '<form action="" method="post">
                    <button type="submit" class="isDisabled" disabled>
                      <img src="../wp-content/plugins/alladdin/assets/images/'.$row->name.'.jpg">
                      <p>'.$row->price.' points</p>
                    </button>
                  </form>';
    }
  };

  $result .= "</div>";
  return $result;
}
