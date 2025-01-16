<?php
// Database credentials
$host = 'localhost';
$username = 'multimat_final';
$password = 'multimat_final';
$database = 'multimat_multimat';

// Connect to the database using mysqli
$con = new mysqli($host, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Query to get user_mcode where registered_on is in 2021, 2022, or 2023
$query = "SELECT user_mcode FROM mat_user WHERE YEAR(user_registeredon) IN (2021, 2022, 2023)";
$result = $con->query($query);

if (!$result) {
    die("Query failed: " . $con->error);
}

// Open a file in write mode
$file = fopen("user_mcode2023_dump.txt", "w");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Write each user_mcode to the file
        fwrite($file, $row['user_mcode'] . PHP_EOL);
    }
    echo "Data successfully written to user_mcode_dump.txt";
} else {
    echo "0 results";
}

// Close the file
fclose($file);

// Close the connection
$con->close();
?>
