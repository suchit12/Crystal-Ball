<!DOCTYPE html>
<html>
    <head>
   		<link rel="stylesheet" type="text/css" href="../css/webpage.css">    
    </head>
    <body>
    	<p id="box"></p>
    	<div id= "container">
	       <div class="header">
					<div class="headerlist">
						<h2 id="name">Crystal Ball</h2>
						<ul>
							<li><a href="schedule.php">schedule</a></li>
							<li><a href="">inventory</a></li>
							<li><a href="">staging</a></li>
							<li><a href="">terminal</a></li>
						</ul>
					</div>
						<img id="udpic" src="../images/start.jpg"/>
						<form id="searchbar" action="index.php" method="post">
				    		<input id="search" name = "search" type="text" placeholder="Search..." maxlength="200">
				    		<input type="submit" id="submit" value="&#128269">
    					</form>
			</div>
			<?php 
		session_start();
		
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
		$results_per_page = 2;
		if(isset($_POST['search'])){
			$sam = $_POST['search'];
		} 
		
		// find out the number of results stored in database
		$sql= "SELECT * FROM production_servers WHERE ServerName OR Application LIKE '%$sam%'";
		$result = mysqli_query($con, $sql);
		$number_of_results = mysqli_num_rows($result);
		
		// determine number of total pages available
		$number_of_pages = ceil($number_of_results/$results_per_page) ;

		// determine which page number visitor is currently on
		if (!isset($_GET['page'])) {
		  $page = 1;
		} else {
		  $page = ( !empty( $_GET['page'] ) ) ? ( (int)$_GET['page'] ) : ( 1 );
		}
		
		// determine the sql LIMIT starting number for the results on the displaying page
		$this_page_first_result = ($page-1)*$results_per_page;
		
		// retrieve selected results from database and display them on page
		$query = "SELECT * FROM production_servers WHERE Application OR ServerName LIKE '%$sam%' LIMIT $this_page_first_result, $results_per_page ";
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
		$row['Version'] . '</td><td alighn="left" class="odd">' . 
		$row['PreviousUpdate'] . '</td></tr>';
		}
		 
		echo '</table></div>';
		
		}
		else{
			echo 'Could not connect';
		}
		
		// for ($page=1;$page<=$number_of_pages;$page++) {
			// echo '<a class="numbers" href="getinfo.php?q='. $sam.'& page= '. $page . '">' . $page . '</a> ';
		// }
		$links = 1;
		
		if(isset($_GET['color'])){
			$class1 = "active";
		} else {
			$color = "";
		}
		
		$last = ceil( $number_of_results / $results_per_page );
		$html = '<ul class="list">';
		
		$start = ( ( $page - $links ) > 0 ) ? $page - $links : 1;
		$end = ( ( $page + $links ) < $last ) ? $page + $links : $last;

		$class = ( $page == 1 ) ? "disabled" : "";
		$previous_page = ( $page == 1 ) ? '<a><li id="first" class="' . $class . '">&laquo;</li></a>' : '<li class="' . $class . '"><a href="?q='. $sam .'&page=' . ( $page - 1 ) . '">&laquo;</a></li>';
		$html .= $previous_page;
		
		//code for pagination with number
		// if ( $start >= 2  ) {
			// $html .= '<li><a href="?limit=' . $results_per_page . '&page=1">1</a></li>';
			// $html .= '<li><span id="middle"><a>...</a><span></li>';
		// }
		// for ( $i = $start ; $i <= $end; $i++ ) {
			// $class1 = ( $page == $i ) ? "active" : "";	
			// if($page == $i)
				// $html .= '<li class="active"><a href="?q='. $sam.'& page='. $i .'"><strong>' . $i . '</strong></a></li>'; 
			// else
				// $html .= '<li><a href="?q='. $sam.'& page='. $i .'">' . $i . '</a></li>';
		// }
			
		// if ( $end < $last ) {
			// $html .= '<li><span><a>...</a></span></li>';
			// $i = $page - 1;  
			// $html .= '<li><a href="?q='. $sam .'&page=' . $last . '">' . $last . '</a></li>';
		// }
		$class = ( $page == $last ) ? "disabled" : "";
		
		$next_page = ( $page == $last) ? '<li id="last" class=" ' . $class . '"><a>&raquo;</a></li>' : '<li class="' . $class . '"><a href="?q='. $sam .'&page=' . ( $page + 1 ) . '">&raquo;</li>';		
		$html .= $next_page; 
		$html .= '</ul>';
		echo $html;
		
		
        // echo '$results_per_page: '.$results_per_page.' | '; //total rows per query
        // echo '$start: '.$start.' | '; //start printing links from
        // echo '$end: '.$end.' | '; //end printing links at
        // echo '$last: '.$last.' | '; //last page
        // echo '$page: '.$page.' | '; //current page
        // echo '$links: '.$links.' <br /> '; //links 
		
		mysqli_close($dbc);
		?>
			<div id="lowerpic">
						<img src="../images/pic1.jpg" border="0" width="32.9%"/>
						<img id = "two" src="../images/office.jpg" border="0" width="37%"/>
						<img id = "three" src="../images/table.jpg" border="0" width="426px" height="333px"/>						
			</div>
			<div class = "production">
				<p> Servers for </p>
				<p> Production </p>
			<div>
		</div>
    </body>
</html>
