<?php
		require_once('./mysqli_connect.php');

		$con = mysqli_connect('localhost','root','manchester2002');
		mysqli_select_db($con, 'production_machines');
		  
		// Get prev & next month
		if (isset($_GET['ym'])) {
			$ym = $_GET['ym'];
		} else {
		// This month
			$ym = date('Y-m-j');
		}
		  
		// Check format
		$timestamp = strtotime($ym,"-01");
		if ($timestamp == false) {
			$timestamp = time();
		}
		  
		// Today
		$today = date('Y-m-j', time());
		  
		// For H3 title
		$html_title = date('Y / m', $timestamp);
		  
		// Create prev & next month link     mktime(hour,minute,second,month,day,year)
		$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
		$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
		
		$a = explode("-", $prev);
		$month = (int)($a[1]) + 1;
		  
		// Number of days in the month
		$day_count = date('t', $timestamp);
		  
		// 0:Sun 1:Mon 2:Tue ...
		$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
		  
		  
		// Create Calendar!!
		$weeks = array();
		$week = '';
		$response = @mysqli_query($dbc, $sql);
		  
		// Add empty cell
		$week .= str_repeat('<td></td>', $str);
		  
		for ( $day = 1; $day <= $day_count; $day++, $str++) {
			$sql= "SELECT * FROM tickets WHERE Month = '$month' AND Day = '$day'";
			$result = mysqli_query($con, $sql);
			$number_of_results = mysqli_num_rows($result);
			
			
			if($number_of_results >= 1){
				while($row = mysqli_fetch_array($result)){
					if ($today == $ym) {
						$week .= '<td class="today"><a href="#" class="show-option" title="'. 'Ticket #: '. $row['TicketNumber']. ' Description: '. $row['Description'] .'"><i class="">'.$day;
					} else {
						$week .= '<td><a href="#" class="show-option" title="'. 'Ticket #: '. $row['TicketNumber']. ' Description: '. $row['Description'] .'"><i class="">'.$day;
				}
			  }
			} else {
				$week .= '<td><a href="#" class="show-option" title="No Tickets"><i class="">'.$day;
			}

			$week .= '</i></a></td>';
			 
			// End of the week OR End of the month
			if ($str % 7 == 6 || $day == $day_count) {
				 
				if($day == $day_count) {
					// Add empty cell
					$week .= str_repeat('<td></td>', 6 - ($str % 7));
				}
				 
				$weeks[] = '<tr>'.$week.'</tr>';
				 
				// Prepare for new week
				$week = '';
				 
			}
		  
		}
		  
?>
<!DOCTYPE html>
<html>
    <head>
   		<link rel="stylesheet" type="text/css" href="../css/schedule.css">  
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script>
		$(function() {
		$( ".show-option" ).tooltip({
			show: {
			effect: "slideDown",
			delay: 100
			}
		});
	});
		</script>
    </head>
    <body>
    	<p id="box"></p>
    	<div id= "container">
	       <div class="header">
					<div class="headerlist">
						<h2 id="name">Crystal Ball</h2>
						<ul>
							<li><a href="./php/schedule.php">schedule</a></li>
							<li><a href="">inventory</a></li>
							<li><a href="">staging</a></li>
							<li><a href="">terminal</a></li>
							<li id="home"><a href="../index.php">home</a></li>
						</ul>
					</div>
						<img id="udpic" src="../images/beach.jpg"/>
					
					<div class="container">
					<h3><a class="sam" href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a class="sam" href="?ym=<?php echo $next; ?>">&gt;</a><a id="mess">Releases</a></h3> 
					<br>
					<table class="table table-bordered">
						<tr>
							<th>Su</th>
							<th>M</th>
							<th>T</th>
							<th>W</th>
							<th>T</th>
							<th>F</th>
							<th>Sa</th>
						</tr>
						<?php
							foreach ($weeks as $week) {
								echo $week;
							}   
						?>
					</table>
				</div>
			</div>
		</body>
	</html>