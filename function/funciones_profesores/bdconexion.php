<?php

    $conn = new mysqli('localhost','root','','atributos');

    if($conn->connect_error) {

        echo $error->$conn->connect_error;

    }
	$rowcount=-1;


    function bd_consulta($query)

    {

    	$hostname="localhost";

    	$user="root";

    	$password="";

    	$bd="atributos";

    	$connection = mysqli_connect($hostname, $user, $password);

    	if($connection == false){

    		echo 'Ha habido un error <br>'.mysqli_connect_error();

    		exit();

    	}

    	if (!$connection->set_charset("utf8")) {

    		 printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);

    		 exit();

    	}

    	mysqli_select_db ($connection, $bd);

		$result = mysqli_query($connection, $query);
		if ($result)
		{
		// Return the number of rows in result set
		$rowcount = mysqli_num_rows($result);
		
		}

    	mysqli_close($connection);

    	return $result;

	}
	


?>
