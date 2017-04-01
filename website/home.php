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
			$dashboard = 0;
			include("header_li_dashboard.php");
		?>
	  
		<main>
			<div class="c-hero c--blue">
				<h1>FitBee Home</h1>
			</div>
    
      
			<div class="t-main t-home"> 
				<div class="t-home__news u-color-bg-white u-border u-padding-xxlg u-margin-top-xxlg u-text-align-center u-color-blue u-box-shadow">
				  <span class="u-text-size-title u-text-bold">Welcome back, 
					<?php
						echo $_SESSION['firstname']."!";
					?>
					 Here is what you missed...
				  </span>
				</div>
				
				<div class="c-grid__row u-margin-top-xxlg">
					<div class="c-grid__col8">
					  <div class="c-highlight u-color-bg-white u-border u-box-shadow u-margin-bottom-xxlg">
						<div class="c-highlight__title u-padding-md">
						  <svg class="c-icon c-highlight__badge u-fill-orange c--small u-margin-right-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46.7 64"><path d="M42.8 0H4C1.8 0 0 1.8 0 4v12.9c0 1.3 0.7 2.6 1.8 3.3l12.7 8.4C8.6 31.8 4.6 38 4.6 45.2 4.6 55.6 13 64 23.4 64c10.4 0 18.8-8.4 18.8-18.8 0-7.1-4-13.4-9.9-16.6L45 20.2c1.1-0.7 1.8-2 1.8-3.3V4C46.7 1.8 44.9 0 42.8 0zM38.2 45.2c0 8.2-6.6 14.8-14.8 14.8 -8.2 0-14.8-6.6-14.8-14.8 0-8.2 6.6-14.8 14.8-14.8C31.6 30.4 38.2 37 38.2 45.2zM42.8 16.9l-7.6 5.1v-7.6c0-0.7-0.6-1.3-1.3-1.3 -0.7 0-1.3 0.6-1.3 1.3v9.3l-4.8 3.2c-1.4-0.3-2.9-0.5-4.4-0.5 -1.5 0-3 0.2-4.4 0.5l-4.9-3.2v-9.3c0-0.7-0.6-1.3-1.3-1.3 -0.7 0-1.3 0.6-1.3 1.3v7.5l-7.5-5V4h7.5v3.6c0 0.7 0.6 1.3 1.3 1.3 0.7 0 1.3-0.6 1.3-1.3V4h18.4v3.6c0 0.7 0.6 1.3 1.3 1.3 0.7 0 1.3-0.6 1.3-1.3V4h7.6V16.9z" class="a"></path><path d="M21 34.8l-2.2 4.5L13.8 40c-1 0.1-1.8 0.8-2.1 1.8 -0.3 1-0.1 2 0.7 2.7l3.6 3.5 -0.8 4.9c-0.2 1 0.2 2 1.1 2.6 0.5 0.3 1 0.5 1.6 0.5 0.4 0 0.8-0.1 1.2-0.3l4.4-2.3 4.4 2.3c0.4 0.2 0.8 0.3 1.2 0.3 0.5 0 1.1-0.2 1.6-0.5 0.8-0.6 1.2-1.6 1.1-2.6L30.8 48l3.6-3.5c0.7-0.7 1-1.8 0.7-2.7 -0.3-1-1.1-1.7-2.1-1.8L28 39.2l-2.2-4.5c-0.4-0.9-1.4-1.5-2.4-1.5C22.4 33.3 21.4 33.9 21 34.8zM26.2 41.7l6.3 0.9L27.9 47l1.1 6.3 -5.7-3 -5.7 3 1.1-6.3 -4.6-4.5 6.3-0.9 2.8-5.7L26.2 41.7z" class="a"></path></svg>
						  <h1 class="u-color-blue u-text-bold u-text-size-medium u-display-inline-block u-margin-none">Trainer of the Day</h1>
						</div>
						<div class="c-highlight__image">
						  <img src="./default_files/profile-pic.jpg">
						</div>
						<div class="c-highlight__main">
						  <div class="c-highlight__top u-display-flex u-padding-lg">
							<div class="c-highlight__details">
							  <h1 class="c-highlight__name u-margin-none">User Name</h1>
							  <div class="u-display-flex u--align-center">
								<span class="c-highlight-pro u-margin-right-lg u-text-bold">Profession</span>
								<svg class="c-icon c--xxlarge u-fill-yellow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 190.6 30.3"><polygon points="17.7 0 22.6 10 33.6 11.6 25.6 19.4 27.5 30.3 17.7 25.2 7.8 30.3 9.7 19.4 1.7 11.6 12.7 10 "></polygon><polygon points="56.9 0 61.8 10 72.9 11.6 64.9 19.4 66.8 30.3 56.9 25.2 47.1 30.3 48.9 19.4 41 11.6 52 10 "></polygon><polygon points="96.2 0 101.1 10 112.1 11.6 104.1 19.4 106 30.3 96.2 25.2 86.3 30.3 88.2 19.4 80.2 11.6 91.2 10 "></polygon><polygon points="135.4 0 140.3 10 151.4 11.6 143.4 19.4 145.3 30.3 135.4 25.2 125.6 30.3 127.4 19.4 119.5 11.6 130.5 10 "></polygon><polygon points="174.7 0 179.6 10 190.6 11.6 182.6 19.4 184.5 30.3 174.7 25.2 164.8 30.3 166.7 19.4 158.7 11.6 169.7 10 "></polygon></svg>        </div>
							  <div class="c-highlight__location u-display-flex u--align-center">
								<svg class="c-icon c--small" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.2 12.1"><path d="M4.6 0C2.1 0 0 2.1 0 4.6c0 2 1.3 3.7 3.1 4.3L4 10.3c0.1 0.2 0.4 0.3 0.6 0.3 0.3 0 0.5-0.1 0.6-0.3L6.1 9c1.8-0.6 3.1-2.4 3.1-4.3C9.2 2.1 7.1 0 4.6 0zM5.6 8.3l-1 1.6 -1-1.6C1.9 7.9 0.8 6.4 0.8 4.6c0-2.1 1.7-3.8 3.8-3.8 2.1 0 3.8 1.7 3.8 3.8C8.4 6.4 7.2 7.9 5.6 8.3z"></path><path d="M1.9 4.6c0-1.5 1.2-2.7 2.7-2.7 0.3 0 0.6 0.1 0.9 0.2 0.1 0 0.3 0 0.3-0.1 0-0.1 0-0.3-0.1-0.3C5.4 1.4 5 1.4 4.6 1.4c-1.8 0-3.2 1.4-3.2 3.2 0 0.8 0.3 1.6 0.9 2.3 0 0.1 0.1 0.1 0.2 0.1 0.1 0 0.1 0 0.2-0.1 0.1-0.1 0.1-0.3 0-0.4C2.2 6 1.9 5.3 1.9 4.6z"></path><path d="M7.8 4c0-0.1-0.2-0.2-0.3-0.2C7.3 3.8 7.2 4 7.3 4.1c0 0.2 0 0.3 0 0.5 0 1.5-1.2 2.7-2.7 2.7 -0.4 0-0.8-0.1-1.2-0.3C3.3 7 3.1 7 3.1 7.2 3 7.3 3.1 7.4 3.2 7.5c0.4 0.2 0.9 0.3 1.4 0.3 1.8 0 3.2-1.4 3.2-3.2C7.8 4.4 7.8 4.2 7.8 4z"></path><path d="M6.9 3.2c0 0.1 0.1 0.1 0.2 0.1 0 0 0.1 0 0.1 0 0.1-0.1 0.2-0.2 0.1-0.3C7.2 2.6 6.9 2.3 6.6 2.1 6.5 2 6.4 2 6.3 2.1c-0.1 0.1-0.1 0.3 0 0.4C6.6 2.7 6.8 2.9 6.9 3.2z"></path><path d="M6.2 11.3H3c-0.2 0-0.4 0.2-0.4 0.4 0 0.2 0.2 0.4 0.4 0.4h3.2c0.2 0 0.4-0.2 0.4-0.4C6.6 11.5 6.4 11.3 6.2 11.3z"></path></svg>
								<span class="u-margin-left-md u-text-bold">Toronto</span>
							  </div>
							  <div class="c-highlight__followers">
								<span>437 Followers</span>
								<a class="c-link u-margin-left-lg">Follow</a>
							  </div>
							</div>
							<div class="c-highlight__contact u-text-align-center">
							  <svg class="c-icon c-highlight__badge u-hidden-md-down u-fill-blue u-margin-bottom-xxlg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46.7 64"><path d="M42.8 0H4C1.8 0 0 1.8 0 4v12.9c0 1.3 0.7 2.6 1.8 3.3l12.7 8.4C8.6 31.8 4.6 38 4.6 45.2 4.6 55.6 13 64 23.4 64c10.4 0 18.8-8.4 18.8-18.8 0-7.1-4-13.4-9.9-16.6L45 20.2c1.1-0.7 1.8-2 1.8-3.3V4C46.7 1.8 44.9 0 42.8 0zM38.2 45.2c0 8.2-6.6 14.8-14.8 14.8 -8.2 0-14.8-6.6-14.8-14.8 0-8.2 6.6-14.8 14.8-14.8C31.6 30.4 38.2 37 38.2 45.2zM42.8 16.9l-7.6 5.1v-7.6c0-0.7-0.6-1.3-1.3-1.3 -0.7 0-1.3 0.6-1.3 1.3v9.3l-4.8 3.2c-1.4-0.3-2.9-0.5-4.4-0.5 -1.5 0-3 0.2-4.4 0.5l-4.9-3.2v-9.3c0-0.7-0.6-1.3-1.3-1.3 -0.7 0-1.3 0.6-1.3 1.3v7.5l-7.5-5V4h7.5v3.6c0 0.7 0.6 1.3 1.3 1.3 0.7 0 1.3-0.6 1.3-1.3V4h18.4v3.6c0 0.7 0.6 1.3 1.3 1.3 0.7 0 1.3-0.6 1.3-1.3V4h7.6V16.9z" class="a"></path><path d="M21 34.8l-2.2 4.5L13.8 40c-1 0.1-1.8 0.8-2.1 1.8 -0.3 1-0.1 2 0.7 2.7l3.6 3.5 -0.8 4.9c-0.2 1 0.2 2 1.1 2.6 0.5 0.3 1 0.5 1.6 0.5 0.4 0 0.8-0.1 1.2-0.3l4.4-2.3 4.4 2.3c0.4 0.2 0.8 0.3 1.2 0.3 0.5 0 1.1-0.2 1.6-0.5 0.8-0.6 1.2-1.6 1.1-2.6L30.8 48l3.6-3.5c0.7-0.7 1-1.8 0.7-2.7 -0.3-1-1.1-1.7-2.1-1.8L28 39.2l-2.2-4.5c-0.4-0.9-1.4-1.5-2.4-1.5C22.4 33.3 21.4 33.9 21 34.8zM26.2 41.7l6.3 0.9L27.9 47l1.1 6.3 -5.7-3 -5.7 3 1.1-6.3 -4.6-4.5 6.3-0.9 2.8-5.7L26.2 41.7z" class="a"></path></svg>
							  <a class="c-highlight__view c-button c--secondary u-display-block u-margin-top-lg">View&nbsp;Users&nbsp;Workouts</a>
							</div>
						  </div>
						</div>
					  </div>      <div class="js-feed c-feed c--active ">
						<div class="c-share">
						  <div class="c-share__icons">
							<div class="c-share__label u-display-inline-block u-text-bold u-color-blue">
							  <svg class="c-icon c--small u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.2 8"><path d="M8.3 1.1H8V0.6C8 0.3 7.8 0 7.5 0H5.6C5.2 0 5 0.3 5 0.6v0.5H0.9C0.4 1.1 0 1.5 0 1.9v4.2C0 6.6 0.4 7 0.9 7h1.7c0.5 0.6 1.2 1 2 1 0.8 0 1.6-0.4 2-1h1.7c0.5 0 0.9-0.4 0.9-0.9V1.9C9.2 1.5 8.8 1.1 8.3 1.1zM5.6 0.6h1.9v0.5H5.6V0.6zM4.6 7.4c-1.1 0-2-0.9-2-2 0-1.1 0.9-2 2-2 1.1 0 2 0.9 2 2C6.6 6.6 5.7 7.4 4.6 7.4zM8.3 6.5H7c0.1-0.3 0.2-0.6 0.2-1C7.2 4 6 2.9 4.6 2.9 3.2 2.9 2 4 2 5.5c0 0.4 0.1 0.7 0.2 1H0.9c-0.2 0-0.3-0.1-0.3-0.3V2.5h5.9c0.1 0 0.2-0.1 0.2-0.2S6.6 2.1 6.5 2.1H0.6V1.9c0-0.2 0.1-0.3 0.3-0.3h7.4c0.2 0 0.3 0.1 0.3 0.3v0.1h-1c-0.1 0-0.2 0.1-0.2 0.2s0.1 0.2 0.2 0.2h1v3.7C8.6 6.3 8.5 6.5 8.3 6.5z"></path><path d="M6 4.9c0-0.1-0.2-0.1-0.3-0.1C5.6 4.8 5.6 4.9 5.6 5c0.1 0.1 0.1 0.3 0.1 0.4 0 0.6-0.5 1.1-1.1 1.1S3.5 6.1 3.5 5.5c0-0.6 0.5-1.1 1.1-1.1 0.1 0 0.3 0 0.4 0.1 0.1 0 0.2 0 0.3-0.1 0-0.1 0-0.2-0.1-0.3C5 4 4.8 4 4.6 4 3.8 4 3.1 4.6 3.1 5.5c0 0.8 0.7 1.5 1.5 1.5 0.8 0 1.5-0.7 1.5-1.5C6.1 5.3 6 5.1 6 4.9z"></path><circle cx="4.6" cy="5.5" r="0.5"></circle></svg>
							  Add Photo
							</div>
							<div class="c-share__label u-display-inline-block  u-text-bold u-color-blue">
							  <svg class="c-icon c--small u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.2 8.6"><path d="M8.8 5.4h-1c0 0-0.1 0-0.1 0L7 5.8V5.2C7 5 6.8 4.9 6.6 4.9h-6C0.4 4.9 0.3 5 0.3 5.2v1.1c0 0.2 0.1 0.3 0.3 0.3h0.7v1.6c0 0.2 0.1 0.3 0.3 0.3h5C6.8 8.6 7 8.4 7 8.3V7.8l0.8 0.4c0 0 0.1 0 0.1 0h1C9 8.2 9.2 8 9.2 7.9V5.7C9.2 5.6 9 5.4 8.8 5.4zM1.9 7.9V6.4h2.7c0.1 0 0.2-0.1 0.2-0.2S4.8 6 4.6 6H0.9V5.5h5.4V6H5.7C5.5 6 5.4 6.1 5.4 6.2s0.1 0.2 0.2 0.2h0.7v1.5H1.9zM8.5 7.5H8.1V6.7c0-0.1-0.1-0.2-0.2-0.2 -0.1 0-0.2 0.1-0.2 0.2v0.7L7.1 7.1V6.5L8 6.1h0.6V7.5z"></path><path d="M2.2 4.5C3 4.5 3.7 4 4.1 3.4 4.5 4 5.2 4.5 6 4.5c1.2 0 2.2-1 2.2-2.2C8.3 1 7.3 0 6 0 5.2 0 4.5 0.4 4.1 1.1 3.7 0.4 3 0 2.2 0 1 0 0 1 0 2.2 0 3.5 1 4.5 2.2 4.5zM6 0.7c0.9 0 1.6 0.7 1.6 1.6S6.9 3.8 6 3.8c-0.9 0-1.6-0.7-1.6-1.6S5.2 0.7 6 0.7zM2.2 0.7c0.9 0 1.6 0.7 1.6 1.6S3.1 3.8 2.2 3.8c-0.9 0-1.6-0.7-1.6-1.6S1.4 0.7 2.2 0.7z"></path><path d="M2.2 2.9c0.4 0 0.7-0.3 0.7-0.7 0-0.4-0.3-0.7-0.7-0.7 -0.4 0-0.7 0.3-0.7 0.7C1.5 2.6 1.8 2.9 2.2 2.9zM2.2 2c0.1 0 0.3 0.1 0.3 0.3S2.4 2.5 2.2 2.5C2.1 2.5 2 2.4 2 2.2S2.1 2 2.2 2z"></path><path d="M6 2.9c0.4 0 0.7-0.3 0.7-0.7 0-0.4-0.3-0.7-0.7-0.7 -0.4 0-0.7 0.3-0.7 0.7C5.3 2.6 5.6 2.9 6 2.9zM6 2c0.1 0 0.3 0.1 0.3 0.3S6.2 2.5 6 2.5 5.8 2.4 5.8 2.2 5.9 2 6 2z"></path></svg>
							  Add Video
							</div>
						  </div>
						  <div class="u-padding-sides-lg">
							<textarea placeholder="Share your accomplishments!"></textarea>
						  </div>
						  <div class="u-display-flex u--align-center u--space-between u-padding-lg">
							<div class="c-checkbox c--quiet">
							  <input type="checkbox" value="public" checked>
							  <label for="remeber">Public</label>
							</div>    <button class="c-button c--primary">Share</button>
						  </div>
						</div>  <article class="c-post u-display-flex u--column">
						  <div class="c-post__profile u-display-flex u-padding-lg">
							<div class="c-post__image u-margin-right-lg">
							  <img src="./default_files/profile-pic.jpg">
							</div>
							<div class="c-post__details">
							  <h1 class="u-margin-none"><span class="u-text-bold u-color-blue">User Name</span> completed something special</h1>
							  <span class="u-text-size-small">2:03pm</span>
							</div>
						  </div>
						
						  <div class="c-post__content u-padding-lg">
							<p class="u-margin-bottom-lg u-margin-top-none">Caption goes here</p>
							<div class="c-post__content-image">
							  <img src="./default_files/profile-pic.jpg">
							</div>
						  </div>
						</article></div>      <div class="js-about c-about ">
						<h1 class="u-text-size-title u-margin-top-none u-margin-bottom-md">About</h1>
						<div class="c-item">
						  <div class="u-padding-xlg">
							<p class="u-margin-none u-margin-bottom-lg u-text-size-small">Bacon ipsum dolor amet pig beef pancetta picanha biltong, frankfurter shoulder rump meatball. Cow kevin frankfurter tail landjaeger hamburger ham filet mignon, pork loin jerky bacon chuck salami pork belly bresaola. Burgdoggen meatball chuck boudin, tri-tip rump spare ribs. Ribeye picanha ground round, jowl leberkas ball tip kielbasa andouille corned beef short ribs shoulder shank filet mignon.</p>
					  
							<div>
							  <div class="c-grid__row">
								<div>
								  <div class="u-text-size-quiet">Age:</div>
								  34
								</div>
								<div>
								  <div class="u-text-size-quiet">Hometown:</div>
								  Las Vegas
								</div>
							  </div>
							  <div class="c-grid__row">
								<div>
								  <div class="u-text-size-quiet">Gym:</div>
								  Steve Nash
								</div>
								<div>
								  <div class="u-text-size-quiet">Team:</div>
								  Nash Foxes
								</div>
								<div>
								  <div class="u-text-size-quiet">School:</div>
								  Las Vegas High
								</div>
							  </div>
							</div>
						  </div>
						  <div class="u-border-top u-padding-xlg">
							<div class="c-grid__row">
							  <div>
								<div class="u-text-size-quiet">Gym:</div>
								Steve Nash
							  </div>
							  <div>
								<div class="u-text-size-quiet">Team:</div>
								Nash Foxes
							  </div>
							  <div>
								<div class="u-text-size-quiet">School:</div>
								Las Vegas High
							  </div>
							</div>
						  </div>
						</div>
					  </div>    </div>
					<div class="c-grid__col4 u-hidden-xs-down">
					   <div class="u-color-bg-white u-width-full u-box-shadow u-border u-margin-bottom-xxlg">
						<div class="c-highlight__title u-padding-md">
						  <svg class="c-icon c-highlight__badge u-fill-orange c--small u-margin-right-md" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46.7 64"><path d="M42.8 0H4C1.8 0 0 1.8 0 4v12.9c0 1.3 0.7 2.6 1.8 3.3l12.7 8.4C8.6 31.8 4.6 38 4.6 45.2 4.6 55.6 13 64 23.4 64c10.4 0 18.8-8.4 18.8-18.8 0-7.1-4-13.4-9.9-16.6L45 20.2c1.1-0.7 1.8-2 1.8-3.3V4C46.7 1.8 44.9 0 42.8 0zM38.2 45.2c0 8.2-6.6 14.8-14.8 14.8 -8.2 0-14.8-6.6-14.8-14.8 0-8.2 6.6-14.8 14.8-14.8C31.6 30.4 38.2 37 38.2 45.2zM42.8 16.9l-7.6 5.1v-7.6c0-0.7-0.6-1.3-1.3-1.3 -0.7 0-1.3 0.6-1.3 1.3v9.3l-4.8 3.2c-1.4-0.3-2.9-0.5-4.4-0.5 -1.5 0-3 0.2-4.4 0.5l-4.9-3.2v-9.3c0-0.7-0.6-1.3-1.3-1.3 -0.7 0-1.3 0.6-1.3 1.3v7.5l-7.5-5V4h7.5v3.6c0 0.7 0.6 1.3 1.3 1.3 0.7 0 1.3-0.6 1.3-1.3V4h18.4v3.6c0 0.7 0.6 1.3 1.3 1.3 0.7 0 1.3-0.6 1.3-1.3V4h7.6V16.9z" class="a"></path><path d="M21 34.8l-2.2 4.5L13.8 40c-1 0.1-1.8 0.8-2.1 1.8 -0.3 1-0.1 2 0.7 2.7l3.6 3.5 -0.8 4.9c-0.2 1 0.2 2 1.1 2.6 0.5 0.3 1 0.5 1.6 0.5 0.4 0 0.8-0.1 1.2-0.3l4.4-2.3 4.4 2.3c0.4 0.2 0.8 0.3 1.2 0.3 0.5 0 1.1-0.2 1.6-0.5 0.8-0.6 1.2-1.6 1.1-2.6L30.8 48l3.6-3.5c0.7-0.7 1-1.8 0.7-2.7 -0.3-1-1.1-1.7-2.1-1.8L28 39.2l-2.2-4.5c-0.4-0.9-1.4-1.5-2.4-1.5C22.4 33.3 21.4 33.9 21 34.8zM26.2 41.7l6.3 0.9L27.9 47l1.1 6.3 -5.7-3 -5.7 3 1.1-6.3 -4.6-4.5 6.3-0.9 2.8-5.7L26.2 41.7z" class="a"></path></svg>
						  <h1 class="u-color-blue u-text-bold u-text-size-medium u-display-inline-block u-margin-none">Workout of the Day</h1>
						</div>
						<div class="u-padding-md">
						  <h2 class="u-margin-top-none u-margin-bottom-md u-text-size-large c-link u-color-black">Totally Awesome Body Workout</h2>
						  <svg class="c-icon c--xxlarge u-fill-yellow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 190.6 30.3"><polygon points="17.7 0 22.6 10 33.6 11.6 25.6 19.4 27.5 30.3 17.7 25.2 7.8 30.3 9.7 19.4 1.7 11.6 12.7 10 "></polygon><polygon points="56.9 0 61.8 10 72.9 11.6 64.9 19.4 66.8 30.3 56.9 25.2 47.1 30.3 48.9 19.4 41 11.6 52 10 "></polygon><polygon points="96.2 0 101.1 10 112.1 11.6 104.1 19.4 106 30.3 96.2 25.2 86.3 30.3 88.2 19.4 80.2 11.6 91.2 10 "></polygon><polygon points="135.4 0 140.3 10 151.4 11.6 143.4 19.4 145.3 30.3 135.4 25.2 125.6 30.3 127.4 19.4 119.5 11.6 130.5 10 "></polygon><polygon points="174.7 0 179.6 10 190.6 11.6 182.6 19.4 184.5 30.3 174.7 25.2 164.8 30.3 166.7 19.4 158.7 11.6 169.7 10 "></polygon></svg>    <span class="u-text-size-quiet u-margin-left-md">saved 876 times</span>
						  <div class="u-display-flex u--space-between u-margin-top-lg">
							<a class="c-link u-text-size-small">Quick View</a>
							<a class="c-link u-text-size-small">Save Workout</a>
						  </div>
						</div>
					  </div>       <div class="u-color-bg-white u-width-full u-padding-lg u-box-shadow u-border u-margin-bottom-xxlg">
						  <h4 class="u-margin-top-none u-margin-bottom-none u-line-height-md u-color-blue u-text-size-normal  u-text-bold">Last Workout Completed</h4>
						  <h2 class="u-margin-top-none u-margin-bottom-none u-text-size-large c-link u-color-black">Cardio Death Trap</h2>
						  <a class="c-link u-text-size-small">Quick View</a>
						  <h4 class="u-margin-top-xlg u-margin-bottom-none u-line-height-md u-color-blue u-text-size-normal u-text-bold">Next Workout</h4>
						  <h2 class="u-margin-top-none u-margin-bottom-none u-text-size-large c-link u-color-black">Deadlift Long Workout Name</h2>
						  <a class="c-link u-text-size-small">Quick View</a>
						</div>
					   <div class="u-color-bg-white u-width-full u-padding-lg u-box-shadow u-border u-margin-bottom-xxlg">
						<h4 class="u-margin-top-none u-margin-bottom-sm u-line-height-md">Upcoming Events</h4>
						<ul>
						  <li class="u-color-blue u-margin-bottom-md">A Workout Event</li>
						  <li class="u-color-blue u-margin-bottom-md">A Workout Event</li>
						  <li class="u-color-blue u-margin-bottom-md">A Workout Event</li>
						</ul> 
					  </div>    </div>
				  </div>
			</div>


		</main>

	</body>
</html>
<?php



foreach ($_SESSION as $name => $value)
{
    echo $name."=".$value."<br>";
}
//phpinfo();
?>




