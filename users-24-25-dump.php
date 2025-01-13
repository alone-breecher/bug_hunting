<?php
// Database credentials
$host = "localhost";
$username = "multimat_final";  // Replace with your MySQL username
$password = "multimat_final";  // Replace with your MySQL password
$database = "multimat_multimat";  // Database name
$table = "mat_user";  // Table name

// Filter condition for the 'user_registeredon' column
$where_condition = "user_registeredon LIKE '2024%' OR user_registeredon LIKE '2025%'";

// Output file path
$output_file = "mat_user_filtered.sql";

// Construct the mysqldump command
$command = "mysqldump -u $username -p$password $database $table --where=\"$where_condition\" > $output_file";

// Execute the command
exec($command);

// Check if the file was created
if (file_exists($output_file)) {
    echo "Dump successful! The file is located at: " . realpath($output_file);
} else {
    echo "Failed to create the dump file.";
}
?>
