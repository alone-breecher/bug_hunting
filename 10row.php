<?php
// Database connection parameters
$host = "localhost";
$username = "multimat_final";
$password = "multimat_final";
$database = "multimat_multimat";

// Establishing a connection to the database
$con = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to fetch the first 10 rows from the table mat_user
$query = "SELECT * FROM mat_user LIMIT 10";

// Execute the query
$result = mysqli_query($con, $query);

// Check if the query returned any results
if (mysqli_num_rows($result) > 0) {
    // Display the rows in an HTML table
    echo "<table border='1'>";
    echo "<tr>";

    // Fetch column names dynamically
    while ($field = mysqli_fetch_field($result)) {
        echo "<th>" . htmlspecialchars($field->name) . "</th>";
    }

    echo "</tr>";

    // Fetch rows and display them
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        foreach ($row as $column) {
            echo "<td>" . htmlspecialchars($column) . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No rows found in the table.";
}

// Close the database connection
mysqli_close($con);
?>
