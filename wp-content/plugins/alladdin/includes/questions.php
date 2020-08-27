<?php
function questions() {
  if (current_user_can('subscriber') || current_user_can('administrator')) {
    global $wpdb;
    $result = '';

    $result .= 'geupdate' . $_POST['pos_id'];

    if (isset($_POST['pos_id'])) {
      update_question_totals($_POST['pos_id'], $_POST['neg_id']);
      update_user_points();
    }

    $firstQ = get_first_question();
    $secondQ = get_second_question($firstQ);

    $result .= '<div id="questions">
                  <form action="" id="firstQuestion" method="post">
                    <input type="hidden" name="pos_id" value="'.$firstQ->ID.'">
                    <input type="hidden" name="neg_id" value="'.$secondQ->ID.'">
                    <input type="submit" value="'.$firstQ->question.'">
                  </form>
                  <form action="" id="secondQuestion" method="post">
                    <input type="hidden" name="pos_id" value="'.$secondQ->ID.'">
                    <input type="hidden" name="neg_id" value="'.$firstQ->ID.'">
                    <input type="submit" value="'.$secondQ->question.'">
                  </form>
                </div>';

    return $result;
  }
}
add_shortcode( 'questions', 'questions' );
