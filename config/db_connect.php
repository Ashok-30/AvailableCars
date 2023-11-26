<?php 

	// connect to the database
	$conn = mysqli_connect('localhost', 'Ashok', '', 'AvailableCar');

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
  

?>