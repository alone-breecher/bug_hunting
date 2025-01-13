<?php

// MySQL connection details
$host = "localhost";
$username = "multimat_final";
$password = "multimat_final";

// List of databases to dump
$databases = [
    "multimat_final",
    "multimat_final2",
    "multimat_final_old",
    "multimat_final_old2",
    "multimat_matrimony",
    "multimat_multimat"
];

// Directory to save the dump files
$outputDir = __DIR__;

foreach ($databases as $db) {
    // Path for the dump file
    $dumpFile = $outputDir . "/" . $db . ".sql";

    // Command to dump the database
    $command = "mysqldump -h $host -u $username -p$password $db > $dumpFile";

    // Execute the command
    exec($command, $output, $result);

    // Check if the dump was successful
    if ($result === 0) {
        echo "Successfully dumped database: $db<br>";
    } else {
        echo "Failed to dump database: $db. Error: " . implode("\n", $output) . "<br>";
    }
}

echo "All dumps completed.";

?>
