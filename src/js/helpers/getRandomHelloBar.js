export default function ($, cb) {
  $.ajax({
    type : "POST",
    url  : ajax_object.ajax_url,
    data : {
      action : "get_random_hello_bar",
      rand   : Math.random()
    },
    success: function(data, textStatus, XMLHttpRequest) {
      $("body").prepend(data);
      cb();
    }
  });
}
