<?php
function store() {
  if (current_user_can('subscriber') || current_user_can('administrator')) {
    global $wpdb;
    $result = '';

    $result .= '<h2>Totale punten: '.get_user_points().'</h2>'.get_prizes();

    return $result;
  }
}
add_shortcode( 'store', 'store' );
