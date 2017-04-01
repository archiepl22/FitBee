<?php
	include("sandt_li.php");
?> 

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link href="css" rel="stylesheet">
		<script src="jquery.min.js.download"></script>
		<script src="header.js.download"></script>
		<link rel="stylesheet" href="style.css">
	</head>
  <body>

		<?php
			$dashboard = 1;
			include("header_li_dashboard.php");
		?>
  <main>
    <div class="t-dash"> 

    <div class="u-display-flex u--align-center u-margin-bottom-xxlg">
      <h1 class="u-margin-none">Private Message</h1>
    </div>  
  <a href="messages" class="c-link">&lt; Back to Messages</a>

  <article class="c-message c--open u-color-bg-white u-border">
    <div class="c-message__wrapper">
      <div class="u-margin-left-sm c-icon c--medium">
        <svg class="u-width-full u-align-vertical-middle u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50.3 38.9"><path d="M25.1 1.6c6.6 0 13.1 0 19.7 0 3.3 0 5.3 1.9 5.3 5.3 0 7.9 0 15.8 0 23.8 0 3.2-1.9 5.2-5.2 5.2 -13.3 0-26.5 0-39.8 0 -3.2 0-5.2-2-5.2-5.2 0-8 0-16 0-24 0-3.1 2-5.1 5.1-5.1C11.8 1.6 18.5 1.6 25.1 1.6zM6 32.5c0 0.1 0.1 0.1 0.1 0.2 13.1 0 26.1 0 39.4 0 -0.4-0.3-0.6-0.5-0.9-0.7 -3.2-2.2-6.3-4.4-9.5-6.7 -0.9-0.6-1.8-1.3-2.7-1.9 -0.8-0.6-1-1.2-0.6-1.7 0.4-0.6 1-0.6 1.8 0 0.1 0.1 0.1 0.1 0.2 0.2 4 2.8 8.1 5.7 12.1 8.5 0.3 0.2 0.6 0.3 0.9 0.5 0-8.1 0-16 0-24.1 -0.4 0.3-0.7 0.5-1 0.7 -6.2 4.8-12.3 9.7-18.5 14.5 -1.5 1.2-2.2 1.2-3.8 0C17.1 16.9 10.6 11.8 4 6.7 3.8 6.5 3.6 6.4 3.2 6.1c0 8.6 0 17 0 25.6 0.4-0.3 0.7-0.4 0.9-0.6 3.3-2.3 6.7-4.7 10-7 1.3-0.9 2.5-1.8 3.9-2.7 0.3-0.2 0.8-0.2 1.2-0.1 0.3 0.1 0.6 0.7 0.5 0.9 -0.1 0.4-0.4 0.8-0.8 1 -2.9 2.1-5.9 4.1-8.8 6.2C8.7 30.6 7.3 31.6 6 32.5zM45.7 5.1c0-0.1-0.1-0.2-0.1-0.2 -13.4 0-26.8 0-40.3 0C5.6 5.1 5.8 5.3 6 5.5c6.2 4.8 12.4 9.7 18.6 14.5 0.8 0.6 1.3 0.7 2 0 4.7-3.8 9.5-7.4 14.2-11.2C42.4 7.6 44 6.4 45.7 5.1z"></path></svg>
      </div>
      <div class="c-message__main">
        <h1 class="c-message__author c-link u-text-bold u-color-blue u-margin-none">Message Author</h1>
        <div class="c-message__details">
          <span class="c-message__subject u-margin-right-md">Beginning of the message...</span>
          <span class="u-color-grey">2hrs&nbsp;ago</span>
        </div>
      </div>
      <div class="c-message__trash u-margin-left-md c-icon c--small">
        <svg class="u-width-full u-align-vertical-middle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.2 21"><path d="M13.1 4.8H2.2c-0.7 0-1.3 0.6-1.3 1.3v13.4c0 0.7 0.6 1.3 1.3 1.3h10.9c0.7 0 1.3-0.6 1.3-1.3V6.1C14.4 5.4 13.8 4.8 13.1 4.8zM13.1 19.6H2.2V6.1h10.9V19.6z"></path><path d="M14.6 2.5h-3.9C10.4 1.1 9.1 0 7.6 0c-1.5 0-2.7 1.1-3 2.5H0.7C0.3 2.5 0 2.8 0 3.1c0 0.4 0.3 0.7 0.7 0.7h13.9c0.4 0 0.7-0.3 0.7-0.7C15.2 2.8 15 2.5 14.6 2.5zM7.6 1.3c0.8 0 1.4 0.5 1.7 1.1H5.9C6.2 1.8 6.9 1.3 7.6 1.3z"></path><path d="M4.5 17.9c0.2 0 0.4-0.2 0.4-0.4V8.3c0-0.2-0.2-0.4-0.4-0.4C4.2 7.9 4 8.1 4 8.3v9.1C4 17.7 4.2 17.9 4.5 17.9z"></path><path d="M7.5 17.9c0.2 0 0.4-0.2 0.4-0.4V8.3c0-0.2-0.2-0.4-0.4-0.4 -0.2 0-0.4 0.2-0.4 0.4v9.1C7.1 17.7 7.3 17.9 7.5 17.9z"></path><path d="M10.5 17.9c0.2 0 0.4-0.2 0.4-0.4v-5.6c0-0.2-0.2-0.4-0.4-0.4 -0.2 0-0.4 0.2-0.4 0.4v5.6C10.1 17.7 10.3 17.9 10.5 17.9z"></path><path d="M10.5 10.2c0.2 0 0.4-0.2 0.4-0.4V8.3c0-0.2-0.2-0.4-0.4-0.4 -0.2 0-0.4 0.2-0.4 0.4v1.4C10.1 10 10.3 10.2 10.5 10.2z"></path></svg>
      </div>
    </div>
    <div class="c-message__content u-margin-right-md">Bacon ipsum dolor amet biltong brisket frankfurter, sirloin kielbasa sausage rump jowl pig jerky alcatra chuck venison meatball. Turducken burgdoggen leberkas pork. Hamburger strip steak shoulder tail pancetta. Cow pig venison filet mignon short ribs, alcatra chuck jowl burgdoggen drumstick landjaeger.
    </div>
  
  </article>
  <form>
    <div class="u-margin-top-xxlg">
      <div class="u-display-flex u--align-center">
        <div class="c-icon c--small u-fill-blue">
          <svg class="u-width-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.2 15.3"><path d="M15.2 14.1l-0.7-3.8c0-0.2-0.1-0.4-0.3-0.5L4.7 0.3C4.5 0.1 4.3 0 4 0 3.8 0 3.5 0.1 3.4 0.3L0.3 3.4c-0.4 0.4-0.4 1 0 1.3l9.6 9.6c0.1 0.1 0.3 0.2 0.5 0.3l3.8 0.7c0.1 0 0.1 0 0.2 0 0.3 0 0.5-0.1 0.7-0.3C15.2 14.8 15.3 14.4 15.2 14.1zM11 13.7l2.7-2.7 0.2 1.1 -1.8 1.8L11 13.7zM1 4l0.7-0.7 6.8 6.8c0.1 0.1 0.1 0.1 0.2 0.1s0.2 0 0.2-0.1C9 10 9 9.8 8.9 9.7L2.1 2.9l0.7-0.7 1.4 1.4c0.1 0.1 0.1 0.1 0.2 0.1 0.1 0 0.2 0 0.2-0.1 0.1-0.1 0.1-0.3 0-0.4L3.3 1.7 4 1l9.4 9.4 -0.7 0.7L5.9 4.3c-0.1-0.1-0.3-0.1-0.5 0 -0.1 0.1-0.1 0.3 0 0.4l6.8 6.8 -0.7 0.7 -1.4-1.4c-0.1-0.1-0.3-0.1-0.5 0s-0.1 0.3 0 0.4l1.4 1.4 -0.7 0.7L1 4zM12.9 14l1.2-1.2 0.3 1.4L12.9 14z"></path></svg>
        </div>
        <span class="u-margin-left-lg u-color-blue u-text-bold">User Name</span>
      </div>
      <div class="u-margin-left-xxlg">
        <textarea class="c-input__textarea u-margin-top-xxlg u-padding-left-xxlg" placeholder="Write a reply..."></textarea>
      </div>
    </div>
    <div class="u-text-align-right u-margin-top-xxlg">
      <button type="submit" class="c-button c--primary">Reply</button>
    </div>
  </form>

</div>  

  </main>

</body></html>