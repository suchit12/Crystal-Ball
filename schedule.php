<!DOCTYPE html>
<html>
    <head>
   		<link rel="stylesheet" type="text/css" href="schedule.css">    
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
					
					<iframe id = "calendar" src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffcc99&amp;src=bttta8t5mfao15sb6inaf6l34k%40group.calendar.google.com&amp;color=%238D6F47&amp;ctz=America%2FLos_Angeles" style="border:solid 1px #777"
					width="800" height="600" frameborder="0" scrolling="no"></iframe>
					// <?php
					
						// session_start();
						// if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
							// $client->setAccessToken($_SESSION['access_token']);
							// $service = new Google_Service_Calendar($client);
							// $calendarId = 'primary';
							// $results = $service->events->insert($calendarId, $event);
						
						// }
						// require_once 'vendor/autoload.php';
						
						// $client = new Google_Client();
						// $client->setAuthConfig('client_secret.json');
						// $client->addScope(Google_Service_Calendar::CALENDAR);
						
						// $event = new Google_Service_Calendar_Event(array(
						  // 'summary' => 'Google I/O 2015',
						  // 'location' => '800 Howard St., San Francisco, CA 94103',
						  // 'description' => 'A chance to hear more about Google\'s developer products.',
						  // 'start' => array(
							// 'dateTime' => '2015-05-28T09:00:00-07:00',
							// 'timeZone' => 'America/Los_Angeles',
						  // ),
						  // 'end' => array(
							// 'dateTime' => '2015-05-28T17:00:00-07:00',
							// 'timeZone' => 'America/Los_Angeles',
						  // ),
						  // 'recurrence' => array(
							// 'RRULE:FREQ=DAILY;COUNT=2'
						  // ),
						  // 'attendees' => array(
							// array('email' => 'lpage@example.com'),
							// array('email' => 'sbrin@example.com'),
						  // ),
						  // 'reminders' => array(
							// 'useDefault' => FALSE,
							// 'overrides' => array(
							  // array('method' => 'email', 'minutes' => 24 * 60),
							  // array('method' => 'popup', 'minutes' => 10),
							// ),
						  // ),
						// ));

					// $calendarId = 'primary';
					// $events->insert($calendarId, $event);
					// printf('Event created: %s\n', $event->htmlLink);
					// ?>

			</div>
		</body>
	</html>