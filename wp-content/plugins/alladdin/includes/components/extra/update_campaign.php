<?php
function update_campaign($a, $id) {
  wp_enqueue_media();
  global $wpdb;
  $conn = $wpdb->get_results("SELECT * FROM `wp_t9smq8bdpj_questions` WHERE ID=" . $id);

  $result = '<form action="/'. $a .'" method="post">
              <label for="question"><b>Vraag</b></label>
              <input type="text" placeholder="Vraag" name="question" value="'. $conn[0]->question.'" required><br>
              <label for="pos"><b>Positieve stemmen</b></label>
              <input type="text" placeholder="Positieve stemmen" name="pos" value="'. $conn[0]->pos.'"><br>
              <label for="pos"><b>Negatieve stemmen</b></label>
              <input type="text" placeholder="Negatieve stemmen" name="neg" value="'. $conn[0]->neg.'"><br>
              <label for="category"><b>Categorie</b></label>
              <input type="text" placeholder="Categorie" name="category" value="'. $conn[0]->category.'" required><br>
              <label for="img_url">Image</label>
              <input type="text" name="img_url" id="image_url" class="regular-text" value="'. $conn[0]->img_url.'" required>
              <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload foto">

              <input type="hidden" name="method" value="updated">
              <input type="hidden" name="id" value="'.$id.'">
              <input type="hidden" name="alert" value="Campagne aangepast.">
              <input type="submit" name="submit" value="Aanpassen">
            </form>

            <script type="text/javascript">
              jQuery(document).ready(function($){
                $("#upload-btn").click(function(e) {
                  e.preventDefault();
                  var image = wp.media({
                    title: "Upload foto"
                  }).open().on("select", function(e){
                    var uploaded_image = image.state().get("selection").first();
                    var image_url = uploaded_image.toJSON().url;
                    $("#image_url").val(image_url);
                  });
                });
              });
            </script>';

  return $result;
}
