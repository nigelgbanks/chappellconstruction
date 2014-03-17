(function(window, $) {
  jQuery(document).ready(function($){
    /* prepend menu icon */
    $('#menu-main').before('<span id="mobile-menu"></span>');
    /* toggle nav */
    $("#mobile-menu").on("click", function(){
      $("#menu-main").slideToggle();
      $(this).toggleClass("active");
    });
  });
})(this, jQuery);
