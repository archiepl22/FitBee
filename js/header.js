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

  // New Message
  // ---

  $(".js-new-message").click(function() {
    $('.t-messages__conversation-name').removeClass('active');
    $('.t-messages__conversation-new').addClass('active');
    $('.js-messages').children().hide();
    $(".js-contact").not(this).removeClass('active');
    $('.js-contacts').removeClass('active')
    $('.js-contact.new').addClass('active')

  });

  $('.js-contact').click(function(){
    $('.t-messages__conversation-new').removeClass('active');
    $('.t-messages__conversation-name').addClass('active');
    $('.js-messages').children().show();
    $('.js-contacts').removeClass('active')
  });

  $('.js-messages-back').click(function(){
    $('.js-contacts').addClass('active')
  });


  // Mobile Swipe nav 
  // ---
  $(".js-mobile-nav").click( function(){
    $(".js-swipe-nav").addClass('c--open');
  });

  // close on back button
  $(".js-swipe-nav__back").click( function(){
    $(".js-swipe-nav").removeClass('c--open');
  });

  // close on link click
  $(".js-swipe-nav").find("li").click( function(){
    $(".js-swipe-nav").removeClass('c--open'); 
  });
});

