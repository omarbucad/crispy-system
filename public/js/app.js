$(function() {
  $(".navbar-expand-toggle").click(function() {
    $(".app-container").toggleClass("expanded");
    return $(".navbar-expand-toggle").toggleClass("fa-rotate-90");
  });
  return $(".navbar-right-expand-toggle").click(function() {
    $(".navbar-right").toggleClass("expanded");
    return $(".navbar-right-expand-toggle").toggleClass("fa-rotate-90");
  });
});


$(function() {
  return $(".side-menu .nav .dropdown").on('show.bs.collapse', function() {
    return $(".side-menu .nav .dropdown .collapse").collapse('hide');
  });
});

$(function() {
  return tinymce.init({ selector:'.textarea' });
});

$(function() {
  return $('input.daterange').daterangepicker();
});

$(function() {
  return $('.multi-select').multiSelect();
});


$(document).ready(function(){
    $(document).on('click' , '.submit-form' , function(){
        var form = $($(this).data('form'));
        form.submit();
    });

    $(document).on('close.bs.alert', function () {
        $('#alert_container_remove').remove();
    });
});

function readURL(input , element , location) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      if(location == "src"){
        $(element).attr('src', e.target.result);
      }else{
        $(element).css('background-image', "url("+e.target.result+")");
      }
    }

    reader.readAsDataURL(input.files[0]);
  }
}