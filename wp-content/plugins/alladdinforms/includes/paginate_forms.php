<?php
function paginate_forms($add_url, $data_url, $g_id, $questionaire_url) {
    global $wpdb;
    $result = "";

    if ($g_id == "") {
      $query = "SELECT * FROM wp_forms";
    } else {
      if ($g_id != 4) {
        $query = "SELECT * FROM wp_forms WHERE group_id = ". $g_id;
      } else {
        $query = "SELECT * FROM wp_forms";
      }
    }


    $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
    $total = $wpdb->get_var( $total_query );
    $items_per_page = 8;
    $page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
    $offset = ( $page * $items_per_page ) - $items_per_page;
    $conn = $wpdb->get_results( $query . " ORDER BY Date LIMIT ${offset}, ${items_per_page}" );

    if (current_user_can('administrator')) {
  		$result .= popup($add_url)."<table><tr><th>#</th><th>Naam</th><th>Groep</th><th>Link</th><th>Acties</th></tr>";
  	} elseif (current_user_can('subscriber')) {
      $result .= "<table><tr><th>Naam</th><th>Groep</th><th>Link</th></tr>";
    } else {
      $result .= popup($add_url). "<table><tr><th>#</th><th>Naam</th><th>Groep</th><th>Link</th><th>Acties</th></tr>";
    }

    if (!empty($conn[0]->ID)) {
      foreach ($conn as $c) {
        if (current_user_can('subscriber')) {
          $notFilled = "";
          $search= $wpdb->get_results( "SELECT Form_ID FROM wp_filled_forms_list WHERE User_ID = ".get_current_user_id() );
          foreach ($search as $s) {
            $notFilled = $s->Form_ID;
          }
          if ($notFilled == "") {
            $result .= "<tr><td>".$c->name."</td><td>".get_group_name($c->group_id)."</td><td><a href='/".$questionaire_url."?q=".$c->link."' target='_blank' >Vul formulier in</a></td></tr>";
          }
        } else {
          $result .= "<tr><td>".$c->ID."</td><td>".$c->name."</td><td>".get_group_name($c->group_id)."</td>";
          //<a href='/".$questionaire_url."?q=".$c->link."' target='_blank' >Link</a>
          if (!current_user_can('subscriber')) {
            $result .="<td><a href='/".$questionaire_url."?q=".$c->link."' target='_blank' >Voorbeeld</a></td><td>".
                      '<div style="display: grid;grid-column-gap: 10px;justify-content: left;grid-template-columns: auto auto;grid-template-rows: auto;">
                      <form action="/'.$add_url.'" method="post">
                        <input type="hidden" name="form_id" value="'.$c->ID.'">
                        <input type="hidden" name="naam" value="'.$c->name.'">
                        <input type="submit" name="submit" value="Aanpassen">
                      </form>
                      <form action="/'.$data_url.'" method="post">
                        <input type="hidden" name="form_id" value="'.$c->ID.'">
                        <input type="hidden" name="naam" value="'.$c->name.'">
                        <input type="submit" name="submit" value="Resultaten">
                      </form>
                      <div>';
          }
        }
      }
    } else {
      $result .= "<tr><td>#</td><td>Nog niet van toepassing</td><td>........</td><td>........</td><td>........</td></tr>";
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

    return $result;
}
