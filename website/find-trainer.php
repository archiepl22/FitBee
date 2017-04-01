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
  <h1>Find a Trainer</h1>
</div>
<div class="t-main">
<h1>Search</h1>

  <div class="c-search">
    <form>
      <div class="c-search__keywords">
        <label class="u-color-blue u-text-bold" for="keywords">Keywords</label>
        <input type="text" id="keywords" placeholder="e.g. Trainer, Group, Cardio">
      </div>
      <div class="c-search__filters c-grid__row u-display-flex u--align-center u-margin-top-none">
        <div class="c-grid__col3">
          <span>Category</span>
          <select name="category">
            <option value="any">Any</option> 
            <option value="crossfit">Crossfit</option> 
            <option value="sport-specific">Sport Specific</option>
            <option value="bodyweight">Bodyweight</option>
            <option value="cardio">Cardio</option> 
            <option value="free Weights">Free Weights</option>
            <option value="hiit">HIIT</option>
            <option value="strength training">Strength Training</option>
            <option value="body building">Body Building</option>
          </select>
        </div>
        <div class="c-grid__col3">
          <span>Difficulty</span>
          <select name="difficulty">
            <option value="all">All</option> 
            <option value="beginner">Beginner</option> 
            <option value="intermediate">Intermediate</option>
            <option value="pro">Pro</option>
          </select>
        </div>
        <div class="c-grid__col4">
          <span class="u-color-blue u-text-bold u-margin-right-md">Sort by</span>
          <input type="radio" name="sort" value="popularity" id="popularity">
          <label for="popularity">Popularity</label>
          <input type="radio" name="sort" value="rating" id="rating">
          <label for="popularity">Rating</label>
          <input type="radio" name="sort" value="newest" id="newest">
          <label for="popularity">Newest</label>
        </div>
        <div class="c-grid__col2">
          <button type="submit" class="c-button c--primary">Search</button>
        </div>
      </div>
    </form>
  </div>
  

  <h2>Results</h2>

    <article class="c-person">
      <div class="c-person__buttons">
        <button class="c-button c--primary u-margin-right-lg">Yes, I'm interested</button>
        <button class="c-button c--ghost">No, skip</button>
      </div>
    
      <div class="u-position-relative u-padding-lg">
        <div class="c-person__profile">
          <div class="c-person__image">
            <img src="./find-trainer_files/profile-pic.jpg">
          </div>
          <div class="c-person__details">
            <h1 class="u-text-bold u-color-blue u-text-size-medium u-margin-none">User Name</h1>
            <p class="u-margin-none u-margin-top-sm">Bacon ipsum dolor amet corned beef picanha porchetta tenderloin, pastrami tongue leberkas biltong 100 char max</p>
            <div class="u-text-bold u-display-flex u--space-between u--align-flex-end u-margin-top-xlg">
              <div>Crossfit</div>
              <div><span class="u-color-blue u-text-size-mobile u-display-block">Live</span>$55/Session</div>
              <div><span class="u-color-blue u-text-size-mobile u-display-block">Virtual</span>$20/Session</div>
            </div>
          </div>
        </div>
        <div class="c-person__stats">
          <span class="u-text-bold u-color-grey">Active</span>
          <span class="u-text-bold u-color-grey">Los Angeles</span>
          <span class="u-text-bold u-color-grey">Evenings, Weekends</span>
        </div>
      </div>
    </article>
    <article class="c-person">
      <div class="c-person__buttons">
        <button class="c-button c--primary u-margin-right-lg">Yes, I'm interested</button>
        <button class="c-button c--ghost">No, skip</button>
      </div>
    
      <div class="u-position-relative u-padding-lg">
        <div class="c-person__profile">
          <div class="c-person__image">
            <img src="./find-trainer_files/profile-pic.jpg">
          </div>
          <div class="c-person__details">
            <h1 class="u-text-bold u-color-blue u-text-size-medium u-margin-none">User Name</h1>
            <p class="u-margin-none u-margin-top-sm">Bacon ipsum dolor amet corned beef picanha porchetta tenderloin, pastrami tongue leberkas biltong 100 char max</p>
            <div class="u-text-bold u-display-flex u--space-between u--align-flex-end u-margin-top-xlg">
              <div>Crossfit</div>
              <div><span class="u-color-blue u-text-size-mobile u-display-block">Live</span>$55/Session</div>
              <div><span class="u-color-blue u-text-size-mobile u-display-block">Virtual</span>$20/Session</div>
            </div>
          </div>
        </div>
        <div class="c-person__stats">
          <span class="u-text-bold u-color-grey">Active</span>
          <span class="u-text-bold u-color-grey">Los Angeles</span>
          <span class="u-text-bold u-color-grey">Evenings, Weekends</span>
        </div>
      </div>
    </article>
    <article class="c-person">
      <div class="c-person__buttons">
        <button class="c-button c--primary u-margin-right-lg">Yes, I'm interested</button>
        <button class="c-button c--ghost">No, skip</button>
      </div>
    
      <div class="u-position-relative u-padding-lg">
        <div class="c-person__profile">
          <div class="c-person__image">
            <img src="./find-trainer_files/profile-pic.jpg">
          </div>
          <div class="c-person__details">
            <h1 class="u-text-bold u-color-blue u-text-size-medium u-margin-none">User Name</h1>
            <p class="u-margin-none u-margin-top-sm">Bacon ipsum dolor amet corned beef picanha porchetta tenderloin, pastrami tongue leberkas biltong 100 char max</p>
            <div class="u-text-bold u-display-flex u--space-between u--align-flex-end u-margin-top-xlg">
              <div>Crossfit</div>
              <div><span class="u-color-blue u-text-size-mobile u-display-block">Live</span>$55/Session</div>
              <div><span class="u-color-blue u-text-size-mobile u-display-block">Virtual</span>$20/Session</div>
            </div>
          </div>
        </div>
        <div class="c-person__stats">
          <span class="u-text-bold u-color-grey">Active</span>
          <span class="u-text-bold u-color-grey">Los Angeles</span>
          <span class="u-text-bold u-color-grey">Evenings, Weekends</span>
        </div>
      </div>
    </article></div>
  </main>
</body></html>