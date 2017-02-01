$( document ).ready(function() {
  $(".c-nav-primary").find('> li').click( function(event){
    console.log('meow');
      event.stopPropagation();
      $(this).find('> ul').toggle();
  });

  $(document).click( function(){
      $('.c-nav-primary__item-nav').hide();
  });

  $(".c-tab-bar__dash").click( function(){
    console.log('meow');
    $(".c-mobile-dash").addClass('c--open');
  });

  $(".c-mobile-dash__back").click( function(){
    $(".c-mobile-dash").removeClass('c--open');
  });

  $(".c-mobile-dash").find("li").click( function(){
    $(".c-mobile-dash").removeClass('c--open'); 
  });
});
