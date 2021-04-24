<?php
/* Connect to the MS SQL 2019 Express server using Windows Authentication  */
$serverName = "DEVICE-DESKTOP\SQLEXPRESS"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication
$connectionInfo = array("Database" => "Web", "CharacterSet" => "UTF-8");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn) {
     echo "Connection Established.<br />";
} else {
     echo "Connection could not be established.<br />";
     die(print_r(sqlsrv_errors(), true));
}
/* Define the query */
$tsql1 = "INSERT INTO dbo.Client (fname, lname, email, phone, bday, gender, certification1, certification2, certification3, certification4, certification5, certification_other, reason, about_user)  
           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,)";

/* Construct the parameter array from HTML variable inputs */
$firstName = $_POST["fname"];
$lastName = $_POST["lname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$bday = $_POST["bday"];
$gender = $_POST["gender"];
$certification1 = $_POST["certification1"];
$certification2 = $_POST["certification2"];
$certification3 = $_POST["certification3"];
$certification4 = $_POST["certification4"];
$certification5 = $_POST["certification5"];
$certification_other = $_POST["certification_other"];
$reason = $_POST["reason"];
$about_user = $_POST["about_user"];


$params1 = array(
     array($firstName, null),
     array($lastName, null),
     array($email, null),
     array($phone, null),
     array($bday, null),
     array($gender, null),
     array($certification1, null),
     array($certification2, null),
     array($certification3, null),
     array($certification4, null),
     array($certification5, null),
     array($certification_other, null),
     array($reason, null),
     array($about_user, null),
);

/* Execute the INSERT query. */
$stmt1 = sqlsrv_query($conn, $tsql1, $params1);
if ($stmt1 === false) {
     echo "Error in execution of INSERT.\n";
     die(print_r(sqlsrv_errors(), true));
}
if ($stmt1) {
     echo "Database updated.<br />";
} else {
     echo "Connection could not be established.<br />";
     die(print_r(sqlsrv_errors(), true));
}
