<?php
// Database credentials
$host = "10.6.0.3";
$username = "matrimonial_new";
$password = "SKaCS10R#33sTr";
$database = "matrimonials";
$table = "email_tbl"; // Table to dump
$chunkSize = 1000; // Number of rows to process per batch
$outputFile = "$table.csv"; // Output file name

// Connect to the database server
$con = @mysqli_connect($host, $username, $password);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the `matrimonials` database
if (!mysqli_select_db($con, $database)) {
    die("Failed to select database '$database': " . mysqli_error($con));
}

echo "Exporting table: $table\n";

// Open a file for writing the CSV
$file = fopen($outputFile, "w");
if (!$file) {
    die("Failed to create the output file for table $table.\n");
}

// Get column names for the table
$query = "SHOW COLUMNS FROM $table";
$result = mysqli_query($con, $query);

if ($result) {
    $header = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $header[] = $row['Field'];
    }
    fputcsv($file, $header); // Write the header to the CSV
} else {
    die("Error fetching column names for table $table: " . mysqli_error($con));
}

// Process rows in chunks using sequential IDs
$lastId = 0;
do {
    $query = "SELECT * FROM $table WHERE id > $lastId ORDER BY id ASC LIMIT $chunkSize";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($file, $row); // Write each row to the CSV
            $lastId = $row['id']; // Update last processed ID
        }
    } else {
        break; // No more rows to process
    }
} while (true);

fclose($file);
echo "Data successfully exported to $outputFile.\n";

// Close the database connection
mysqli_close($con);
?>
