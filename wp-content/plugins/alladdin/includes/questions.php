<?php
function questions() {
  if (current_user_can('subscriber') || current_user_can('administrator')) {
    global $wpdb;
    $result = '';

    if (isset($_POST['pos_id'])) {
      update_question_points($_POST['pos_id'], $_POST['neg_id']);
      update_user_score();
    }

    $firstQ = get_first_question();
    $secondQ = get_second_question($firstQ);

    $result .= '<h2>Totale punten: '.get_user_points().'</h2>
                <div id="questions">
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
