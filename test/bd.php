<?php 


$mysqli = new mysqli("localhost", "root", "", "parrilla_programacion");
if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

/*
	chek conection
 */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

/*
SELECT
 */

$result = $mysqli->query("SELECT * FROM canal");

 while ($row = mysqli_fetch_assoc($result))
  {

  	echo "id: ".$row['logotipo']."<br>";
    
  }

  
  /*
  identificador unico
   */
  function getID($mysqli){
	$uui = $mysqli->query("SELECT uuid() as identificador LIMIT 1");
	while ($row2 = mysqli_fetch_assoc($uui))
	  {
	  	return $row2['identificador']; 
	  }
}

echo getID($mysqli);

/*
insert
 */

$query = "INSERT INTO canal VALUES ('ide', 'DEU', 'Stuttgart')";
if ($mysqli->query($query)) {
	echo "<br>SI ha agreado a la BD<br>";
}else{
	echo "<br>NO ha agreado a la BD<br>";
}



 ?>