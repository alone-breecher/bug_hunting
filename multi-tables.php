<?php
// Database credentials
$host = "10.6.0.3";
$username = "matrimonial_new";
$password = "SKaCS10R#33sTr";
$database = "matrimonials";

// Connect to the database server
$con = @mysqli_connect($host, $username, $password);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the `matrimonials` database
if (!mysqli_select_db($con, $database)) {
    die("Failed to select database '$database': " . mysqli_error($con));
}

// Query to list all tables in the `matrimonials` database
$query = "SHOW TABLES";
$result = mysqli_query($con, $query);

if ($result) {
    echo "<h2>Tables in Database: " . htmlspecialchars($database) . "</h2>";
    echo "<ul>";
    while ($row = mysqli_fetch_row($result)) {
        echo "<li>" . htmlspecialchars($row[0]) . "</li>";
    }
    echo "</ul>";
} else {
    echo "Error retrieving tables: " . mysqli_error($con);
}

// Close the connection
mysqli_close($con);
?>
