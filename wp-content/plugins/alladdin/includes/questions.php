<?php
function questions($atts) {
  $a = shortcode_atts( array('edit_url'=>'#'), $atts );
  $edit_url = esc_attr($a['edit_url']);
  if (!current_user_can('subscriber') || current_user_can('administrator')) {
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

      if (current_user_can('subscriber') || current_user_can('administrator')) {
      $result .= '<h2>Totale punten: '. get_user_points().'</h2>
                  <a href="/'.$edit_url.'">&#9998; Campagnes aanpassen</a>
                  <div id="questions">
                    <div id="leftBox">
                      <img id="questionImage" src="../wp-content/plugins/alladdin/assets/images/wireframe_browser">
                    </div>
                    <div id="rightBox">
                    Ga met de aanwijzer over de knoppen voor een voorbeeld.
                        <form action="" id="firstQuestion" method="post">
                          <input type="hidden" name="pos_id" value="'.$firstQ->ID.'">
                          <input type="hidden" name="neg_id" value="'.$secondQ->ID.'">
                          <button id="firstQuestionBtn" type="submit"><p>'.$firstQ->question.'</p></button>
                        </form>
                        <div class="questionSpacer"><h1>OF</h1></div>
                        <form action="" id="secondQuestion" method="post">
                          <input type="hidden" name="pos_id" value="'.$secondQ->ID.'">
                          <input type="hidden" name="neg_id" value="'.$firstQ->ID.'">
                          <button id="secondQuestionBtn" type="submit"><p>'.$secondQ->question.'</p></button>
                        </form>
                      </div>
                    </div>

                    <script type="text/javascript">
                      document.getElementById("firstQuestionBtn").addEventListener("mouseover", mouseOver1);
                      document.getElementById("firstQuestionBtn").addEventListener("mouseout", mouseOut);
                      document.getElementById("secondQuestionBtn").addEventListener("mouseover", mouseOver2);
                      document.getElementById("secondQuestionBtn").addEventListener("mouseout", mouseOut);

                      function mouseOver1() {
                        document.getElementById("questionImage").src = "'. $firstQ->img_url .'";
                      }
                      function mouseOver2() {
                        document.getElementById("questionImage").src = "'. $secondQ->img_url .'";
                      }

                      function mouseOut() {
                        document.getElementById("questionImage").src = "../wp-content/plugins/alladdin/assets/images/wireframe_browser";
                      }
                    </script>';
      }

      return $result;
    }
  }
}
add_shortcode( 'questions', 'questions' );
