JQuery(document).ready(function ($) {
  $.ajax({
    type: "GET",
    url: "wp-content/plugins/alladdin/includes/questions.php",
    data: {},
    success: function(response) {
      $("#questions").html(response);
    }
  });
});
