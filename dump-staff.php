<?php
// Database connection details
$host = "localhost";
$username = "multimat_final";
$password = "multimat_final";
$database = "multimat_multimat";
$table = "mat_staff";

// File to save the dump
$dumpFile = "mat_staff_dump.sql";

// Connect to the database
$con = new mysqli($host, $username, $password, $database);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Open a file for writing
$file = fopen($dumpFile, 'w');
if (!$file) {
    die("Failed to open file for writing.");
}

// Get the CREATE TABLE statement
$result = $con->query("SHOW CREATE TABLE $table");
if ($result) {
    $row = $result->fetch_assoc();
    fwrite($file, $row['Create Table'] . ";\n\n");
}

// Get the table data
$result = $con->query("SELECT * FROM $table");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $keys = array_keys($row);
        $values = array_map([$con, 'real_escape_string'], array_values($row));
        $keysList = "`" . implode("`, `", $keys) . "`";
        $valuesList = "'" . implode("', '", $values) . "'";
        fwrite($file, "INSERT INTO `$table` ($keysList) VALUES ($valuesList);\n");
    }
}

fclose($file);
echo "Table dumped to $dumpFile successfully.";

$con->close();
?>
