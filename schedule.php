<?php
// Set your timezone!!
  
// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}
  
// Check format
$timestamp = strtotime($ym,"-01");
if ($timestamp === false) {
    $timestamp = time();
}
  
// Today
$today = date('Y-m-j', time());
  
// For H3 title
$html_title = date('Y / m', $timestamp);
  
// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
  
// Number of days in the month
$day_count = date('t', $timestamp);
  
// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
  
  
// Create Calendar!!
$weeks = array();
$week = '';
  
// Add empty cell
$week .= str_repeat('<td></td>', $str);
  
for ( $day = 1; $day <= $day_count; $day++, $str++) {
     
    $date = $ym.'-'.$day;
     
    if ($today == $date) {
        $week .= '<td class="today">'.$day;
    } else {
        $week .= '<td>'.$day;
    }
    $week .= '</td>';
     
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
   		<link rel="stylesheet" type="text/css" href="schedule.css">  
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
		<style>
		
        .container {
            font-family: 'Noto Sans', sans-serif;
            margin-top: -750px;
			background-color: white;
			z-index: 5;
        }
        th {
            height: 30px;
            font-weight: 700;
        }
        td {
            height: 100px;
			border: 3px solid #607d8b;
        }
        .today {
            background: orange;
        }
		.header{
			font-family: Futura, "Trebuchet MS", Arial, sans-serif;
		}
		#name{
			font-family: Futura, "Trebuchet MS", Arial, sans-serif;
		}
		#mess{
			margin-left: 50px;
			text-decoration: none;
			color: #555656;
		}
    </style>
    </head>
    <body>
    	<p id="box"></p>
    	<div id= "container">
	       <div class="header">
					<div class="headerlist">
						<h2 id="name">Crystal Ball</h2>
						<ul>

							<li><a href="">inventory</a></li>
							<li><a href="">staging</a></li>
							<li><a href="">terminal</a></li>
							<li id="home"><a href="fiiller.php">home</a></li>
						</ul>
					</div>
						<img id="udpic" src="ocean.jpg"/>
					
					<div class="container">
					<h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a><a id="mess">Releases</a></h3> 
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