<?php

/**
 * Home-mission Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'home_mission-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'home_mission';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$head_title = get_field('head_title');
$sub_text = get_field('sub_text');
$missions[0] = get_field('mission_1');
$missions[1] = get_field('mission_2');
$missions[2] = get_field('mission_3');

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> home_text">
  <div class="home-mission-section">
    <div class="home-mission-content">
      <h1><?php echo $head_title; ?></h1>
      <h2><?php echo $sub_text; ?></h2>
      <hr>

      <div class="home-mission-container">
        <?php for($i = 0; $i < count($missions); ++$i): ?>
          <div class="home-mission-list-<?php echo $i ?>">
            <div class="home-mission-wrapper-<?php echo $i ?>">
              <div class="home-mission-description">
                <div class="home-mission-detail">
                  <div>
                    <h3><?php echo $missions[$i]['title'] ?></h3>
                    <p><?php echo $missions[$i]['text'] ?></p>
                  </div>
                  <button type="button" class="home-mission-btn" onclick="location.href='/earn-points'">Geef je mening</button>
                </div>
              </div>
              <div class="home-mission-image-<?php echo $i ?>"><img src="<?php echo $missions[$i]['image'] ?>"></div>
            </div>
          </div>
        <?php endfor; ?>

      </div>
    </div>
  </div>
</div>
