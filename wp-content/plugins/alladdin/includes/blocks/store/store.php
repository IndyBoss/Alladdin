<?php

/**
 * Store Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'store-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'store';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$title = get_field('title') ?: 'Prijzenkast';
$text = get_field('text') ?: 'Geniet van je voordelen en geef wat liefde aan onze partners!';

$user_points = 0;
global $wpdb;
$conn = $wpdb->get_results('SELECT price_points FROM wp_t9smq8bdpj_users WHERE ID = '.get_current_user_id().' LIMIT 1');
foreach ($conn as $row) {
  $user_points = $row->price_points;
};
$conn = $wpdb->get_results('SELECT * FROM wp_t9smq8bdpj_prize ORDER BY price');

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> main_text">
  <h1><?php echo $title; ?></h1>
  <h2><?php echo $text; ?></h2>
  <hr>


<?php if (current_user_can('subscriber') || current_user_can('administrator')) : ?>
    <h3 class="center">Totale punten: <?php echo $user_points ?> </h3>
    <div id='prizes'>
    <?php foreach ($conn as $row) : ?>
      <?php if ($user_points >= $row->price): ?>
        <form action="../coupon" method="post">
          <input type="hidden" name="price" value="<?php echo $row->price; ?>">
          <button type="submit">
            <img src="../wp-content/plugins/alladdin/assets/images/<?php echo $row->name; ?>.jpg">
            <p><?php echo $row->price; ?> punten</p>
          </button>
        </form>
      <?php else: ?>
        <form action="" method="post">
          <button type="submit" class="isDisabled" disabled>
            <img src="../wp-content/plugins/alladdin/assets/images/<?php echo $row->name; ?>.jpg">
            <p><?php echo $row->price; ?> punten</p>
          </button>
        </form>
      <?php endif ?>
    <?php endforeach ?>
<?php endif ?>
