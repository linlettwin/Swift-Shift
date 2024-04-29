<?php 
$servername="localhost";
$username="root";
$password="";
$database="transport";

$dbconnection = new mysqli($servername,$username,$password,$database);
$table='bus_ticket';
$table2='customer';
if($dbconnection == true)
{
    //echo "ok";
}
else{
    die("Connection failed:" . $dbconnection->connect_error);
}



$dsn = "mysql:dbname=transport";
$username = "root";
$password = "";
try {
$conn = new PDO( $dsn, $username, $password );
$conn-> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch ( PDOException $e ) {
echo "Connection failed: " . $e-> getMessage();
}



?>