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
      <h1 class="u-margin-none">New Message</h1>
    </div>  
  <a href="messages" class="c-link">&lt; Back to Messages</a>

  <form>
    <div class="u-margin-top-xxlg">
      <label class="c-input u-color-blue u-text-bold">To:
      <input class="u-margin-top-md" type="text" placeholder="Type a name"></label>
      <textarea class="c-input__textarea u-margin-top-xxlg" placeholder="Write a message"></textarea>
    </div>
    <div class="u-float-right u-margin-top-xxlg">
      <a href="messages" class="c-link u-margin-right-lg">Cancel</a>
      <button type="submit" class="c-button c--primary">Send</button>
    </div>
  </form>
<div>  

  </div></div></main>

</body></html>