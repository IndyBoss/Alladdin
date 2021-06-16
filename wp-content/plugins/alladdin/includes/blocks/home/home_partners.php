<?php

/**
 * Home-partners Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'home_partners-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'home_partners';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$partners = get_field('partners');
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> home_text">
    <div class="home-partners-content">
      <h1 class="home-partners-title">Onze partners</h1>
      <h2 class="home-partners-text">Dankzij onze partners kunnen we onze klanten verwennen.</h2>
      <hr>
      <div class="home-partners-container">
        <div class="home-partners-group">
          <div class="home-partners-item"><img src="<?php echo $partners[0]['url'] ; ?>"></div>
          <div class="home-partners-item top-margin"><img src="<?php echo $partners[1]['url'] ; ?>"></div>
        </div>
        <div class="home-partners-group">
          <div class="home-partners-item top-margin"><img src="<?php echo $partners[2]['url'] ; ?>"></div>
          <div class="home-partners-item top-margin"><img src="<?php echo $partners[3]['url'] ; ?>"></div>
          <div class="home-partners-item top-margin"><img src="<?php echo $partners[4]['url'] ; ?>"></div>
        </div>
        <div class="home-partners-group no-margin">
          <div class="home-partners-item top-margin"><img src="<?php echo $partners[5]['url'] ; ?>"></div>
          <div class="home-partners-item top-margin"><img src="<?php echo $partners[6]['url'] ; ?>"></div>
        </div>
      </div>
    </div>
    <style type="text/css">
      <?php echo "#". esc_attr($id) ?> {
        width: 100%;
        margin: 0 auto;
        text-align: center;
        justify-content: center;
      }
    </style>
</div>
