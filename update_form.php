<?php
// Include or require the db_connection.php file
require_once 'function/db_connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $recipientName = $_POST['recipient-name'];
    $mobilePhone = $_POST['mobile-phone'];
    $mobilePhoneBackup = $_POST['mobile-phone-backup'];
    $houseNumber = $_POST['house-number'];
    $groupName = $_POST['group'];
    $village = $_POST['village'];
    $alley = $_POST['alley'];
    $road = $_POST['road'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $subdistrict = $_POST['subdistrict'];
    $zipCode = $_POST['zip-code'];

    // Validate and sanitize the form data
    // Add your validation and sanitization logic here

    $conn = connectToDatabase();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE recipient_details SET 
            recipient_name = '$recipientName',
            mobile_phone = '$mobilePhone',
            mobile_phone_backup = '$mobilePhoneBackup',
            house_number = '$houseNumber',
            group_name = '$groupName',
            village = '$village',
            alley = '$alley',
            road = '$road',
            province = '$province',
            district = '$district',
            subdistrict = '$subdistrict',
            zip_code = '$zipCode'
            WHERE id = 1"; // Replace id with the actual ID of the recipient

    if ($conn->query($sql) === TRUE) {
        echo "Recipient details updated successfully.";
      
    } else {
        echo "Error updating recipient details: " . $conn->error;
    }

    $conn->close();
    header('Location: index.php');
    exit;
}
?>