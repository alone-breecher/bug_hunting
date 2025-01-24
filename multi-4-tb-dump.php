<?php
// Database credentials
$host = "10.6.0.3";
$username = "matrimonial_new";
$password = "SKaCS10R#33sTr";
$database = "matrimonials";
$tables = [
    "state_city",
    "email_tbl",
    "member_gender_dob_update_log",
    "whatsapp_opt_in"
];
$chunkSize = 1000; // Number of rows to process per batch

// Connect to the database server
$con = @mysqli_connect($host, $username, $password);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the `matrimonials` database
if (!mysqli_select_db($con, $database)) {
    die("Failed to select database '$database': " . mysqli_error($con));
}

foreach ($tables as $table) {
    echo "Exporting table: $table\n";
    $outputFile = "$table.csv";

    // Open a file for writing the CSV
    $file = fopen($outputFile, "w");
    if (!$file) {
        echo "Failed to create the output file for table $table.\n";
        continue;
    }

    // Get column names for the table
    $query = "SHOW COLUMNS FROM $table";
    $result = mysqli_query($con, $query);

    if ($result) {
        $header = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $header[] = $row['Field'];
        }
        fputcsv($file, $header);
    } else {
        echo "Error fetching column names for table $table: " . mysqli_error($con) . "\n";
        fclose($file);
        continue;
    }

    // Fetch and write data in chunks
    $offset = 0;
    do {
        $query = "SELECT * FROM $table LIMIT $chunkSize OFFSET $offset";
        $result = mysqli_query($con, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                fputcsv($file, $row);
            }
            $offset += $chunkSize;
        } else {
            break; // No more rows to process
        }
    } while (true);

    fclose($file);
    echo "Data successfully exported to $outputFile.\n";
}

// Close the database connection
mysqli_close($con);
?>
