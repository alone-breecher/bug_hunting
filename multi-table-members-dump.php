<?php
// Database credentials
$host = "10.6.0.3";
$username = "matrimonial_new";
$password = "SKaCS10R#33sTr";
$database = "matrimonials";
$table = "mi_members";
$outputFile = "mi_members_dump.csv";

// Connect to the database server
$con = @mysqli_connect($host, $username, $password);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the `matrimonials` database
if (!mysqli_select_db($con, $database)) {
    die("Failed to select database '$database': " . mysqli_error($con));
}

// Open a file for writing the CSV
$file = fopen($outputFile, "w");
if (!$file) {
    die("Failed to create the output file.");
}

// Query to retrieve all rows from the `mi_members` table
$query = "SELECT * FROM $table";
$result = mysqli_query($con, $query);

if ($result) {
    // Fetch column names and write them as the first row in the CSV
    $fields = mysqli_fetch_fields($result);
    $header = [];
    foreach ($fields as $field) {
        $header[] = $field->name;
    }
    fputcsv($file, $header);

    // Fetch rows and write them to the CSV file
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($file, $row);
    }

    echo "Data successfully exported to $outputFile.";
} else {
    echo "Error retrieving table contents: " . mysqli_error($con);
}

// Close the file and database connection
fclose($file);
mysqli_close($con);
?>
