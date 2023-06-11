<?php
// Database connection code here
// Include or require the db_connection.php file
require_once 'function/db_connection.php';
$conn = connectToDatabase();

// Database connection code here

// Fetching recipient details from the database
$sql = "SELECT `id`, `recipient_name`, `mobile_phone`, `mobile_phone_backup`, `house_number`, `group_name`, `village`, `alley`, `road`, `province`, `district`, `subdistrict`, `zip_code` FROM `recipient_details`";
// Execute the query and fetch the results
$result = $conn->query($sql);
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
    <h1>Welcome to Our Website</h1>



    <?php

    if ($result->num_rows > 0) {


      // Loop through the results and display them as cards
      while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
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
        ?>

        <div class=" row card mt-3  col-md-6">
          <div class="card-body">ชื่อผู้รับ (Name of Recipient):
            <h5 class="card-title">
              <?php echo $recipientName; ?>
            </h5>
            <p  >เบอร์โทรศัพท์มือถือ (Mobile Phone):
              <?php echo $mobilePhone; ?>
            </p>
            <p  >โทรศัพท์มือถือ (Backup Mobile Phone):
              <?php echo $mobilePhoneBackup; ?>
            </p>
            <p  >บ้านเลขที่ (House Number):
              <?php echo $houseNumber; ?>
            </p>
            <p  >กลุ่ม (Group): 
              <?php echo $groupName; ?>
            </p>
            <p  >หมู่บ้าน (Village):
              <?php echo $village; ?>
            </p>
            <p  >ตรอก (Alley):
              <?php echo $alley; ?>
            </p>
            <p  >ถนน (Road):
              <?php echo $road; ?>
            </p>
            <p  >จังหวัด (Province):
              <?php echo $province; ?>
            </p>
            <p  >อำเภอ/เขต (District):
              <?php echo $district; ?>
            </p>
            <p  >ตำบล/แขวง (Subdistrict):
              <?php echo $subdistrict; ?>
            </p>
            <p  >รหัสไปรษณีย์ (Zip Code):
              <?php echo $zipCode; ?>
            </p>
            <a href="edit_recipient.php?id=<?php echo $id; ?>" class="btn btn-primary">Edit</a>
          </div>
        </div>
        <?php
      }
    }
    ?>

  </div>
  </div>

  <?php
  // Include or require the db_connection.php file
  require_once 'template/footer.php';

  ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>