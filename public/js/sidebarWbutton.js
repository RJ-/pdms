
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});


$(document).ready(function(){
    $('body').append('<div id="toTop" class="btn" style="background-color:#4285f4;"><span class="fa fa-chevron-up"></span> Back to Top</div>');
    $(window).scroll(function () {
    if ($(this).scrollTop() > 400) {
      $('#toTop').fadeIn();
    } else {
      $('#toTop').fadeOut();
    }
  });
  $('#toTop').click(function(){
      $("html, body").animate({ scrollTop: 0 }, 1000);
      return false;
  });
});
