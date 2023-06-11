<?php
// Include or require the db_connection.php file
require_once 'function/db_connection.php';
// Retrieve recipient details from the database and populate the form fields
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $conn = connectToDatabase();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM recipient_details WHERE   id='" . $id . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $recipientName = $row['recipient_name'];
        $mobilePhone = $row['mobile_phone'];
        $mobilePhoneBackup = $row['mobile_phone_backup'];
        $houseNumber = $row['house_number'];
        $groupName = $row['group_name'];
        $village = $row['village'];
        $alley = $row['alley'];
        $road = $row['road'];
        $province = $row['province'];
        $district = $row['district'];
        $subdistrict = $row['subdistrict'];
        $zipCode = $row['zip_code'];
        // Display form fields with populated values

    }

}

?>



<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php
    // Include or require the db_connection.php file
    require_once 'template/navbar.php';

    ?>

    <div class="container mt-5">
        <h2>Recipient Details</h2>
        <form action="update_form.php" method="POST">




            <div class="row">
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <label for="recipient-name" class="form-label">ชื่อผู้รับ (Name of Recipient):</label>
                        <input type="text" id="recipient-name" name="recipient-name" class="form-control" required
                            value="<?php echo $recipientName; ?>">

                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="mobile-phone" class="form-label">เบอร์โทรศัพท์มือถือ (Mobile
                                Phone):</label>
                            <input type="text" id="mobile-phone" name="mobile-phone" class="form-control" required
                                value="<?php echo $mobilePhone; ?>">
                        </div>
                    </div>
                </div>

                <div class="row col-md-12">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="mobile-phone-backup" class="form-label">โทรศัพท์มือถือ (Backup Mobile
                                Phone):</label>
                            <input type="text" id="mobile-phone-backup" name="mobile-phone-backup" class="form-control"
                                value="<?php echo $mobilePhoneBackup; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="house-number" class="form-label">บ้านเลขที่ (House Number):</label>
                            <input type="text" id="house-number" name="house-number" class="form-control" required
                                value="<?php echo $houseNumber; ?>">
                        </div>
                    </div>
                </div>

                <div class="row col-md-12">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="group" class="form-label">กลุ่ม (Group):</label>
                            <input type="text" id="group" name="group" class="form-control"
                                value="<?php echo $groupName; ?>">


                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">

                            <label for="village" class="form-label">หมู่บ้าน (Village):</label>
                            <input type="text" id="village" name="village" class="form-control"
                                value="<?php echo $village; ?>">

                        </div>
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <div class="mb-3">

                            <label for="alley" class="form-label">ตรอก (Alley):</label>
                            <input type="text" id="alley" name="alley" class="form-control"
                                value="<?php echo $alley; ?>">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">

                            <label for="road" class="form-label">ถนน (Road):</label>
                            <input type="text" id="road" name="road" class="form-control" value="<?php echo $road; ?>">
                        </div>

                    </div>
                </div>


                <div class="row col-md-12">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="province" class="form-label">จังหวัด (Province):</label>

                            <select class="form-control" id="province" name="province" onchange="filterData_province()">
                                <option value="">Select Province</option>
                                <?php
                                // Perform the database query to fetch the provinces
                                $conn = connectToDatabase();
                                $query = "SELECT distinct * FROM `provinces` ";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($province == $row['id']) {
                                        echo '<option value="' . $row['id'] . '" select>' . $row['name_th'] . ' - ' . $row['name_en'] . '</option>';
                                    } else {
                                        echo '<option value="' . $row['id'] . '">' . $row['name_th'] . ' - ' . $row['name_en'] . '</option>';
                                    } 
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="district" class="form-label">อำเภอ/เขต (District):</label>

                            <select class="form-control" id="district" name="district" class="form-control" required
                                onchange="filterData_district()">
                                <option value="">Select District</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row col-md-12">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="subdistrict" class="form-label">ตำบล/แขวง (Subdistrict):</label>
                            <select class="form-control" id="subdistrict" name="subdistrict" class="form-control"
                                required onchange="filterData_subdistrict()">
                                <option value="">Select Subdistrict</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="zip-code" class="form-label">รหัสไปรษณีย์ (Zip Code):</label>
                            <select class="form-control" id="zip-code" name="zip-code" class="form-control" required>
                                <option value="">Select Zip Code</option>
                            </select>

                        </div>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>



    <?php
    // Include or require the db_connection.php file
    require_once 'template/footer.php';
    $conn->close();
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script>
        document.getElementById('province').value = <?php echo $province ?>; // Replace 'mySelect' with the ID of your select element  

        setTimeout(function () {
            filterData_province()
        }, 2000); // Sleep for 2 seconds (2000 milliseconds)

        setTimeout(function () {
            console.log("Before sleep");
            document.getElementById('subdistrict').value = <?php echo $subdistrict ?>; // Replace 'mySelect' with the ID of your select element   
            document.getElementById('district').value = <?php echo $district ?>; // Replace 'mySelect' with the ID of your select element   
            document.getElementById('zip-code').value = <?php echo $zipCode ?>; // Replace 'mySelect' with the ID of your select element 
        }, 2500); // Sleep for 2 seconds (2000 milliseconds)



    </script>

</body>

</html>