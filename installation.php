<?php
$servername = "localhost";
$username = "";
$password = "";
$dbName = "canalette";

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect($servername, $username, $password);

// Check connection
if ($link === false) {die("ERROR: Could not connect. " . mysqli_connect_error());}

// Attempt create database query execution
$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
if (mysqli_query($link, $sql)) {
  echo "Database created successfully. ";
} else {
  echo "ERROR: Could not execute $sql. " . mysqli_error($link);
}

// Select db
mysqli_select_db($link, $dbName);

// USER table
$tabOne = "CREATE TABLE IF NOT EXISTS users (
  id_user INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(30) NOT NULL,
  last_name VARCHAR(30) NOT NULL,
  cf VARCHAR(16) NOT NULL,
  email VARCHAR(70),
  tel VARCHAR(30),
  category VARCHAR(30) NOT NULL
  )";
if (mysqli_query($link, $tabOne)) {
  echo "Table USERS created successfully. ";
} else {
  echo "ERROR: Could not execute $tabOne. " . mysqli_error($link);
}

// TAXES table
$tabTwo = "CREATE TABLE IF NOT EXISTS taxes (
  id_year INT(4) NOT NULL PRIMARY KEY,
  taxCitizen DOUBLE(40,2) NOT NULL,
  taxBusiness DOUBLE(40,2) NOT NULL
  )";
if (mysqli_query($link, $tabTwo)) {
  echo "Table TAXES created successfully. ";
} else {
  echo "ERROR: Could not execute $tabTwo. " . mysqli_error($link);
}

// DRAINCHANNELS table
$tabThree = "CREATE TABLE IF NOT EXISTS drainChannels (
  id_drain INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  num VARCHAR(30) NOT NULL,
  street VARCHAR(70),
  fogl VARCHAR(30),
  map VARCHAR(30) NOT NULL
  )";
if (mysqli_query($link, $tabThree)) {
  echo "Table DRAINCHANNEL created successfully. ";
} else {
  echo "ERROR: Could not execute $tabThree. " . mysqli_error($link);
}

// RELATIONAL table
$tabFour = "CREATE TABLE IF NOT EXISTS relational (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  amount DOUBLE(40,2) NOT NULL,
  paid BOOLEAN NOT NULL,
  id_user INT NOT NULL,
  id_drain INT NOT NULL,
  id_year INT NOT NULL
  )";
if (mysqli_query($link, $tabFour)) {
  echo "Table RELATIONAL created successfully. ";
} else {
  echo "ERROR: Could not execute $tabFour. " . mysqli_error($link);
}

// Add test initial data 
$insertOne = "INSERT INTO users (id_user, first_name, last_name, cf, email, tel, category) VALUES
  (0, 'Elisa', 'Pessa', 'PSSLSE1234567890', 'elisa@mail.it', '0123456789', 'citizen'),
  (1, 'Eli', 'Pes', 'PSSLS4567890', 'elisa@mail.it', '0123456789', 'citizen'),
  (2, 'E', 'Pessa', 'PSSLSE1234567890', 'elisa@mail.it', '0123456789', 'citizen')";
if (mysqli_query($link, $insertOne)) {
  echo "USER data inserted successfully. ";
} else {
  echo "ERROR: Could not insert in USERS " . mysqli_error($link);
}  

// Add test initial data 
$insertTwo = "INSERT INTO taxes (id_year, taxCitizen, taxBusiness) VALUES
  (1994, 100, 150),
  (1995, 200, 300),
  (2020, 500, 800)";
if (mysqli_query($link, $insertTwo)) {
  echo "USER data inserted successfully. ";
} else {
  echo "ERROR: Could not insert in TAXES " . mysqli_error($link);
}

// Add test initial data 
$insertThree = "INSERT INTO drainChannels (id_drain, num, street, fogl, map) VALUES
  (0, '143', 'Via Roma 1', '12', '5'),
  (1, '1', 'Via Roma 1', '67', '77'),
  (2, '273', 'Via Roma 1', '2', '53')";
if (mysqli_query($link, $insertThree)) {
  echo "Table inserted data successfully.";
} else {
  echo "ERROR: Could not insert in DRAINCHANNEL " . mysqli_error($link);
}
 

 // Add test initial data 
$insertThree = "INSERT INTO relational (id, amount, paid, id_user, id_drain, id_year) VALUES
(0, 1050, true, 1, 1, 1994),
(1, 950, true, 1, 1, 1995),
(2, 1050, true, 2, 2, 1994),
(3, 1050, true, 0, 2, 1995)";
if (mysqli_query($link, $insertThree)) {
echo "Table inserted data successfully.";
} else {
echo "ERROR: Could not insert in RELATIONAL " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
