<?php

	$file = file("serverentries.txt");
	$file1 = file("deletedentries.txt");
	
	require_once('./mysqli_connect.php');

	$con = mysqli_connect('localhost','root','manchester2002');
	mysqli_select_db($con, 'production_machines');

	$sql= "DELETE FROM production_servers";
	$q = "";
	
	if(mysqli_query($con, $sql)) {
		foreach($file as $newline) {
			foreach($file1 as $line1){
				$newline1 = rtrim($newline, " ");
				$line = rtrim($line1, " \t.");
				if($line != $newline1){
					echo $line1 . '<br>';
					echo $newline . '<br>';
					$a = explode(" ", $newline);
					$server = $a[0];
					$app = $a[1];
					$pack = $a[2];
					$date = $a[3];
					
					$sql = "INSERT INTO production_servers (ServerName, 
					Application, Version, PreviousUpdate) VALUES 
					('$server', '$app', '$pack', '$date' )";
					mysqli_query($con, $sql);
				}
			}
		}
	}
		
	else {
		echo "Error deleting record: " . mysqli_error($con);
	}
	
	
	mysqli_close($con)
?>