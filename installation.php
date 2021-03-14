<?php
$servername = "localhost";
$username = "dbroot";
$password = "dbmuni05cipio";
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
  first_name VARCHAR(30),
  last_name VARCHAR(30),
  cf VARCHAR(16),
  email VARCHAR(70),
  tel VARCHAR(30),
  category VARCHAR(30)
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
  street VARCHAR(70) NOT NULL,
  fogl VARCHAR(30) NOT NULL,
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
  (1, 'Elisa', 'Pessa', 'PSSLSE1234567890', 'elisa@mail.it', '0123456789', 'citizen'),
  (2, 'Alessandra', 'Pessa', 'AL35G5t698S', 'elisa@mail.it', '0123456789', 'citizen'),
  (3, 'Luca', 'Pessa', 'LCGF93FG871K', 'elisa@mail.it', '0123456789', 'citizen'),
  (4, 'Francesca', 'Pessa', 'FCGTLT86F45Gt998', 'elisa@mail.it', '0123456789', 'business'),
  (5, 'Pier', 'Pessa', 'PRG67F98KOL457U', 'elisa@mail.it', '0123456789', 'business')";
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
  (1, '1', 'Via Roma 1', '12', '5'),
  (2, '112', 'Via Milano 1', '67', '77'),
  (3, '273', 'Via Udine 1', '2', '53'),
  (4, '439', 'Via Genova 1', '5', '81'),
  (5, '576', 'Via Bari 1', '27', '153')";
if (mysqli_query($link, $insertThree)) {
  echo "Table inserted data successfully.";
} else {
  echo "ERROR: Could not insert in DRAINCHANNEL " . mysqli_error($link);
}
 

 // Add test initial data 
$insertThree = "INSERT INTO relational (id, amount, paid, id_user, id_drain, id_year) VALUES
(1, 1050, true, 1, 1, 1994),
(2, 950, true, 1, 1, 1995),
(3, 1050, true, 2, 2, 1994),
(4, 1050, true, 2, 3, 1994),
(5, 1050, true, 2, 4, 1994),
(6, 1050, true, 3, 2, 1995),
(7, 1050, false, 4, 2, 2020),
(8, 1050, true, 4, 4, 1994),
(9, 1050, true, 5, 5, 1995)";
if (mysqli_query($link, $insertThree)) {
echo "Table inserted data successfully.";
} else {
echo "ERROR: Could not insert in RELATIONAL " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>