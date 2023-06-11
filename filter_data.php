<?php
// Database connection code here
// Include or require the db_connection.php file
require_once 'function/db_connection.php';
$conn = connectToDatabase();

// Check if the provinceId parameter is set
if (isset($_POST['provinceId'])) {
    $provinceId = $_POST['provinceId'];
    $districtId = $subdistrictId ="";
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
    }

    if (isset($_POST['districtId'])) {
        $districtId =" and districts_id=". $_POST['districtId'];
    }

    if (isset($_POST['subdistrictId'])) {
        $subdistrictId =" and id=". $_POST['subdistrictId'];
    }

    

    // Fetch the filtered data from the database
    $districtsQuery = "SELECT * FROM `districts` WHERE `province_id` = $provinceId";
    $districtsResult = $conn->query($districtsQuery);
    $districts = array();
    while ($district = $districtsResult->fetch_assoc()) {
        $districtData = array();
        $districtData["name"] = $district['name_th'] . ' - ' . $district['name_en'];
        $districtData["id"] = $district['id'];
        $districts[] = $districtData;
    }

    $subdistrictsQuery = "SELECT * FROM `subdistricts` WHERE `provinces_id` = $provinceId" .$districtId . $subdistrictId;
    $subdistrictsResult = $conn->query($subdistrictsQuery);
    $subdistricts = array();
    while ($subdistrict = $subdistrictsResult->fetch_assoc()) {
        $districtData = array();
        $districtData["name"] = $subdistrict['name_th'] . ' - ' . $subdistrict['name_en'];
        $districtData["id"] = $subdistrict['id'];
        $subdistricts[] = $districtData;
    }

    $zipCodesQuery = "SELECT distinct zip_code   FROM `subdistricts` WHERE `provinces_id` = $provinceId " .$districtId . $subdistrictId ;
    $zipCodesResult = $conn->query($zipCodesQuery);
    $zipCodes = array();
    while ($zipCode = $zipCodesResult->fetch_assoc()) {

        $districtData = array();
        $districtData["name"] = $zipCode['zip_code'];
        $districtData["id"] = $zipCode['zip_code'];
        $zipCodes[] = $districtData;
    }

    // Prepare the response data
    $responseData = array(
        'districts' => $districts,
        'subdistricts' => $subdistricts,
        'zipCodes' => $zipCodes
    );

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($responseData);
}
?>