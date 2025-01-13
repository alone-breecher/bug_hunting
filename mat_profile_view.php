<?php
// Database connection details
$host = "localhost";
$username = "multimat_final";
$password = "multimat_final";
$database = "multimat_multimat";

// Connect to the database
$con = mysql_connect($host, $username, $password);
if (!$con) {
    die("Failed to connect to MySQL: " . mysql_error());
}
mysql_select_db($database) or die("Database selection failed: " . mysql_error());

// Fetch data from mat_staff table
$table = "mat_profile_view";
echo "<h2>Table: $table</h2>";
$result = mysql_query("SELECT * FROM $table") or die("Error fetching data from $table: " . mysql_error());

if (mysql_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>";
    // Fetch column names
    $fields = mysql_num_fields($result);
    for ($i = 0; $i < $fields; $i++) {
        $fieldName = mysql_field_name($result, $i);
        echo "<th>$fieldName</th>";
    }
    echo "</tr>";

    // Fetch rows
    while ($row = mysql_fetch_assoc($result)) {
        echo "<tr>";
        foreach ($row as $cell) {
            echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No data found in $table.</p>";
}

mysql_close($con);
?>
