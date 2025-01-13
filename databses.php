<?php

// Connect to the MySQL server
$con = mysql_connect("localhost", "multimat_final", "multimat_final");

if (!$con) {
    echo "Failed to connect to MySQL: " . mysql_error();
    die();
}

// Query to list all databases
$result = mysql_query("SHOW DATABASES") or die("Error: " . mysql_error());

// Loop through the result and display the database names
echo "Databases on the server:<br>";
while ($row = mysql_fetch_row($result)) {
    echo $row[0] . "<br>";
}

?>
