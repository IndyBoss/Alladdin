<?php

/**
 * Example Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'example-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'example';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Load values and assign defaults.
$text = get_field('example') ?: 'Your example here...';
$author = get_field('author') ?: 'Author name';
$role = get_field('role') ?: 'Author role';


?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
        <p class="example-text"><?php echo $text; ?></p>
        <p class="example-author"><?php echo $author; ?></p>
        <p class="example-role"><?php echo $role; ?></p>
    <style type="text/css">
        <?php echo $id; ?> {
          color: #1D1D1D;
        }
    </style>
</div>
