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

// Query to retrieve all rows from the `mi_members` table
$query = "SELECT * FROM mi_members";
$result = mysqli_query($con, $query);

if ($result) {
    echo "<h2>Contents of Table: mi_members</h2>";
    
    // Display the table contents in an HTML table
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>";
    
    // Fetch and display column names
    $fields = mysqli_fetch_fields($result);
    foreach ($fields as $field) {
        echo "<th>" . htmlspecialchars($field->name) . "</th>";
    }
    echo "</tr>";
    
    // Fetch and display rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        foreach ($row as $cell) {
            echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "Error retrieving table contents: " . mysqli_error($con);
}

// Close the connection
mysqli_close($con);
?>
