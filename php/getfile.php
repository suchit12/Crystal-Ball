<?php

<<<<<<< HEAD:getfile.php
	$file = file("serverentries.txt"); //adds on to file serverentries.txt
=======
	$file = file("../serverentries.txt");
	$file1 = file("../deletedentries.txt");
>>>>>>> 542ad6a0f0b433a2f4d0b03c05113fc181d5a4a8:php/getfile.php
	
	require_once('./mysqli_connect.php'); //uses mysqli_connect to connect to database

	$con = mysqli_connect('localhost','root','manchester2002');
	mysqli_select_db($con, 'production_machines');

	$sql= "DELETE FROM production_servers"; //Deletes all from database before adding on to the database data
	$q = "";
	
	if(mysqli_query($con, $sql)) {
		foreach($file as $newline) {
<<<<<<< HEAD:getfile.php
			$newline1 = rtrim($newline, " "); //trims of spaces between servername, application, version, and previousupdate
			$line = rtrim($line1, " \t.");
			if($line != $newline1){
				echo $line1 . '<br>';
				echo $newline . '<br>';
				$a = explode(" ", $newline);
				$server = $a[0];
				$app = $a[1];
				$pack = $a[2];
				$date = $a[3];
				
				//inserts all the values into database using query and for loop	
				$sql = "INSERT INTO production_servers (ServerName, 
				Application, Version, PreviousUpdate) VALUES 
				('$server', '$app', '$pack', '$date' )";
				mysqli_query($con, $sql);
=======
			foreach($file1 as $line1){
				$newline1 = rtrim($newline, " ");
				$line = rtrim($line1, " \t.");
				if($line != $newline1){
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
>>>>>>> 542ad6a0f0b433a2f4d0b03c05113fc181d5a4a8:php/getfile.php
			}
		}
	}
		
	else {
		echo "Error deleting record: " . mysqli_error($con);
	}
	
	
	mysqli_close($con)
?>