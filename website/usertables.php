<?php
	$a = session_id();
	if(empty($a)) session_start();
    #	echo "SID: ".SID."<br>session_id(): ".session_id()."<br>";

	include("sitedb.php");

	if (isset($_GET['searchname'])) { 
        $searchname = $_GET['searchname'];
     } else {
        $searchname = "";
     }
     # echo "Searchname: ".$searchname."<br>";

    if (isset($_GET['st'])) { 
        $vstart = $_GET['st'];
    } else {
        $vstart = "";
    }
	
    if (isset($_GET['or'])) { 
        $order = $_GET['or'];
	    if (isset($_GET['dir'])) {
	    	if ($_GET['dir'] == "ASC") { 
	           $orderDir = "ASC";
	    	} else {
	    		$orderDir = "DESC";
	    	}
	    } else {
	        $orderDir = "ASC";
	    }
    } else {
        $order = "uid";
        $orderDir = "ASC";
    }
    
    $currPageUrl = "usertables.php?st=$vstart&or=$order&dir=$orderDir";
?>

<html>
<head>
    <title>Site User List</title>
</head>
<body>

    <h1>Site User List</h1>
    <?php
        if (isset($_GET['msg'])) {
           echo "<font color=\"red\">" . $_GET['msg'] . "</font><br/>";
        }
    ?>
    
	<table border="0" cellpadding="2" cellspacing="4" rules="none" >
		<tr>
			<td valign=top>
				<?php
					$voffset = 25;
					
					if ($vstart == "") { 
						$vstart = 0;   	
						$vend = $voffset;
					}
                           ?>
                           <form method="GET" action="usertables.php" name="formsearchname">
                           <?php
					if ($vstart <> 0) {
						# prev allowed
						$pstart = $vstart - $voffset;
						if ($pstart < 0)  $pstart = 0;
						
						?>
                        <input type="button" onClick="self.location.href='usertables.php?st=<?php echo $pstart; ?>&or=<?php echo $order; ?>&dir=<?php echo $orderDir; ?>'" value="Previous page">
						<?php
					}
					
                    $searchname = mysqli_real_escape_string($database, $searchname); 
                    if (strlen($searchname) > 0) {
                       $order="";
                       $orderDir="ASC";
                       $query1 = "select * from users where lastname like '$searchname%' order by lastname $orderDir limit $vstart,$voffset";
                     }
                     else {
                       $query1 = "select * from users where lastname like '$searchname%' order by $order $orderDir, lastname $orderDir limit $vstart,$voffset";
	               }				

				   $result = mysqli_query($database, $query1); 
					
					if (mysqli_num_fields($result) > 0) {

						$querycnt = "select count(*) as cnt from users where lastname like '$searchname%' ";
											  
						$cntresult = mysqli_query($database, $querycnt);
						$thisrow=mysqli_fetch_row($cntresult);
						$cnt= $thisrow[0];
						
						if  ($cnt > ($vstart + $voffset)) {
							# next allowed
							$pstart = $vstart + $voffset;
							
							?>
							<input type="button" onClick="self.location.href='usertables.php?st=<?php echo $pstart; ?>&or=<?php echo $order; ?>&dir=<?php echo $orderDir; ?>'" value="Next page">
							<?php
						}
						?>
                        <input type="button" onClick="self.location.href='index.php'" value="Main Menu">
						<?php
							$i=0;
                        ?>
						&nbsp; Search by Last name: <input type="text" name="searchname" id="searchname" size=10 MAXLENGTH=10 value="" />
						<input type="submit" name="Search" value="Search"/> 
						<?php
							if (strlen($searchname) > 0) {
								echo "<br> &nbsp; Search results for last name starting with '".$searchname."' sorted by last name.";
								echo "<br> &nbsp; Click on Search button with no input to see whole list.";
							}
						?>
						</form>
						<?php
							echo "<table border=0 cellpadding=2 cellspacing=2 rules=none valign=top><tr>";
                    if (strlen($searchname) > 0) {
                     echo "<th>User</th><th nowrap>Last Login</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Created</th><th>Actions</th>";
                     }
                    else
                     {						
						if ($order == "uid" && $orderDir == "ASC") {
                            echo "<th valign=\"bottom\"><a href=\"usertables.php?st=0&or=uid&dir=DESC\">User</a><img src=\"asc_arrow.jpg\" alt=\"Ascending\"/></th>";
						} else {
                            echo "<th><a href=\"usertables.php?st=0&or=uid&dir=ASC\">User</a>";
							if ($order == "uid") {
                                echo "<img src=\"desc_arrow.jpg\" alt=\"Descending\"/>";
							} else {
                              #  echo "<img src=\"blank.jpg\" alt=\"\"/>";
							}
							echo "</th>";
						}

						if ($order == "lastlogin" && $orderDir == "ASC") {
                            echo "<th nowrap valign=\"bottom\"><a href=\"usertables.php?st=0&or=lastlogin&dir=DESC\">Last Login</a><img src=\"asc_arrow.jpg\" alt=\"Ascending\"/></th>";
						} else {
                            echo "<th nowrap><a href=\"usertables.php?st=0&or=lastlogin&dir=ASC\">Last Login</a>";
							if ($order == "lastlogin") {
                                echo "<img src=\"desc_arrow.jpg\" alt=\"Descending\"/>";
							} else {
                              #  echo "<img src=\"blank.jpg\" alt=\"\"/>";
							}
							echo "</th>";
						}
						
						
						if ($order == "firstname" && $orderDir == "ASC") {
                            echo "<th><a href=\"usertables.php?st=0&or=firstname&dir=DESC\">First Name</a><img src=\"asc_arrow.jpg\" alt=\"Ascending\"/></th>";
                        } else {
                            echo "<th><a href=\"usertables.php?st=0&or=firstname&dir=ASC\">First Name</a>";
                            if ($order == "firstname") {
                                echo "<img src=\"desc_arrow.jpg\" alt=\"Descending\"/>";
                            } else {
                           #     echo "<img src=\"blank.jpg\" alt=\"\"/>";
                            }
                            echo "</th>";
                        }
                        
                        if ($order == "lastname" && $orderDir == "ASC") {
                            echo "<th><a href=\"usertables.php?st=0&or=lastname&dir=DESC\">Last Name</a><img src=\"asc_arrow.jpg\" alt=\"Ascending\"/></th>";
                        } else {
                            echo "<th><a href=\"usertables.php?st=0&or=lastname&dir=ASC\">Last Name</a>";
                            if ($order == "lastname") {
                                echo "<img src=\"desc_arrow.jpg\" alt=\"Descending\"/>";
                            } else {
                              #  echo "<img src=\"blank.jpg\" alt=\"\"/>";
                            }
                            echo "</th>";
                        }
                        
                        if ($order == "email" && $orderDir == "ASC") {
                            echo "<th><a href=\"usertables.php?st=0&or=email&dir=DESC\">Email</a><img src=\"asc_arrow.jpg\" alt=\"Ascending\"/></th>";
                        } else {
                            echo "<th><a href=\"usertables.php?st=0&or=email&dir=ASC\">Email</a>";
                            if ($order == "email") {
                                echo "<img src=\"desc_arrow.jpg\" alt=\"Descending\"/>";
                            } else {
                             #   echo "<img src=\"blank.jpg\" alt=\"\"/>";
                            }
                            echo "</th>";
                        }
                        
                         
                        if ($order == "created" && $orderDir == "ASC") {
                        	echo "<th><a style='white-space: nowrap' href=\"usertables.php?st=0&or=created&dir=DESC\">Created</a><img src=\"asc_arrow.jpg\" alt=\"Ascending\"/></th>";
                        } else {
                        	echo "<th><a style='white-space: nowrap' href=\"usertables.php?st=0&or=created&dir=ASC\">Created</a>";
                        	if ($order == "created") {
                        		echo "<img src=\"desc_arrow.jpg\" alt=\"Descending\"/>";
                        	} else {
                        	#	echo "<img src=\"blank.jpg\" alt=\"\"/>";
                        	}
                        	echo "</th>";
                        }
                                                
                        
                        echo "<th></th><th></th>";
                        echo "</tr>";
				 } 
						while ($thisrow=mysqli_fetch_assoc($result))  //get one row at a time
						{
							?>
							<tr align="center" nowrap>
							    <form method="GET" action="usersave.php" name="form<?php echo $thisrow['uid']; ?>">
                                    <td><?php echo $thisrow['uid']; ?><input type="hidden" name="id" value="<?php echo $thisrow['uid']; ?>"/></td>                                    
                                    <td><?php 
                                     $created = $thisrow['created'];
                                    	$lastlogin = $thisrow['lastlogin'];
                                     if ($lastlogin >= $created){
                                       if($lastlogin != '0000-00-00 00:00:00'){
                                    		$lastloginObj = date("Y/m/d", strtotime($lastlogin));
                                    		echo date("m/d/y", strtotime($lastlogin));
							  }
                                    	}
                                    	 
                                    ?><input type="hidden" name="lastlogin" value="<?php echo $thisrow['lastlogin']; ?>"/></td>

                                    <td><input type="text" name="firstname" id="firstname" size=15 MAXLENGTH=40 value="<?php echo $thisrow['firstname']; ?>" /></td>
		                            <td><input type="text" name="lastname" id="lastname" size=15 MAXLENGTH=40 value="<?php echo $thisrow['lastname']; ?>" /></td>
		                            <td><input type="text" name="email" id="email" size=15 MAXLENGTH=40 value="<?php echo $thisrow['email']; ?>" /></td>
									<td><?php 
                                    	$created = $thisrow['created'];
                                    	if($created != '0000-00-00 00:00:00'){
                                    		$createdObj = date("Y/m/d  h:i:s A", strtotime($created));
                                    		echo date("m/d/y h:i:s A", strtotime($createdObj));
                                    	}
                                    	 
                                    ?><input type="hidden" name="created" value="<?php echo $thisrow['created']; ?>"/></td>
		                            <td nowrap><input type="submit" name="Update User" value="Update User"/> &nbsp; </td>
							    </form>
							</tr>
							<!--<tr align="left"><td colspan="2"><hr /></td></tr>-->
							<?php 
						}
				  
						echo "</table>";
				 
						if ($vstart <> 0) {
							# prev allowed
							$pstart = $vstart - $voffset;
							if ($pstart < 0)  $pstart = 0;
					
							?>
							<input type="button" onClick="self.location.href='usertables.php?st=<?php echo $pstart; ?>&or=<?php echo $order; ?>&dir=<?php echo $orderDir; ?>'" value="Previous page">
							<?php
						}

						if  ($cnt > ($vstart + $voffset)) {
							# next allowed
							$pstart = $vstart + $voffset;
							?>
							<input type="button" onClick="self.location.href='usertables.php?st=<?php echo $pstart; ?>&or=<?php echo $order; ?>&dir=<?php echo $orderDir; ?>'" value="Next page">
							<?php
						}
                        ?>
						<input type="button" onClick="self.location.href='index.php'" value="Main Menu">
						<?php 
					}
					# Database cleanup
					mysqli_free_result($result);
					mysqli_close($database);

				?>
			</td>
		</tr>
	</table>
</body>
</html>


