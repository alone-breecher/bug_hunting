<?php
// Database credentials
$host = "10.6.0.3";
$username = "matrimonial_new";
$password = "SKaCS10R#33sTr";
$database = "matrimonials";
$table = "mi_members";
$outputFile = "active-users.csv";
$chunkSize = 1000; // Number of rows to process per batch

// Connect to the database server
$con = @mysqli_connect($host, $username, $password);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the matrimonials database
if (!mysqli_select_db($con, $database)) {
    die("Failed to select database '$database': " . mysqli_error($con));
}

// Open a file for writing the CSV
$file = fopen($outputFile, "w");
if (!$file) {
    die("Failed to create the output file.");
}

// Get column names for the table
$query = "SHOW COLUMNS FROM $table";
$result = mysqli_query($con, $query);

if ($result) {
    $header = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $header[] = $row['Field'];
    }
    fputcsv($file, $header); // Write column headers to the CSV
} else {
    die("Error fetching column names: " . mysqli_error($con));
}

// Fetch and write filtered data in chunks
$offset = 0;
do {
    $query = "SELECT * FROM $table WHERE member_status = 'Y' LIMIT $chunkSize OFFSET $offset";
    $result = mysqli_query($con, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($file, $row); // Write each filtered row to the CSV
        }
        $offset += $chunkSize;
    } else {
        break; // No more rows to process
    }
} while (true);

echo "Data successfully exported to $outputFile.";

// Close the file and database connection
fclose($file);
mysqli_close($con);
?>
