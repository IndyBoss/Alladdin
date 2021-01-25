<?php
function questionaire_send() {
  global $wpdb;
  $conn = $wpdb->get_results("SELECT * FROM `wp_question` WHERE form_id=" . $_POST['form_id']);
  $q = 1;

  foreach ($conn as $c) {
    switch ($c->qtype) {
      case 0:
        if (isset($_POST['question_'.$q])) {
          $text = $_POST['question_'.$q];
        }
        $wpdb->insert('wp_question_results_choice', array(
          'answer' => $text,
          'question_id' => $c->ID,
          'form_id' => $_POST['form_id']
        ));
        break;
      case 1:
        $text = '';
        for ($i=1; $i <= $c->parts; $i++) {
          if (isset($_POST['question_'.$q.'_'.$i])) {
            $text .= '|'.$_POST['question_'.$q.'_'.$i];
          }
        }
        $wpdb->insert('wp_question_results_multiple', array(
          'answer' => $text,
          'question_id' => $c->ID,
          'form_id' => $_POST['form_id']
        ));
        break;
      case 2:
      $text = $_POST['question_'.$q];
        $wpdb->insert('wp_question_results_open', array(
          'answer' => $text,
          'question_id' => $c->ID,
          'form_id' => $_POST['form_id']
        ));
        break;
    }
    $q ++;
  }

  if (current_user_can('subscriber')) {
    $wpdb->insert('wp_filled_forms_list', array(
      'User_ID' => get_current_user_id(),
      'Form_ID' => $_POST['form_id']
    ));

    $conn = $wpdb->get_results('SELECT price_points FROM wp_t9smq8bdpj_users WHERE ID = '.get_current_user_id().' LIMIT 1');
    foreach ($conn as $row) {
      $wpdb->update('wp_t9smq8bdpj_users', array('price_points'=> ($row->price_points + 5)), array('ID'=> get_current_user_id()));
    };
  }

  return "Danku voor de inzending!";
}
add_shortcode('questionaire_send', 'questionaire_send');
