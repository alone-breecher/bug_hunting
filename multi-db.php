<?php
// Database credentials
$host = "209.61.238.73";
$username = "milogin";
$password = "RajD}25]w1";

// Attempt to connect to the database server
$conn = @mysqli_connect($host, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to list all databases
$query = "SHOW DATABASES";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<h2>Databases on the Server</h2>";
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . htmlspecialchars($row['Database']) . "</li>";
    }
    echo "</ul>";
} else {
    echo "Failed to list databases: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
