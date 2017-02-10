$( document ).ready(function() {
  $(".c-nav-primary").find('> li').click( function(event){
      event.stopPropagation();
      $(this).find('> ul').toggle();
  });

  $(document).click( function(){
      $('.c-nav-primary__item-nav').hide();
  });

  // Tab-bar mobile dashboard menu
  // ---

  $(".c-tab-bar__dash").click( function(){
    $(".c-mobile-dash").addClass('c--open');
  });

  // close on back button
  $(".c-mobile-dash__back").click( function(){
    $(".c-mobile-dash").removeClass('c--open');
  });

  // close on link click
  $(".c-mobile-dash").find("li").click( function(){
    $(".c-mobile-dash").removeClass('c--open'); 
  });


  // Profile feed
  // ---

  $(".js-profile-about").click( function(){
     $('.js-feed').removeClass('c--active');
     $('.js-about').addClass('c--active');
  });

  $(".js-profile-feed").click( function(){
     $('.js-about').removeClass('c--active');
     $('.js-feed').addClass('c--active');
  });


  // Messages Nav
  // ---

  $(".js-messages-inbox").click( function(){
     $(".js-messages-groups").removeClass('active');
     $(".js-messages-inbox").addClass('active');
  });

  $(".js-messages-groups").click( function(){
     $(".js-messages-inbox").removeClass('active');
     $(".js-messages-groups").addClass('active');
  });


  // Messages Contacts
  // ---

  $(".js-contact").click(function() {
    $(".js-contact").not(this).removeClass('active');
    $(this).toggleClass('active');
  });
});

