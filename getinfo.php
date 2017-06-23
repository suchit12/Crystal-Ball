
<!DOCTYPE html>
<html>
    <head>
   		<link rel="stylesheet" type="text/css" href="webpage.css">    
    </head>
    <body>
    	<p id="box"></p>
    	<div id= "container">
	       <div class="header">
					<div class="headerlist">
						<h2 id="name">Crystal Ball</h2>
						<ul>
							<li id="home"><a href="">home</a></li>
							<li><a href="">inventory</a></li>
							<li><a href="">staging</a></li>
						</ul>
					</div>
						<img id="udpic" src="poppy.jpg"/>
						<form id="searchbar" action="getinfo.php" method="post">
				    		<input id="search" name = "search" type="text" placeholder="Search..." maxlength="200">
				    		<input type="submit" id="submit" value="&#128269">
    					</form>
			</div>
			<?php
		// Get a connection for the database
		require_once('./mysqli_connect.php');
		$sam = '';
		 
		// Create a query for the database
		
		if(isset($_POST['search'])){
			$sam = $_POST['search'];
		}
		$query = "SELECT * FROM production_servers WHERE ServerName LIKE '$sam%' ";

		// Get a response from the database by sending the connection
		// and the query
		$response = @mysqli_query($dbc, $query);
		 
		// If the query executed properly proceed
		if($response){
		 
		echo '<table align="left"
		cellspacing="2" cellpadding="8" cellpadding-right= "7" id="table">
		 
		<tr><td align="left" class="even"><b>Server Name</b></td>
		<td align="left" class="odd"><b>Application</b></td>
		<td align="left" class="even"><b>Package</b></td>
		<td align="left" class="odd"><b>Previous Update</b></td></tr>';
		 
		// mysqli_fetch_array will return a row of data from the query
		// until no further data is available

		while($row = mysqli_fetch_array($response)){
		 
		echo '<tr><td align="left" class="even">' . 
		$row['ServerName'] . '</td><td align="left" class="odd">' . 
		$row['Application'] . '</td><td align="left" class="even">' . 
		$row['Package'] . '</td><td class="odd">' . 
		$row['PreviousUpdate'] . '</td></tr>';
		}
		 
		echo '</table>';
		 
		} else {
		 
		echo "Couldn't issue database query<br />";
		 
		echo mysqli_error($dbc);
		 
		}
		 
		// Close connection to the database
		mysqli_close($dbc);
		?>
			<div id="lowerpic">
						<img src="pond.jpg" border="0" width="33%" height = "50%"/>
						<img src="snow.jpg" border="0" width="33%"/>
						<img src="valley.jpg" border="0" width="33%"/>
			</div>
		</div>
    </body>
</html>