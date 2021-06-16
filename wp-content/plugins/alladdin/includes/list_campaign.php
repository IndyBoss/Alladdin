<?php
function list_campaign($a) {
  wp_enqueue_media();

  $result = '<form action="/'. $a .'" method="post">
              <label for="question"><b>Vraag</b></label>
              <input type="text" placeholder="Vraag" name="question" value="" required><br>
              <label for="pos"><b>Positieve stemmen</b></label>
              <input type="text" placeholder="Positieve stemmen" name="pos" value=""><br>
              <label for="pos"><b>Negatieve stemmen</b></label>
              <input type="text" placeholder="Negatieve stemmen" name="neg" value=""><br>
              <label for="category"><b>Categorie</b></label>
              <input type="text" placeholder="Categorie" name="category" value="" required><br>
              <label for="img_url">Image</label>
              <input type="text" name="img_url" id="image_url" class="regular-text" required>
              <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload foto">

              <input type="hidden" name="method" value="added">
              <input type="hidden" name="alert" value="Campagne oegevoegd.">
              <input type="submit" name="submit" value="Toevoegen">
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
