<?php
function campaigns($atts) {
  $a = shortcode_atts( array('campaign_url'=>'#','view_url'=>'#'), $atts );
  $campaign_url = esc_attr($a['campaign_url']);
  $view_url = esc_attr($a['view_url']);
  global $wpdb;
  $result = "";

  if (current_user_can('administrator')) {
    $result .= get_all_alerts();

		if (isset($_POST['method'])) {
      switch ($_POST['method']) {
        case 'delete':
          $wpdb->delete( 'wp_t9smq8bdpj_questions', array( 'ID' => $_POST['id'] ) );
          break;
        case 'added':
          $wpdb->insert('wp_t9smq8bdpj_questions', array(
            'question' => $_POST['question'],
            'pos' => $_POST['pos'],
            'neg' => $_POST['neg'],
            'category' => $_POST['category'],
            'img_url' => $_POST['img_url']
          ));
          break;
        case 'updated':
          $wpdb->update('wp_t9smq8bdpj_questions', array(
            'question' => $_POST['question'],
            'pos' => $_POST['pos'],
            'neg' => $_POST['neg'],
            'category' => $_POST['category'],
            'img_url' => $_POST['img_url']
          ), array('ID'=> $_POST['id']));
          break;
        default:
          $result .= "<h2>ERROR 404 - Er ging helaas iets verkeerd</h2>";
          break;
      }
		}



    $query = "SELECT * FROM wp_t9smq8bdpj_questions ";

    $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
    $total = $wpdb->get_var( $total_query );
    $items_per_page = 5;
    $page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
    $offset = ( $page * $items_per_page ) - $items_per_page;
    $conn = $wpdb->get_results( $query . " LIMIT ${offset}, ${items_per_page}" );

    $result .= '<form action="/'. $campaign_url .'" method="post">
                  <input type="hidden" name="method" value="add">
                  <input type="submit" value="Toevoegen +">
                </form>
    <table><tr><th>ID</th><th>Vraag</th><th>Positieve stemmen</th><th>Negatieve stemmen</th><th>Categorie</th><th>Foto url</th><th>Acties</th></tr>';

    if (!empty($conn[0]->ID)) {
      foreach ($conn as $c) {
          $result .= "<tr><td>".$c->ID."</td><td>".$c->question."</td><td>".$c->pos."</td><td>".$c->neg."</td><td>".$c->category."</td><td>".$c->img_url."</td><td>".
                      '<div style="display: grid;grid-column-gap: 10px;justify-content: left;grid-template-columns: auto auto;grid-template-rows: auto;">
                      <form action="/'. $campaign_url .'" method="post">
                        <input type="hidden" name="method" value="update">
                        <input type="hidden" name="id" value="'.$c->ID.'">
                        <input type="submit" value="&#9998; Aanpassen">
                      </form>
                      <form action="/'. $view_url .'" method="post">
                        <input type="hidden" name="method" value="delete">
                        <input type="hidden" name="id" value="'.$c->ID.'">
                        <input type="hidden" name="alert" value="Formulier verwijderd.">
                        <input type="submit" class="del" value="Verwijder formulier">
                      </form>
                      <div>';
        }
    } else {
      $result .= "<tr><td>#</td><td>Nog niet van toepassing</td><td>........</td><td>........</td><td>........</td><td>........</td><td>........</td></tr>";
    }

    $result .="</table>";

    $result .= paginate_links( array(
        'base' => add_query_arg( 'cpage', '%#%' ),
        'format' => '',
        'prev_text' => __('&laquo;'),
        'next_text' => __('&raquo;'),
        'total' => ceil($total / $items_per_page),
        'current' => $page
    ));
  }

  return $result;
}
add_shortcode( 'campaigns', 'campaigns' );
