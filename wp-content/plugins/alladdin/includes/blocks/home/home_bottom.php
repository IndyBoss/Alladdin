<?php

/**
 * Home-bottom Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'home_bottom-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'home_bottom';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$title = get_field('title') ?: 'Wij zijn alladdin';
$text = get_field('text') ?: 'Verwen jezelf en geniet nu van onze voordelen.';
$btn_text = get_field('btn_text') ?: 'Begin je verhaal';
$btn_url = get_field('btn_url') ?: 'contact';
$image = get_field('image') ?: '../../../assets/images/starbucksFreeLatte.jpg';

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="home-bottom-content">
       <h1 class="home-bottom-title">
         <?php echo $title; ?>
       </h1>

       <h2 class="home-bottom-text"><?php echo $text; ?></h2>

       <button type="button" class="home-bottom-button" onclick="location.href='/<?php echo $btn_url ?>'">
            <span>
              <?php echo $btn_text ?>
            </span>
       </button>
    </div>
    <style type="text/css">
      <?php echo "#".esc_attr($id); ?> {
          position: relative;
          width: 100vw !important;
          height: 90vh;
          max-width: 100vw !important;
          display: flex;
          justify-content: center;
          align-items: center;
          left: 50%;
          right: 50%;
          margin-left: -50vw !important;
          margin-right: -50vw !important;
          margin-top: 80px;
          margin-bottom: -30px;
      }
      <?php echo "#".esc_attr($id); ?>::before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        max-width: 100vw;
        margin: 0 !important;
        height: 100%;
        background: url("<?php echo $image ?>");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: top center;
      }
    </style>
</div>
