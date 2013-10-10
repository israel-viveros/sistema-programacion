<!doctype>
<html>
<head>
	<title>Primera Pantalla</title>
</head>
<body>

<?php 

include('config.php');
include('functions.php');

$mysqli = new mysqli(URL_DATABASE, USER_DATABASE, PASSWORD_DATABASE, TABLE_DATABASE);
if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

/*
	chek conection
 */
if ($mysqli->connect_errno) {
    printf("Ha Fallado la conexion con la Base de datos: %s\n", $mysqli->connect_error);
    exit();
}



$available_dates = $mysqli->query("select fecha from fecha where DAY(fecha) >= '10' AND MONTH(fecha)= '10' AND YEAR(fecha) = '2013'");
 while ($row = mysqli_fetch_assoc($available_dates)){
  	echo $row['fecha']."<br>";
  }




 ?>






</body>
</html>