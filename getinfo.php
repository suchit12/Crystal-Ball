<!DOCTYPE html>

<html>
    <head>
   		<link rel="stylesheet" type="text/css" href="webpage.css">  
		<script src="js/"> </script>
		<script src=""> </script>
		<script src=""> </script>
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
			<?php session_start();
		// Get a connection for the database
		require_once('./mysqli_connect.php');
		
		if(isset($_GET['q'])){
			$sam = $_GET['q'];
		} else{
			$sam = "";
		}	
			
		// Create a query for the database
		$con = mysqli_connect('localhost','root','manchester2002');
		mysqli_select_db($con, 'production_machines');
		
		// define how many results you want per page
		$results_per_page = 5;
		if(isset($_POST['search'])){
			$sam = $_POST['search'];
		} 
		
		// find out the number of results stored in database
		$sql= "SELECT * FROM production_servers WHERE ServerName LIKE '%$sam%'";
		$result = mysqli_query($con, $sql);
		$number_of_results = mysqli_num_rows($result);
		
		// determine number of total pages available
		$number_of_pages = ceil($number_of_results/$results_per_page);

		// determine which page number visitor is currently on
		if (!isset($_GET['page'])) {
		  $page = 1;
		} else {
		  $page = ( !empty( $_GET['page'] ) ) ? ( (int)$_GET['page'] ) : ( 1 );
		}
		
		// determine the sql LIMIT starting number for the results on the displaying page
		$this_page_first_result = ($page-1)*$results_per_page;
		
		// retrieve selected results from database and display them on page
		$query = "SELECT * FROM production_servers WHERE ServerName LIKE '%$sam%' LIMIT $this_page_first_result, $results_per_page ";
		$result = mysqli_query($con, $query);
		
		// Get a response from the database by sending the connection
		// and the query
		$response = @mysqli_query($dbc, $query);
		 
		// If the query executed properly proceed

		if($response){
		 
		echo '<div id = "tablet"><table align="left"
		cellspacing="2" cellpadding="8" overflow = "auto" height: "15em" cellpadding-right= "7" id="table">
		 
		<tr><td align="left" class="even" id="edge"><b>Server Name</b></td>
		<td align="left" class="odd"><b>Application</b></td>
		<td align="left" class="even"><b>Version</b></td>
		<td align="left" class="odd" id="edge1"><b>Previous Update</b></td></tr>';
		 
		// mysqli_fetch_array will return a row of data from the query
		// until no further data is available

		while($row = mysqli_fetch_array($response)){
		 
		echo '<tr><td align="left" class="even">' . 
		$row['ServerName'] . '</td><td align="left" class="odd">' . 
		$row['Application'] . '</td><td align="left" class="even">' . 
		$row['Version'] . '</td><td class="odd">' . 
		$row['PreviousUpdate'] . '</td></tr>';
		}
		 
		echo '</table></div>';
		
		}
		else{
			echo 'Could not connect';
		}
		
		$limit = 2;
		$links = 3;
		
		$last = ceil( $number_of_results / $limit );
		$html = '<ul class="list">';
		
		$start = ( ( $page - $links ) > 0 ) ? $page - $links : 1;
		$end = ( ( $page + $links ) < $last ) ? $page + $links : $last;

		$class = ( $page == 1 ) ? "disabled" : "";
		$previous_page = ( $page == 1 ) ? '<a href=""><li class="' . $class . '">&laquo;</a></li>' : '<li class="' . $class . '"><a href="?limit=' . $limit . '&page=' . ( $page - 1 ) . '">&laquo;</a></li>';
		if ( $start > 1 ) {
			$html .= '<li><a href="?limit=' . $limit . '&page=1">1</a></li>';
			$html .= '<li class="list"><span><a>...</a></span></li>';
		}
		$f = 0;
		for ( $i = $start ; $i <= $end; $i++ ) { 
			$class = ( $page == $i ) ? "active" : ""; 
			//highlight current page 
			$html .= '<li class="' . $class . '"><a href="?q='. $sam.'& page='. $i . 'limit=' . $limit . '">' . $i . '</a></li>'; 
			$f = $i;
		}
			
		if ( $end < $last ) {
			$html .= '<li class="list"><span><a>...</a></span></li>';
			$i = $page - 1;  
			$html .= '<li><a href="?q='. $sam .'&page=' . $last . '">' . $last . '</a></li>';
		}
		$class = ( $page == $last ) ? "disabled" : "";
		
		$next_page = ( $page == $last) ? '<li id="last" class="' . $class . '"><a href= "">&raquo;</a></li>' : '<li class="' . $class . '"><a href="?q='. $sam .'&page=' . ( $page + 1 ) . '">&raquo;</li>';		
		$html .= $next_page; 
		$html .= '</ul>';
		echo $html;
		
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