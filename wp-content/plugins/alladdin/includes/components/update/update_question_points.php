<?php
function update_question_points($pos, $neg) {
  global $wpdb;
  $posP = get_question_pos_points($pos);
  $negP = get_question_neg_points($neg);

  $wpdb->update('wp_t9smq8bdpj_questions', array('pos'=> ($posP + 1)), array('ID'=> $pos));
  $wpdb->update('wp_t9smq8bdpj_questions', array('neg'=> ($negP + 1)), array('ID'=> $neg));
}
