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

// SQL query to fetch only 10 users from mat_user table
$sql = "SELECT * FROM mat_user LIMIT 10";
$result = $conn->query($sql);

// Display results in a simple HTML table
echo "<h2>First 10 Users from mat_user Table</h2>";
echo "<table border='1' cellpadding='10'>
        <tr>
            <th>User ID</th>
            <th>User Raw MCode</th>
            <th>User MCode</th>
            <th>User DOB</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>User Password</th>
            <th>User Fairpass</th>
            <th>User Branch</th>
            <th>User Status</th>
            <th>User FB ID</th>
            <th>User LinkedIn ID</th>
            <th>User Twitter ID</th>
            <th>User Registered On</th>
            <th>User Registered By</th>
            <th>User Register Through</th>
            <th>User Last Updated By</th>
            <th>User Last Updated On</th>
            <th>User Image Status</th>
            <th>User Horoscope Status</th>
            <th>User Image Restriction</th>
            <th>User Image Restrict Time</th>
            <th>User Image Lock</th>
            <th>User Image Lock Time</th>
            <th>User Last Login</th>
            <th>User Step</th>
            <th>User New Step</th>
            <th>User Page</th>
            <th>User Is Bill</th>
            <th>User UCode</th>
            <th>User Crop</th>
            <th>User OTP</th>
            <th>User OTP Status</th>
            <th>User Mobile Image</th>
            <th>User Mob Day Reco</th>
            <th>User Mob My Profile</th>
            <th>User Mob My Contact</th>
            <th>User Mob New Match</th>
            <th>User Mob Photo Match</th>
            <th>User Mob Shortlist Me</th>
            <th>User Mob Interest Rem</th>
            <th>User Mob Photo Reque</th>
            <th>User Mob Payment</th>
            <th>User Mob Package Exp</th>
            <th>User Mob Offer</th>
            <th>User Mob Groupwise</th>
            <th>User Mob Pack Exten</th>
            <th>User Mob Profile Act</th>
            <th>User Mob Profile Edit</th>
            <th>User Mob Photo Update</th>
            <th>User Mob Profile Del</th>
            <th>User Mob Booster</th>
            <th>User Mob Privilege</th>
            <th>User Completeness</th>
            <th>User Mobile Crop</th>
            <th>User Daily Recomm Date</th>
            <th>User Daily Delete</th>
            <th>User Subscribe</th>
            <th>User Aadhar</th>
            <th>User Aadhar Verify</th>
        </tr>";

// Fetch and display the rows
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["user_id"] . "</td>
                <td>" . $row["user_raw_mcode"] . "</td>
                <td>" . $row["user_mcode"] . "</td>
                <td>" . $row["user_dob"] . "</td>
                <td>" . $row["user_name"] . "</td>
                <td>" . $row["user_email"] . "</td>
                <td>" . $row["user_password"] . "</td>
                <td>" . $row["user_fairpass"] . "</td>
                <td>" . $row["user_branch"] . "</td>
                <td>" . $row["user_status"] . "</td>
                <td>" . $row["user_fbid"] . "</td>
                <td>" . $row["user_linkedinid"] . "</td>
                <td>" . $row["user_twitterid"] . "</td>
                <td>" . $row["user_registeredon"] . "</td>
                <td>" . $row["user_registeredby"] . "</td>
                <td>" . $row["user_registerthrough"] . "</td>
                <td>" . $row["user_lastupdated_by"] . "</td>
                <td>" . $row["user_lastupdated_on"] . "</td>
                <td>" . $row["user_image_status"] . "</td>
                <td>" . $row["user_horoscope_status"] . "</td>
                <td>" . $row["user_image_restriction"] . "</td>
                <td>" . $row["user_image_restricttime"] . "</td>
                <td>" . $row["user_image_lock"] . "</td>
                <td>" . $row["user_image_locktime"] . "</td>
                <td>" . $row["user_lastlogin"] . "</td>
                <td>" . $row["user_step"] . "</td>
                <td>" . $row["user_newstep"] . "</td>
                <td>" . $row["user_page"] . "</td>
                <td>" . $row["user_isbill"] . "</td>
                <td>" . $row["user_ucode"] . "</td>
                <td>" . $row["user_crop"] . "</td>
                <td>" . $row["user_otp"] . "</td>
                <td>" . $row["user_otp_status"] . "</td>
                <td>" . $row["user_mobileimage"] . "</td>
                <td>" . $row["user_mobdayreco"] . "</td>
                <td>" . $row["user_mobmyprofile"] . "</td>
                <td>" . $row["user_mobmycontact"] . "</td>
                <td>" . $row["user_mobnewmatch"] . "</td>
                <td>" . $row["user_mobphotomatch"] . "</td>
                <td>" . $row["user_mobshortlistme"] . "</td>
                <td>" . $row["user_mobinterestrem"] . "</td>
                <td>" . $row["user_mobphotoreque"] . "</td>
                <td>" . $row["user_mobpayment"] . "</td>
                <td>" . $row["user_mobpackageexp"] . "</td>
                <td>" . $row["user_moboffer"] . "</td>
                <td>" . $row["user_mobgroupwise"] . "</td>
                <td>" . $row["user_mobpackexten"] . "</td>
                <td>" . $row["user_mobprofileact"] . "</td>
                <td>" . $row["user_mobprofileedit"] . "</td>
                <td>" . $row["user_mobphotoupdate"] . "</td>
                <td>" . $row["user_mobprofiledel"] . "</td>
                <td>" . $row["user_mobbooster"] . "</td>
                <td>" . $row["user_mobprivilege"] . "</td>
                <td>" . $row["user_completeness"] . "</td>
                <td>" . $row["user_mobilecrop"] . "</td>
                <td>" . $row["user_dailyrecommdate"] . "</td>
                <td>" . $row["user_dailydelete"] . "</td>
                <td>" . $row["user_subscribe"] . "</td>
                <td>" . $row["user_aadhar"] . "</td>
                <td>" . $row["user_aadhar_verify"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results found.";
}

// Close connection
$conn->close();
?>
