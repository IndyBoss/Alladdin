<?php

/**
 * Home-Profiles Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'home_profiles-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'home_profiles';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$title = get_field('title');
$text = get_field('text');
$profiles[0] = get_field('profile_1');
$profiles[1] = get_field('profile_2');
$profiles[2] = get_field('profile_3');

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> home_text">
  <div class="home-profiles-content">
    <h1><?php echo $title; ?></h1>
    <h2><?php echo $text; ?></h2>
    <hr>
    <div class="home-profiles-container">
      <?php for($i = 0; $i < count($profiles); ++$i): ?>
        <div class="home-profiles-list">
          <div class="home-profiles-wrapper home-profiles-wrapper-<?php echo $i; ?>">
            <div class="home-profiles-image">
              <img src="<?php echo $profiles[$i]['image'] ?>">
            </div>
            <div class="home-profiles-description">
              <h3><?php echo $profiles[$i]['profile_name'] ?></h3>
              <ul><?php echo $profiles[$i]['profile_description'] ?></ul>
            </div>
          </div>
        </div>
      <?php endfor; ?>
    </div>
  </div>
  <style type="text/css">

  </style>
</div>
