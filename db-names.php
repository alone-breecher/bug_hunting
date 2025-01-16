<?php
$host = 'localhost'; // Change this if the MySQL server is on a different host
$user = 'root';
$password = 'PortalM123';

// Create a connection
$conn = new mysqli($host, $user, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get the list of databases
$sql = "SHOW DATABASES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Available Databases:</h1><ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row['Database'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No databases found.";
}

// Close the connection
$conn->close();
?>
