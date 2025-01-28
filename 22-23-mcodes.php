<?php
// Database connection parameters
$host = "localhost";
$username = "multimat_final";
$password = "multimat_final";
$database = "multimat_multimat";

// Establishing a connection to the database
$con = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to fetch the user_mcode column where user_registeredon contains 2022 or 2023
$query = "SELECT user_mcode FROM mat_user WHERE user_registeredon LIKE '%2022%' OR user_registeredon LIKE '%2023%' ORDER BY user_registeredon";

// Execute the query
$result = mysqli_query($con, $query);

// Check if the query returned any results
if (mysqli_num_rows($result) > 0) {
    // File to save the results
    $filename = "user-22-23-mcode.txt";
    $file = fopen($filename, "w");

    if (!$file) {
        die("Failed to create or open the file.");
    }

    // Fetch the rows and write each user_mcode to the file
    while ($row = mysqli_fetch_assoc($result)) {
        fwrite($file, $row['user_mcode'] . PHP_EOL);
    }

    fclose($file);
    echo "Data successfully dumped into $filename";
} else {
    echo "No matching records found.";
}

// Close the database connection
mysqli_close($con);
?>
