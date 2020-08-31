<?php
function questions() {
  if (current_user_can('subscriber') || current_user_can('administrator')) {
    global $wpdb;
    $result = '';

    if ( date("Y-m-d") != get_user_last_date() ) {
      update_user_new_day();
    }

    if (get_user_questions_today() >= 4) {
      return '<h2>Totale punten: '.get_user_points().'</h2><br><h2>Je hebt 5 vragen beantwoord, kom morgen terug!</h2>';
    }
    else {
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
                      <button type="submit"><p>'.$firstQ->question.'</p></button>
                    </form>

                    <form action="" id="secondQuestion" method="post">
                      <input type="hidden" name="pos_id" value="'.$secondQ->ID.'">
                      <input type="hidden" name="neg_id" value="'.$firstQ->ID.'">
                      <button type="submit"><p>'.$secondQ->question.'</p></button>
                    </form>
                  </div>';

      return $result;
    }
  }
}
add_shortcode( 'questions', 'questions' );
