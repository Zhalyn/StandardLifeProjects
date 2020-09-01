<?php

session_start();

$servername = "localhost:8889";
$username = "root";
$passworddb = "root";

$conn = new mysqli($servername, $username, $passworddb);

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}

mysqli_select_db($conn, 'userresgistration');

$name = mysqli_real_escape_string($conn, $_POST['user']);
$surname = mysqli_real_escape_string($conn, $_POST['surname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$ssn = mysqli_real_escape_string($conn, $_POST['ssn']);


$s = "SELECT * FROM userregistration.usertable WHERE email = '{$email}'";

$result = mysqli_query($conn, $s);

if ($result === false) {
    exit('ERROR: ' . mysqli_error ($conn));
}

$num = mysqli_num_rows($result);

if($num > 0){
	echo "<script type='text/javascript'>alert('$message');</script>";
	header('location:LoginPage1.html');
	exit();
}

$reg = "INSERT INTO userregistration.usertable(user, surname, email, password, phone, ssn) VALUES ('{$name}', '{$surname}', '{$email}', '{$password}', '{$phone}', '{$ssn}')";

// $newsql = "CREATE TABLE userregistration.". $name ." (
// id INT(6) AUTO_INCREMENT PRIMARY KEY,
// credit varchar(255) NOT NULL,
// debt varchar(255) NOT NULL,
// balance varchar(255) NOT NULL,
// deals varchar(255) NOT NULL
// )";

// $postVariable = "". $name ."". $surname ."";
// $_SESSION['postVariable'] = $postVariable;


//creating a user specific table in MySQL everytime user is logged in

if(mysqli_query($conn, $reg)){
	$_SESSION["ssn"] = $ssn;
	header('location:home.php');
} else {
	echo "ERROR" . mysqli_error($conn);
	// header('location:LoginPage1.html');
	exit();
}

mysqli_close($conn); 

?>