<?php
function questions() {
  if (current_user_can('subscriber') || current_user_can('administrator')) {
    global $wpdb;
    $totalquestions = get_total_questions();
    $result = '';

    

    return $result;
  }
}
add_shortcode( 'questions', 'questions' );
