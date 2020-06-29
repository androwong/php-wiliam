$( document ).ready(function() {
    $("#form").on('submit', function(event){
      event.preventDefault();
      $("#msg").html("");
      $.ajax({
         type: "POST",
         url: "/admin/php/process.php",
         data: $('#form').serialize(),
         dataType: "json"
      })
      .done(function(result) {
         $("#msg").html(result.msg);
      }).fail(function() {
         $("#msg").html('<div class="alert bg-danger text-white small">Something went wrong. Please try again later.</div>');
      })
   });
});
