<?php
function data() {
	global $wpdb;
	$result = '';
	$charts = "";

	$choiceQ="";
	$multipleQ="";
	$openQ="";

  $f = $wpdb->get_results("SELECT * FROM `wp_forms` WHERE ID='" . $_POST['form_id'] . "'");
  $conn = $wpdb->get_results("SELECT * FROM `wp_question` WHERE form_id=" . $f[0]->ID);
  $count = 1;

  $result = '<div><h1>'.$f[0]->name.'</h1>';

  if ($conn[0]->ID == '') {
    $result .= '<p>Nog geen vragen in dit formulier.</p>';
  }

  foreach ($conn as $c) {
    switch ($c->qtype) {
      case 0:
        $totalChoice = 0;
        $qtotal = array();
        $qanswer = $wpdb->get_results("SELECT * FROM `wp_question_results_choice` WHERE form_id=" . $f[0]->ID . " AND question_id=" . $c->ID);
        foreach ($qanswer as $qa) {
            $totalChoice += 1;
        }
        $result .= '<br><h5 style="margin-bottom:0;">('.$totalChoice.' antwoorden) '. $count . '. ' . $c->question .'</h5><ol>';

        $pieces = explode("|", $c->text);
        for ($i=1; $i <= $c->parts; $i++) {
          foreach ($qanswer as $qa) {
            if ($qa->answer == $pieces[$i]) {
              $qtotal[$i] += 1;
            } else {$qtotal[$i] += 0;}
          }
					$perc = number_format(($qtotal[$i] / $totalChoice) * 100, 2, ',', '');
					$result .= "<li>".$pieces[$i]. " (".$perc."%)</li>";
        }
        $result .= '</ol></br>';
        break;
      case 1:
        $totalMultiple = 0;
        $qanswer = $wpdb->get_results("SELECT * FROM `wp_question_results_multiple` WHERE form_id=" . $f[0]->ID . " AND question_id=" . $c->ID);
        foreach ($qanswer as $qa) {
          $p = explode("|", $qa->answer);
          for ($i=1; $i < count($p); $i++) {
            $totalMultiple += 1;
          }
        }
        $result .= '<br><h5 style="margin-bottom:0;">('.$totalMultiple.' antwoorden) '. $count . '. ' . $c->question .'</h5><ul>';

        $pieces = explode("|", $c->text);
        for ($i=1; $i <= $c->parts; $i++) {
          $qtotal = array();
          foreach ($qanswer as $qa) {
            $p = explode("|", $qa->answer);
            for ($j=1; $j < count($p); $j++) {
              if ($p[$j] == $pieces[$i]) {
                $qtotal[$i] += 1;
              } else {$qtotal[$i] += 0;}
            }
          }
          $perc = number_format(($qtotal[$i] / $totalMultiple) * 100, 2, ',', '');
					$charts .= ',["' . $pieces[$i] . '(' . $perc . '%)",'. $qtotal[$i] .']';
					$result .= "
						<li>".$pieces[$i]. " (".$perc."% / ".$qtotal[$i]." keuzes)</li>";
        }
        $result .= '</ul></br>';
        break;
      case 2:
				$totalMultiple = 0;
				$qanswer = $wpdb->get_results("SELECT * FROM `wp_question_results_open` WHERE form_id=" . $f[0]->ID . " AND question_id=" . $c->ID);
				foreach ($qanswer as $qa) {
					$totalMultiple += 1;
				}
				$result .= '<br><h5 style="margin-bottom:0;">('.$totalMultiple.' antwoorden) '. $count . '. ' . $c->question .'</h5><ul>';

				$pieces = explode("|", $c->text);
				for ($i=1; $i <= $c->parts; $i++) {
					$qtotal = array();
					foreach ($qanswer as $qa) {
						$result .= '<li>'.$qa->answer.'</li>';
					}
					$result .= '</ul>';
				}
        break;
    }
    $count ++;
  }

	return $result;
}
add_shortcode('data', 'data');

?>
