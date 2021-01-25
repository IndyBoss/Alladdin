<?php
function show_image_upload() {
  $result = wp_enqueue_media() . '
  <div>
    <label for="image_url">Image</label>
    <input type="text" name="image_url" id="image_url" class="regular-text" required>
    <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload foto">
  </div>

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
