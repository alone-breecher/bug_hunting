<?php
// Database credentials
$host = "10.6.0.3";
$username = "matrimonial_new";
$password = "SKaCS10R#33sTr";

// Connect to the database server
$con = @mysqli_connect($host, $username, $password);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to list all databases
$query = "SHOW DATABASES";
$result = mysqli_query($con, $query);

if ($result) {
    echo "<h2>Databases on the Server</h2>";
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . htmlspecialchars($row['Database']) . "</li>";
    }
    echo "</ul>";
} else {
    echo "Error retrieving databases: " . mysqli_error($con);
}

// Close the connection
mysqli_close($con);
?>
