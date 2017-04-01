<?php
	include("sandt_li.php");
//	echo "<br><br><br><br><br><br><br><br>";
//	foreach ($_POST as $name => $value) { echo $name."=".$value."<br>"; }	
	//foreach ($_SESSION as $name => $value) {echo $name."=".$value."<br>";}	
	
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link href="css" rel="stylesheet">
		<script src="jquery.min.js.download"></script>
		<script src="jquery-ui.min.js.download"></script>
		<script src="header.js.download"></script>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>

		<?php
			$success = 0;
			$namelonger = "";
			
			if (isset($_POST['cgroupb']) == "cgroupb") {
				if (isset($_POST['groupname'])) {$groupname = $_POST['groupname']; }
				if (isset($_POST['grouppurpose'])) {$grouppurpose = $_POST['grouppurpose']; }
				if (isset($_POST['grouplocation'])) {$grouplocation = $_POST['grouplocation']; }

				if ((strlen($groupname) > 9)) {
					$query = "insert into groups set groupname='$groupname', grouppurpose='$grouppurpose', grouplocation='$grouplocation', ownerid=$uid ";
					//$result = mysqli_query($database, $query);

					if (mysqli_query($database, $query)) {
						$id = mysqli_insert_id($database);
						$query = "insert into users2groups set uid=$uid, gid=$id, admin=1";
						$result = mysqli_query($database, $query);
						$success = 1;
					}	
					//echo "Error: " . $query . "<br>" . mysqli_error($database);
				} else {
					$namelonger = "Name needs to be longer: ";
				}
			}
			
			$dashboard = 1;
			include("header_li_dashboard.php");
			
		?>
	  
		<main>
      <div class="t-dash t-group">

  <div class="t-group__init-wrapper u-padding-sides-xlg u-padding-top-xxlg">
      <div class="c-heading u-padding-none u-display-flex u--align-center u-margin-bottom-xxlg">
        <h1 class="u-margin-none">Groups</h1>
      </div>
    <p>**** WHERE CAN I FIND OUT WHAT GROUPS EXIST???  Is it this page???</p>
	<p>**** Some short blurb about what groups do and what they're for. </p>
	
	<P>**** Think we also need a group profile page or to add some elements to the group page and allow an admin to edit the profile including adding the picture there instad of group creation.</p>

	<p>**** I decided to automatically open the create group but can change it back. </p>
	
    <a href="" class="c-link c--blue js-accordion-trigger u-margin-top-xxlg u-display-block">Create a New Group</a>
<!--    <div class="js-accordion" style="display: block;">-->
    <div style="display: block;">
	  <form  name="cgroup" id="cgroup" action="groups.php" method="post" >
	
		<?php
			if ($success == 1) { ?>
				<div class="u-margin-top-xlg">
					<span class="u-color-orange u-text-size-mobile u-margin-left-md">
						<?php echo $groupname; ?> Created.
					</span>
				</div>
			<?php	
			}
		?>	
	  
        <div class="u-margin-top-xlg">
          <label>Group name</label><span class="u-color-orange u-text-size-mobile u-margin-left-md"><?php echo $namelonger; ?> * Required (minimum 10 characters)</span>
          <input name="groupname" id="groupname" type="text" placeholder="Group name" class="t-group__input u-margin-top-sm">
        </div>
        <div class="u-margin-top-xlg">
          <label>Group location</label>
          <input  name="grouplocation" id="grouplocation" type="text" placeholder="Group location" class="t-group__input u-margin-top-sm">
        </div>
        <label class="u-margin-top-xlg u-display-block">Group Purpose</label>
        <textarea  name="grouppurpose" id="grouppurpose" placeholder="E.g. Baseball team page to keep track of workouts." class="u-margin-top-sm"></textarea>
        <!--<div class="c-share__label u-display-inline-block u-text-bold u-color-blue u-margin-top-xxlg">
          <svg class="c-icon c--small u-fill-blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.2 8"><path d="M8.3 1.1H8V0.6C8 0.3 7.8 0 7.5 0H5.6C5.2 0 5 0.3 5 0.6v0.5H0.9C0.4 1.1 0 1.5 0 1.9v4.2C0 6.6 0.4 7 0.9 7h1.7c0.5 0.6 1.2 1 2 1 0.8 0 1.6-0.4 2-1h1.7c0.5 0 0.9-0.4 0.9-0.9V1.9C9.2 1.5 8.8 1.1 8.3 1.1zM5.6 0.6h1.9v0.5H5.6V0.6zM4.6 7.4c-1.1 0-2-0.9-2-2 0-1.1 0.9-2 2-2 1.1 0 2 0.9 2 2C6.6 6.6 5.7 7.4 4.6 7.4zM8.3 6.5H7c0.1-0.3 0.2-0.6 0.2-1C7.2 4 6 2.9 4.6 2.9 3.2 2.9 2 4 2 5.5c0 0.4 0.1 0.7 0.2 1H0.9c-0.2 0-0.3-0.1-0.3-0.3V2.5h5.9c0.1 0 0.2-0.1 0.2-0.2S6.6 2.1 6.5 2.1H0.6V1.9c0-0.2 0.1-0.3 0.3-0.3h7.4c0.2 0 0.3 0.1 0.3 0.3v0.1h-1c-0.1 0-0.2 0.1-0.2 0.2s0.1 0.2 0.2 0.2h1v3.7C8.6 6.3 8.5 6.5 8.3 6.5z"></path><path d="M6 4.9c0-0.1-0.2-0.1-0.3-0.1C5.6 4.8 5.6 4.9 5.6 5c0.1 0.1 0.1 0.3 0.1 0.4 0 0.6-0.5 1.1-1.1 1.1S3.5 6.1 3.5 5.5c0-0.6 0.5-1.1 1.1-1.1 0.1 0 0.3 0 0.4 0.1 0.1 0 0.2 0 0.3-0.1 0-0.1 0-0.2-0.1-0.3C5 4 4.8 4 4.6 4 3.8 4 3.1 4.6 3.1 5.5c0 0.8 0.7 1.5 1.5 1.5 0.8 0 1.5-0.7 1.5-1.5C6.1 5.3 6 5.1 6 4.9z"></path><circle cx="4.6" cy="5.5" r="0.5"></circle></svg>
          Add Cover Photo
        </div>-->
        <button id="cgroupb" name="cgroupb" value="cgroupb" type="submit" class="c-button c--primary u-display-block u-margin-top-xxlg u-margin-left-auto">Create</button>
      </form>
    </div>
  </div>
</div>

	</body>
</html>