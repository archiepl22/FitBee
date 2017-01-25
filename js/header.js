$( document ).ready(function() {
  $(".c-nav-primary").find('> li').click( function(event){
      event.stopPropagation();
      $(this).find('> ul').toggle();
  });

  $(document).click( function(){
      $('.c-nav-primary__item-nav').hide();
  });
});
