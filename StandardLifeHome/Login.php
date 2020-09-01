<?php

session_start();

$servername = "localhost:8889";
$username = "root";
$passworddb = "root";
$conn = new mysqli($servername, $username, $passworddb);

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}

mysqli_select_db($conn, 'userresgistration');

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);


$s = "SELECT * FROM userregistration.usertable WHERE email = '{$email}' && password = '{$password}'";
$check = "SELECT * FROM userregistration.usertable WHERE password = '{$password}'";
$num = "SELECT * FROM userregistration.usertable WHERE email = '{$email}'";

$result = mysqli_query($conn, $s);
$pcheck = mysqli_query($conn, $check);
$ssncheck = mysqli_query($conn, $num);

$ssn = mysqli_fetch_assoc($ssncheck);

// if ($result === false) {
//     exit('ERROR: ' . mysqli_error ($conn));
// }

// if ($pcheck === false){
// 	$message = "wrong password";
// 	echo "<script type='text/javascript'>alert('$message');</script>";
// }



$num = mysqli_num_rows($result);

if($num == 1){
	$_SESSION["user"] = $ssn['user'];
	$_SESSION["ssn"] = $ssn['ssn'];
	header('location:home.php');
}else{
	header('location:LoginPage1.html');
} 

mysqli_close($conn); 

?>