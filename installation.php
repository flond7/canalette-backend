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
  category VARCHAR(30),
  tax_type VARCHAR(30)
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
  taxBusiness DOUBLE(40,2) NOT NULL,
  ivaFull INT(2) NOT NULL,
  ivaSplit INT(2) NOT NULL,
  ivaZero INT(2) NOT NULL,
  mailing_money DOUBLE(40,2) NOT NULL
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
  amount_computed DOUBLE(40,2) NOT NULL,
  amount_paid DOUBLE(40,2) NOT NULL,
  paid TINYINT NOT NULL,
  id_user INT NOT NULL,
  id_drain INT NOT NULL,
  id_year INT NOT NULL,
  bill_number INT NOT NULL
  )";
if (mysqli_query($link, $tabFour)) {
  echo "Table RELATIONAL created successfully. ";
} else {
  echo "ERROR: Could not execute $tabFour. " . mysqli_error($link);
}

// Add test initial data 
$insertOne = "INSERT INTO users (id_user, first_name, last_name, cf, email, tel, category, tax_type) VALUES
  (1, 'Elisa', 'Pessa', 'PSS', 'elisa@mail.it', '0123456789', 'citizen', 'ivaFull'),
  (2, 'Alessandra', 'Pessa', 'ALE', 'ale@mail.it', '0123456789', 'citizen', 'ivaFull'),
  (3, 'Luca', 'Pessa', 'LUC', 'luca@mail.it', '0123456789', 'citizen', 'ivaFull'),
  (4, 'Francesca', 'Pessa', 'FRA', 'fra@mail.it', '0123456789', 'business', 'ivaSplit'),
  (5, 'Pier', 'Pessa', 'PIE', 'pier@mail.it', '0123456789', 'business', 'ivaZero')";
if (mysqli_query($link, $insertOne)) {
  echo "USER data inserted successfully. ";
} else {
  echo "ERROR: Could not insert in USERS " . mysqli_error($link);
}  

// Add test initial data 
$insertTwo = "INSERT INTO taxes (id_year, taxCitizen, taxBusiness, ivaFull, ivaSplit, IvaZero, mailing_money) VALUES
  (1994, 100, 150, 10, 0, 0, 3.50),
  (1995, 200, 300, 10, 0, 0, 3.50),
  (2020, 500, 800, 10, 0, 0, 5.50)";
if (mysqli_query($link, $insertTwo)) {
  echo "USER data inserted successfully. ";
} else {
  echo "ERROR: Could not insert in TAXES " . mysqli_error($link);
}

// Add test initial data 
$insertThree = "INSERT INTO drainChannels (id_drain, num, street, fogl, map) VALUES
  (1, '101', 'Via Roma 1', '12', '5'),
  (2, '102', 'Via Milano 1', '67', '77'),
  (3, '103', 'Via Udine 1', '2', '53'),
  (4, '104', 'Via Genova 1', '5', '81'),
  (5, '105', 'Via Bari 1', '27', '153')";
if (mysqli_query($link, $insertThree)) {
  echo "Table inserted data successfully.";
} else {
  echo "ERROR: Could not insert in DRAINCHANNEL " . mysqli_error($link);
}
 

 // Add test initial data 
$insertThree = "INSERT INTO relational (id, amount_computed, amount_paid, paid, id_user, id_drain, id_year, bill_number) VALUES
(1, 100, 100, true, 1, 1, 1994, 1),
(2, 250, 250, true, 1, 1, 1995, 2),
(3, 250, 250, true, 2, 2, 1994, 3),
(4, 250, 250, true, 2, 3, 1994, 4),
(5, 100, 100, true, 2, 4, 1994, 4),
(6, 100, 60, true, 3, 2, 1995, 5),
(7, 100, 100, false, 4, 2, 2020, 6),
(8, 100, 80, true, 4, 4, 1994, 7),
(9, 300, 300, true, 5, 5, 1995, 8)";
if (mysqli_query($link, $insertThree)) {
echo "Table inserted data successfully.";
} else {
echo "ERROR: Could not insert in RELATIONAL " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
