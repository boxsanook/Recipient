<?php
    // Include or require the db_connection.php file
    require_once 'function/db_connection.php';
    $conn = connectToDatabase();
    

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
        <form action="process_form.php" method="POST">
            <div class="row">
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <label for="recipient-name" class="form-label">ชื่อผู้รับ (Name of Recipient):</label>
                        <input type="text" id="recipient-name" name="recipient-name" class="form-control" required>

                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="mobile-phone" class="form-label">เบอร์โทรศัพท์มือถือ (Mobile Phone):</label>
                            <input type="text" id="mobile-phone" name="mobile-phone" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row col-md-12">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="mobile-phone-backup" class="form-label">โทรศัพท์มือถือ (Backup Mobile
                                Phone):</label>
                            <input type="text" id="mobile-phone-backup" name="mobile-phone-backup" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="house-number" class="form-label">บ้านเลขที่ (House Number):</label>
                            <input type="text" id="house-number" name="house-number" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row col-md-12">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="group" class="form-label">กลุ่ม (Group):</label>
                            <input type="text" id="group" name="group" class="form-control">


                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">

                            <label for="village" class="form-label">หมู่บ้าน (Village):</label>
                            <input type="text" id="village" name="village" class="form-control">

                        </div>
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <div class="mb-3">

                            <label for="alley" class="form-label">ตรอก (Alley):</label>
                            <input type="text" id="alley" name="alley" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">

                            <label for="road" class="form-label">ถนน (Road):</label>
                            <input type="text" id="road" name="road" class="form-control">
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
                                $query = "SELECT distinct * FROM `provinces` ";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['name_th'] . ' - ' . $row['name_en'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="district" class="form-label">อำเภอ/เขต (District):</label> 
                         
                            <select class="form-control" id="district" name="district" class="form-control" required onchange="filterData_district()">
                            <option value="">Select District</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="subdistrict" class="form-label">ตำบล/แขวง (Subdistrict):</label> 
                            <select class="form-control" id="subdistrict" name="subdistrict" class="form-control" required onchange="filterData_subdistrict()">
                            <option value="">Select Subdistrict</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="zip-code" class="form-label">รหัสไปรษณีย์ (Zip Code):</label> 
                            <select class="form-control"  id="zip-code" name="zip-code" class="form-control" required>
                            <option value="">Select Zip Code</option>
                            </select>
                            
                        </div>
                    </div>
                </div> 

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>



    <?php
    // Include or require the db_connection.php file
    require_once 'template/footer.php';

    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="js/script.js"></script>
</body>

</html>