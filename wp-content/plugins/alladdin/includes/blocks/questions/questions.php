<?php

/**
 * Questions Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'questions-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'questions';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$edit_url = get_field('edit_url') ?: 'campaignes';
$questionaires_url = get_field('questionaires_url') ?: 'questionaires';


?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> main_text">
  <h1>Wat zijn je voorkeuren?</h1>
  <h2>Jij kiest welke van de volgende 2 keuzes je verkiest en je krijgt punten. Makkie toch!</h2>
  <hr>

  <?php
    if (current_user_can('subscriber') || current_user_can('administrator')) {
      global $wpdb;
      $result = '';

      // Check if a day passed
      if ( date("Y-m-d") != get_user_last_date() ) {
        update_user_new_day();
      }

      // Check if a user answered 5 questions
      if (get_user_questions_today() >= 4) {
        ?>
        <h3 class="center">Je hebt 5 vragen beantwoord, kom morgen terug!</h3>
        <br>
        <div class="questions-btns">
          <!-- <h3>Totale punten: <?php echo get_user_points() ?></h3> -->
          <button type="button" class="questions-btn" onclick="location.href='/<?php echo $questionaires_url ?>'">Vragenlijsten voor extra punten</button>
          <?php if (!current_user_can('subscriber')): ?>
            <button type="button" class="questions-btn" onclick="location.href='/<?php echo $edit_url ?>'"> &#9998; Campagnes aanpassen</button>
          <?php endif; ?>
        </div><?php
      }
      else {
        if (isset($_POST['pos_id'])) {
          update_question_points($_POST['pos_id'], $_POST['neg_id']);
          update_user_score();
        }

        $firstQ = get_first_question();
        $secondQ = get_second_question($firstQ);
        ?>
        <div class="questions-list">
          <form class="questions-wrapper" action="" method="post">
            <input type="hidden" name="pos_id" value="<?php echo $firstQ->ID ?>">
            <input type="hidden" name="neg_id" value="<?php echo $secondQ->ID ?>">
            <button class="questions-button" type="submit">
              <div class="questions-description">
                <p><?php echo $firstQ->question ?></p>
              </div>
              <div class="questions-image">
                <img src="<?php echo $firstQ->img_url ?>">
              </div>
            </button>
          </form>
          <form class="questions-wrapper" action=""  method="post">
            <input type="hidden" name="pos_id" value="<?php echo $secondQ->ID ?>">
            <input type="hidden" name="neg_id" value="<?php echo $firstQ->ID ?>">
            <button class="questions-button" type="submit">
              <div class="questions-description">
                <p><?php echo $secondQ->question ?></p>
              </div>
              <div class="questions-image">
                <img src="<?php echo $secondQ->img_url ?>">
              </div>
            </button>
          </form>
        </div>
        <div class="questions-btns">
          <!-- <h3>Totale punten: <?php echo get_user_points() ?></h3> -->
          <button type="button" class="questions-btn" onclick="location.href='/<?php echo $questionaires_url ?>'">Vragenlijsten voor extra punten</button>
          <?php if (!current_user_can('subscriber')): ?>
            <button type="button" class="questions-btn" onclick="location.href='/<?php echo $edit_url ?>'"> &#9998; Campagnes aanpassen</button>
          <?php endif; ?>
        </div>
        <?php
      }
    } elseif (is_user_logged_in() && !current_user_can('subscriber') && !current_user_can('administrator')) {
      ?><button type="button" class="questions-btn" onclick="location.href='/<?php echo $questionaires_url ?>'">Vragenlijsten voor extra punten</button><?php
    }?>
</div>
