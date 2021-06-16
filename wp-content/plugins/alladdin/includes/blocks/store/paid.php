<?php

/**
 * Paid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'paid-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'paid';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$title = get_field('title') ?: 'Geniet ervan';
$text = get_field('text') ?: 'Bewaar je eenmalige code goed en geniet van je aankoop!';
$user_points = get_user_points();

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> main_text">
  <h1><?php echo $title; ?></h1>
  <h2><?php echo $text; ?></h2>
  <hr>

  <?php if ($user_points < $_POST["price"]) : ?>
    <h3>Spijtig genoeg kan je niet onder nul gaan.</h3>
  <?php else: ?>
    <h3>Voucher code: <?php echo uniqid(); ?></h3>
    <h3>Punten afgetrokken van je totaal. Je hebt nog: <?php echo update_user_score_paid($_POST["price"],$user_points); ?> punten</h3>
  <?php endif; ?>
</div>
