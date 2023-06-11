<?php
// Get the form data
$recipientName = $_POST['recipient-name'];
$mobilePhone = $_POST['mobile-phone'];
$mobilePhoneBackup = $_POST['mobile-phone-backup'];
$houseNumber = $_POST['house-number'];
$group = $_POST['group'];
$village = $_POST['village'];
$alley = $_POST['alley'];
$road = $_POST['road'];
$province = $_POST['province'];
$district = $_POST['district'];
$subdistrict = $_POST['subdistrict'];
$zipCode = $_POST['zip-code'];

// Database connection configuration
$host = "127.0.0.1";
$username = "root";
$password = "";
$db = "demo_shipping";

// Create a new MySQLi instance
$conn = new mysqli($host, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the INSERT statement
$stmt = $conn->prepare("INSERT INTO recipient_details (recipient_name, mobile_phone, mobile_phone_backup, house_number, group_name, village, alley, road, province, district, subdistrict, zip_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssss", $recipientName, $mobilePhone, $mobilePhoneBackup, $houseNumber, $group, $village, $alley, $road, $province, $district, $subdistrict, $zipCode);

// Execute the prepared statement
if ($stmt->execute()) {
    echo "Recipient details saved successfully.";

} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();
header('Location: index.php');
exit;
?>