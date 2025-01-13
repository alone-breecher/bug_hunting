<?php
// Database connection details
$host = "localhost";
$username = "multimat_final";
$password = "multimat_final";
$database = "multimat_multimat";

// Tables to dump
$tables = ["mat_user", "mat_user_married", "mat_userprofile", "mat_userprofile_married"];

// Dump file location
$dumpFile = "specific_tables_dump.sql";

// Open the dump file for writing
$file = fopen($dumpFile, "w");
if (!$file) {
    die("Failed to open dump file for writing.");
}

// Connect to the database
$con = mysql_connect($host, $username, $password);
if (!$con) {
    die("Failed to connect to MySQL: " . mysql_error());
}
mysql_select_db($database) or die("Database selection failed: " . mysql_error());

foreach ($tables as $table) {
    // Write DROP TABLE and CREATE TABLE statements
    $createResult = mysql_query("SHOW CREATE TABLE $table") or die("Error fetching table schema for $table: " . mysql_error());
    $createRow = mysql_fetch_assoc($createResult);
    fwrite($file, "DROP TABLE IF EXISTS `$table`;\n");
    fwrite($file, $createRow['Create Table'] . ";\n\n");

    // Write INSERT statements for table data
    $dataResult = mysql_query("SELECT * FROM $table") or die("Error fetching data for $table: " . mysql_error());
    while ($row = mysql_fetch_assoc($dataResult)) {
        $columns = array_keys($row);
        $values = array_map(function ($value) {
            return isset($value) ? "'" . mysql_real_escape_string($value) . "'" : "NULL";
        }, array_values($row));

        $insertStatement = "INSERT INTO `$table` (`" . implode("`, `", $columns) . "`) VALUES (" . implode(", ", $values) . ");\n";
        fwrite($file, $insertStatement);
    }
    fwrite($file, "\n");
}

fclose($file);
mysql_close($con);

echo "Dump completed! The file is saved as: $dumpFile";
?>

