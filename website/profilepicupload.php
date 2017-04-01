<?php
	include("sandt_li.php");
	foreach ($_POST as $name => $value) { echo $name."=".$value."<br>"; }
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

	<?php
		$dashboard = 0;
		include("header_li_dashboard.php");
			
		error_reporting(0);

		$change = "";
		$errors = 0;
		define ("MAX_SIZE","200");
		define ("MAX_W","400");
		define ("MAX_H","400");
		
		function getExtension($str) {
			$i = strrpos($str,".");
			if (!$i) { return ""; }
			$l = strlen($str) - $i;
			$ext = substr($str,$i+1,$l);
			return $ext;
		}

	  
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$image = $_FILES["file"]["name"];
			$uploadedfile = $_FILES['file']['tmp_name'];
		 
			if ($image) {
				$filename = stripslashes($_FILES['file']['name']);
				$extension = getExtension($filename);
				$extension = strtolower($extension);
			
				if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "pngpng") && ($extension != "gif")) {
					$change = '<div class="msgdiv">Unknown Image extension </div> ';
					$errors = 1;
				}
				else {
					$size = filesize($_FILES['file']['tmp_name']);
					if ($size > MAX_SIZE*1024) {
						$change = '<div class="msgdiv">You have exceeded the size limit!</div> ';
						$errors = 1;
					}

					if($extension=="jpg" || $extension=="jpeg" ){
						$uploadedfile = $_FILES['file']['tmp_name'];
						$src = imagecreatefromjpeg($uploadedfile);
					}
					else if ($extension=="pngpng") {
						$uploadedfile = $_FILES['file']['tmp_name'];
						$src = imagecreatefrompng($uploadedfile);
					}
					else {
						$src = imagecreatefromgif($uploadedfile);
					}
					#echo $src;

					list($width, $height) = getimagesize($uploadedfile);

					$newwidth = MAX_W;
					$newheight = ($height/$width) * $newwidth;
					
					$newwidthX = MAX_W;
					$newheightX = ($height/$width) * $newwidthX;
					if ($newheightX > MAX_H) {
						$newheight = MAX_H;
						$newwidth = ($newwidthX / $newheightX) * $newheight;
					} else {
						$newheight = $newheightX;
						$newwidth = $newwidthX; 
					} 
					$tmp = imagecreatetruecolor($newwidth, $newheight);

					imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

					//$userid = $_POST['userid'];
					$picture = sprintf("%08d", $uid);
					$filename = "profiles/".$picture.".".$extension; //. $_FILES['file']['name'];
					$fndb =        "blogimages/".$blogid.".".$extension; //. $_FILES['file']['name'];
					#echo "<br>$filename<br>";

					if($extension=="jpg" || $extension=="jpeg" ){
						imagejpeg($tmp, $filename, 100);
					}
					else if ($extension=="png") {
						imagepng($tmp, $filename, 100);
					}
					else {
						imagegif($tmp, $filename, 100);
					}

					#imagejpeg($tmp, $filename, 100);

					imagedestroy($src);
					imagedestroy($tmp);

											
					$query1 = "update profiles set profileimagetype = '.$extension' where uid = $uid";
					#$result = mysql_db_query($database, $query1) ;
					#echo "<br>query =  $query1 <br>";
							
							if (mysqli_query($database, $query1)) {
								mysqli_close($database);
							} else {
								#echo "<br>" . mysqli_error($database);
							}

				}
			}
		}

		if (isset($_POST['Submit']) && (isset($_FILES["file"]["size"]) && ($_FILES["file"]["size"] <= 0)) ){
			$change='*** No file ***';
			$errors = 1;
		}

		//If no errors registered, print the success message
		if(isset($_POST['Submit']) && !$errors) {
			$change = ' <div class="msgdiv">Image Uploaded Successfully! <br>Browse and upload a new image if you would like to replace. <br>Click close to return to program <input type="button" value="Close"
	onclick="window.close()"></div>';
		}
	 
	?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
	
	<style type="text/css">
		.help {
			font-size:11px; color:#006600;
		}
			
		body {
			background-color:#999999 ;
		}
		
		.msgdiv {
			width:759px;
			padding-top:8px;
			padding-bottom:8px;
			background-color: #fff;
			font-weight:bold;
			font-size:18px;-moz-border-radius: 6px;-webkit-border-radius: 6px;
		}
		
		#container{width:763px;margin:0 auto;padding:3px 0;text-align:left;position:relative; -moz-border-radius: 6px;-webkit-border-radius: 6px; background-color:#FFFFFF }
	</style>


	<body>
		<br><br><br><br>
		<div class="c-hero c--blue">
			<h1>Profile Picture Upload</h1>
		</div>

	<div id="container" >
		<div id="con">
			<table width="502" cellpadding="0" cellspacing="0" id="main">
				<tbody>
				<tr><td align="center"><?php echo $change; ?></td></tr>
				<tr>
					<td width="500" height="238" valign="top" id="main_right">
						<div id="posts">
							&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo $filename; ?>" />
						<?php
							$picture = sprintf("%08d", $uid);
							#echo "<br>profiles/$picture.$extension";
							if (file_exists("profiles/$picture.$extension")) {
								#echo "<br><br>filename = $filename <br><br>";
						?>
								<img src="profiles/<?php echo$picture.$extension;?>" >
						<?php 
							} 
						?>
							<form method="post" action="" enctype="multipart/form-data" name="form1">
								<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
									<tr><td style="height:25px">&nbsp;</td></tr>
									<tr>
										<td width="150"><div align="right" class="titles">Picture: </div></td>
										<td width="350" align="left">
											<div align="left">
												<input size="25" name="file" type="file" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10pt" class="box"/>
											</div>
										</td>
									</tr>
									<tr>
										<td></td>
										<td valign="top" height="35px" class="help">Image maximum size <b>100kb</span></td>
									</tr>
									<tr>
										<td></td>
										<td valign="top" height="35px"><input type="submit" id="mybut" value="       Upload        " name="Submit"/></td>
									</tr>
									<tr>
										<td width="400">&nbsp;</td>
										<td width="400">
											<table width="200" border="0" cellspacing="0" cellpadding="0">
												<tr>
													<td width="200" align="center"><div align="left"></div></td>
													<td width="100">&nbsp;</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</form>
						</div>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>
