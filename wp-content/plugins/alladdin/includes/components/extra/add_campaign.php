<?php
function add_campaign( $atts ) {
  global $wpdb;
  $a = shortcode_atts( array('view_url'=>'#'), $atts );
  $view_url = esc_attr($a['view_url']);
  $result = '';

  if (current_user_can('administrator')) {
    $result .= get_all_alerts();

    if ($_POST['method'] == 'add') {
      $result .= '<form action="/'.$view_url.'" method="post">
                    <input type="submit" name="submit" value="Terug">
                  </form><br><br>';
      $result .= list_campaign($view_url);

    } elseif ($_POST['method'] == 'update') {
      $result .= '<form action="/'.$view_url.'" method="post">
                    <input type="hidden" name="id" value="'.$_POST['id'].'">
                    <input type="submit" name="submit" value="Terug">
                  </form><br><br>';
      $result .= update_campaign($view_url, $_POST['id']);
    }
  }

  return $result;
}
add_shortcode('add_campaign', 'add_campaign');
