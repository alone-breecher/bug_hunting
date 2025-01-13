<?php
// Database credentials
$host = 'localhost';
$username = 'multimat_final';
$password = 'multimat_final';
$database = 'multimat_multimat';

// Connect to the database
$con = mysql_connect($host, $username, $password);
if (!$con) {
    die("Connection failed: " . mysql_error());
}

// Select the database
$select = mysql_select_db($database) or die("Could not select database: " . mysql_error());

// Query to get table names
$query = "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$database'";
$result = mysql_query($query) or die("Query failed: " . mysql_error());

echo "Tables in the database '$database':<br>";
while ($row = mysql_fetch_assoc($result)) {
    echo $row['TABLE_NAME'] . "<br>";
}

// Close the connection
mysql_close($con);
?>
