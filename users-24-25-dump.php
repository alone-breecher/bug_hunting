<?php
// Database credentials
$servername = "localhost";
$username = "multimat_final";  // Replace with your MySQL username
$password = "multimat_final";  // Replace with your MySQL password
$dbname = "multimat_multimat";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch rows where user_registeredon has 2024 or 2025
$sql = "SELECT * FROM mat_user WHERE user_registeredon LIKE '2024%' OR user_registeredon LIKE '2025%'";
$result = $conn->query($sql);

// Create a file to dump the results
$file = fopen("users-registered-on-24-25.sql", "w");

if ($result->num_rows > 0) {
    // Write the SQL statements to the file
    while($row = $result->fetch_assoc()) {
        $sql_insert = "INSERT INTO mat_user (user_id, user_raw_mcode, user_mcode, user_dob, user_name, user_email, user_password, user_fairpass, user_branch, user_status, user_fbid, user_linkedinid, user_twitterid, user_registeredon, user_registeredby, user_registerthrough, user_lastupdated_by, user_lastupdated_on, user_image_status, user_horoscope_status, user_image_restriction, user_image_restricttime, user_image_lock, user_image_locktime, user_lastlogin, user_step, user_newstep, user_page, user_isbill, user_ucode, user_crop, user_otp, user_otp_status, user_mobileimage, user_mobdayreco, user_mobmyprofile, user_mobmycontact, user_mobnewmatch, user_mobphotomatch, user_mobshortlistme, user_mobinterestrem, user_mobphotoreque, user_mobpayment, user_mobpackageexp, user_moboffer, user_mobgroupwise, user_mobpackexten, user_mobprofileact, user_mobprofileedit, user_mobphotoupdate, user_mobprofiledel, user_mobbooster, user_mobprivilege, user_completeness, user_mobilecrop, user_dailyrecommdate, user_dailydelete, user_subscribe, user_aadhar, user_aadhar_verify) VALUES ("
            . "'" . $row["user_id"] . "', "
            . "'" . $row["user_raw_mcode"] . "', "
            . "'" . $row["user_mcode"] . "', "
            . "'" . $row["user_dob"] . "', "
            . "'" . $row["user_name"] . "', "
            . "'" . $row["user_email"] . "', "
            . "'" . $row["user_password"] . "', "
            . "'" . $row["user_fairpass"] . "', "
            . "'" . $row["user_branch"] . "', "
            . "'" . $row["user_status"] . "', "
            . "'" . $row["user_fbid"] . "', "
            . "'" . $row["user_linkedinid"] . "', "
            . "'" . $row["user_twitterid"] . "', "
            . "'" . $row["user_registeredon"] . "', "
            . "'" . $row["user_registeredby"] . "', "
            . "'" . $row["user_registerthrough"] . "', "
            . "'" . $row["user_lastupdated_by"] . "', "
            . "'" . $row["user_lastupdated_on"] . "', "
            . "'" . $row["user_image_status"] . "', "
            . "'" . $row["user_horoscope_status"] . "', "
            . "'" . $row["user_image_restriction"] . "', "
            . "'" . $row["user_image_restricttime"] . "', "
            . "'" . $row["user_image_lock"] . "', "
            . "'" . $row["user_image_locktime"] . "', "
            . "'" . $row["user_lastlogin"] . "', "
            . "'" . $row["user_step"] . "', "
            . "'" . $row["user_newstep"] . "', "
            . "'" . $row["user_page"] . "', "
            . "'" . $row["user_isbill"] . "', "
            . "'" . $row["user_ucode"] . "', "
            . "'" . $row["user_crop"] . "', "
            . "'" . $row["user_otp"] . "', "
            . "'" . $row["user_otp_status"] . "', "
            . "'" . $row["user_mobileimage"] . "', "
            . "'" . $row["user_mobdayreco"] . "', "
            . "'" . $row["user_mobmyprofile"] . "', "
            . "'" . $row["user_mobmycontact"] . "', "
            . "'" . $row["user_mobnewmatch"] . "', "
            . "'" . $row["user_mobphotomatch"] . "', "
            . "'" . $row["user_mobshortlistme"] . "', "
            . "'" . $row["user_mobinterestrem"] . "', "
            . "'" . $row["user_mobphotoreque"] . "', "
            . "'" . $row["user_mobpayment"] . "', "
            . "'" . $row["user_mobpackageexp"] . "', "
            . "'" . $row["user_moboffer"] . "', "
            . "'" . $row["user_mobgroupwise"] . "', "
            . "'" . $row["user_mobpackexten"] . "', "
            . "'" . $row["user_mobprofileact"] . "', "
            . "'" . $row["user_mobprofileedit"] . "', "
            . "'" . $row["user_mobphotoupdate"] . "', "
            . "'" . $row["user_mobprofiledel"] . "', "
            . "'" . $row["user_mobbooster"] . "', "
            . "'" . $row["user_mobprivilege"] . "', "
            . "'" . $row["user_completeness"] . "', "
            . "'" . $row["user_mobilecrop"] . "', "
            . "'" . $row["user_dailyrecommdate"] . "', "
            . "'" . $row["user_dailydelete"] . "', "
            . "'" . $row["user_subscribe"] . "', "
            . "'" . $row["user_aadhar"] . "', "
            . "'" . $row["user_aadhar_verify"] . "'"
            . ");\n";
        
        fwrite($file, $sql_insert);
    }

    echo "Data dump completed successfully. Check the file 'users-registered-on-24-25.sql' for the dump.";

    fclose($file); // Close the file
} else {
    echo "0 results found.";
}

// Close connection
$conn->close();
?>
