<?php
// Database credentials
$host = "10.6.0.3";
$username = "matrimonial_new";
$password = "SKaCS10R#33sTr";
$database = "matrimonials";
$table = "mi_members"; // Table name

// Connect to the database server
$con = @mysqli_connect($host, $username, $password);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the `matrimonials` database
if (!mysqli_select_db($con, $database)) {
    die("Failed to select database '$database': " . mysqli_error($con));
}

// Fetch the column names for the table
$query = "SHOW COLUMNS FROM $table";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Error fetching column names: " . mysqli_error($con));
}

// Display the HTML header
echo "<html><body>";
echo "<h2>Users with Last Login in 2025</h2>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr>";

// Display column names as table header
while ($row = mysqli_fetch_assoc($result)) {
    echo "<th>" . htmlspecialchars($row['Field']) . "</th>";
}
echo "</tr>";

// Fetch the users where last_login_date contains '2025'
$query = "SELECT * FROM $table WHERE last_login_date LIKE '2025%' LIMIT 10";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        foreach ($row as $columnValue) {
            echo "<td>" . htmlspecialchars($columnValue) . "</td>";
        }
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='100'>No users found with last login in 2025.</td></tr>";
}

// Close the table and the HTML page
echo "</table>";
echo "</body></html>";

// Close the database connection
mysqli_close($con);
?>
