<?php

// MySQL connection details
$host = "localhost";
$username = "multimat_final";
$password = "multimat_final";
$database = "multimat_multimat";

// File to save the database dump
$dumpFile = "multimat_multimat_dump.sql";

// Construct the mysqldump command
$command = "mysqldump -u {$username} -p{$password} {$database} > {$dumpFile}";

// Execute the command
exec($command, $output, $result);

// Check the result of the dump
if ($result === 0) {
    echo "Database dumped successfully! <a href='{$dumpFile}'>Download the dump</a>";
} else {
    echo "Failed to dump the database. Error: " . implode("\n", $output);
}

?>
