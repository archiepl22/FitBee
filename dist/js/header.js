$( document ).ready(function() {
  $(".c-nav-primary").find('> li').click( function(event){
      event.stopPropagation();
      $(this).find('> ul').toggle();
  });

  $(document).click( function(){
      $('.c-nav-primary__item-nav').hide();
  });

  // $(".c-side-nav__item").click( function(){
  //   event.stopPropagation();
  //   console.log('kttens')
  //   $(this).next().slideToggle(200);
  // });

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


  // Browse Workouts
  $(".js-browse-submit").click( function(){
    $(".js-browse-search").addClass('active');
  });

  $(".js-browse-back").click( function(){
    $(".js-browse-search").removeClass('active');
  });

  $(".js-tile-save").click( function(){
    $(this).parent().parent(".c-tile").toggleClass('c--saved');
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
    $('.js-messages__nav').addClass('hide');
  });

  $('.js-contact').click(function(){
    $('.t-messages__conversation-new').removeClass('active');
    $('.t-messages__conversation-name').addClass('active');
    $('.js-messages').children().show();
    $('.js-contacts').removeClass('active');
    $('.js-messages__nav').addClass('hide');
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


    // Group menu
  $(".js-group-menu").click( function(){
    $(".t-group__menu-items").slideToggle(200);
  });

   // Exercise Options
  // ---

  $(".js-exercise-button").click( function(){
     $(this).next(".js-exercise-options").toggleClass('active');
  });

  // Exercise Search

  $(".js-workout-search").click( function(){
     $(".js-workout-search-results").slideToggle(400);
  });

  // Exercise new

  // Exercise Highlight

  // $(".js-workout-exercise").click( function(){
  //   $(".js-workout-exercise").not(this).removeClass('active');
  //   $(this).toggleClass('active');
  // });

  // $(".single-line").click( function() {
  //   if ($(this).html() === "Exercise" || $(this).html() === "Weight" || $(this).html() === "reps") {
  //     $(this).text("");
  //   }
  // });

  // $(".single-line").focus(function() {
  //   $(this).text("")
  // });

  // $(document).click( function(){
  //   $('.js-workout-exercise').removeClass('active');
  // });

  $(".js-workout-exercise.t--new").click( function(){
     $(this).removeClass('t--new')
     .clone().appendTo('.t-workout__group').addClass('t--new');
  });

  $(".js-add-circuit").click( function(){
      $(".js-workout-exercise").first().clone().append().insertAfter('.js-add-circuit');
  });

  $(".js-remove-exercise").click( function(){
      $(this).parent().parent().remove();
  });

  // Workouts
   $(".js-tile-more").click( function(){
     $(this).next('.js-tile-icons').addClass('active');
  });


  // Calendar
  // ---


  $(".js-calendar-event-input").click( function(){
    $(".js-calendar .js-suggest").slideToggle(200);
  });

  var events = [ 
    { Title: "Five K for charity", Date: new Date("02/13/2017") }, 
    { Title: "Dinner", Date: new Date("02/25/2017") }, 
    { Title: "Meeting with manager", Date: new Date("03/01/2017") }
  ];

  $('#calendar').datepicker({
    inline: true,
    firstDay: 1,
    showOtherMonths: true,
    dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    beforeShowDay: function(date) {
        var result = [true, '', null];
        var matching = $.grep(events, function(event) {
            return event.Date.valueOf() === date.valueOf();
        });
        
        if (matching.length) {
            result = [true, 'active', null];
        }
        return result;
    },
    onSelect: function(dateText) {
        var date,
            selectedDate = new Date(dateText),
            i = 0,
            event = null;
        
        while (i < events.length && !event) {
            date = events[i].Date;

            if (selectedDate.valueOf() === date.valueOf()) {
                event = events[i];
            }
            i++;
        }
        if (event) {
            alert(event.Title);
        }
    }
  });

  // Accordion
  // ---

  $(".js-accordion").hide(); 

  $(".js-accordion-trigger").click( function(){
    $(this).next().slideToggle(200);
  });

});

