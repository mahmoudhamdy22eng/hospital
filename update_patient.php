<?php

// Check if patient_id is provided via GET parameter
if (!isset($_GET['patient_id'])) {
    // Handle case where patient_id is not provided
    // For example, redirect to a previous page or show an error message
    header('Location: previous_page.php');
    exit();
}

$patient_id = $_GET['patient_id'];

// Connect to the database
$dsn = 'mysql:dbname=hospital;host=127.0.0.1;port=3306';
$user = 'root';
$pass = 'Ma123456*';

try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query to fetch patient data based on patient_id
    $stmt = $conn->prepare("SELECT * FROM patient WHERE patient_id = :patient_id");
    $stmt->bindParam(':patient_id', $patient_id);
    $stmt->execute();
    
    // Fetch patient data
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Check if patient data exists
    if (!$patient) {
        // Handle case where patient data is not found
        // For example, redirect to a previous page or show an error message
        header('Location: previous_page.php');
        exit();
    }
    
    // Extract patient details
    $patient_name = $patient['patient_name'];
    $patient_img = $patient['patient_img'];
    $patient_phone = $patient['patient_phone'];
    $patient_dep_no = $patient['patient_dep_no'];
    $patient_doc_no = $patient['patient_doc_no'];
    $patient_deleted = $patient['is_deleted'];
    
    // Add more fields as needed
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Handle form submission for updating patient data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form data
    // Validate and sanitize inputs
    $new_patient_name = $_POST['patient_name'];
    if(isset($_POST['patient_img'])) {
        $new_patient_img = $_POST['patient_img'];
    } else {
        $new_patient_img = $patient_img;
    } 
    $new_patient_phone = $_POST['patient_phone'];
    $new_patient_dep_no = $_POST['patient_dep_no'];
    $new_patient_doc_no = $_POST['patient_doc_no'];
    $new_patient_deleted = $_POST['is_deleted'];
    
    // Check if a file was uploaded
    if ($_FILES['file']['error'] === 0) {
        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        $file_size = $file['size'];
        $file_destination = 'files/' . $file_name;

        // Move the uploaded file to the destination folder
        if (move_uploaded_file($file_tmp_name, $file_destination)) {
            // Update patient data with the new image path
            $patient_img = $file_destination;
        } else {
            // Handle file upload error if necessary
        }
    } else {
        // No new file uploaded, retain current image path from database
        $patient_img = $_POST['current_img']; // Assuming you have a hidden input for current image path
    }

    // Update patient data in the database
    try {
        $update_stmt = $conn->prepare("UPDATE patient SET patient_name = :patient_name, patient_phone = :patient_phone,
                                                    patient_img = :patient_img, patient_dep_no = :patient_dep_no, 
                                                    patient_doc_no = :patient_doc_no, is_deleted = :patient_deleted 
                                                    WHERE patient_id = :patient_id");
        $update_stmt->bindParam(':patient_name', $new_patient_name);
        $update_stmt->bindParam(':patient_img', $file_destination);
        $update_stmt->bindParam(':patient_phone', $new_patient_phone);
        $update_stmt->bindParam(':patient_dep_no', $new_patient_dep_no);
        $update_stmt->bindParam(':patient_doc_no', $new_patient_doc_no);
        $update_stmt->bindParam(':patient_deleted', $new_patient_deleted);
        $update_stmt->bindParam(':patient_id', $patient_id);
        
        $update_stmt->execute();
        
        // Redirect to a success page or back to the profile page
        echo '<script>window.location.href = "profile.php";alert("Patient ' . $patient_name .'to Patient : '. $new_patient_name .', Update successful!");</script>';
        exit();
    } catch(PDOException $e) {
        echo "Update failed: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Update Patient</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="fontawesome-free-6.5.2-web/css/all.min.css"/>
    <link rel="stylesheet" href="form.css">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: auto;
        }
    </style>
</head>

<body>
    <div id="booking" class="section mt-5 mb-5">
        <div class="section-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-push-5">
                        <div class="booking-cta">
                            <button type="button" class="btn btn-danger align-self-center" 
                                onclick="location.href='signup.php'">
                                <i class="fa-solid fa-angles-left"></i> Back
                            </button>
                            <h1>Update Patient!</h1>
                            <!-- <h5>Your Health, Our Priority : Sign Up Today for Compassionate Care!</h5> -->
                        </div>
                    </div>
                    <div class="col-md-7 col-md-pull-7">
                        <div class="booking-form">
                            <form id="doctorForm" method="POST" enctype="multipart/form-data">
                                <div class="form-group text-center">
                                    <label for="file" class="form-label"><b>Upload Your Profile Image</b></label><br>
                                    <img src="<?php echo htmlspecialchars($patient_img); ?>" 
                                        onmouseover="this.style.opacity='0.7', this.style.transform='scale(1.1)'" 
                                        onmouseout="this.style.opacity='1', this.style.transform='scale(1)'"
                                        alt="Profile Image" id="profileimg" width="220" height="200"
                                        onclick="document.getElementById('fileInput').click();"
                                        style="cursor: pointer;"><br>
                                    <input type="file" accept="image/*" onchange="imagefile(event)" 
                                            style="display: none;"
                                        id="fileInput" name="file" class="form-control-file" id="file">
                                </div>
                                <div class="row align-items-center container justify-content-center">
                                    <div class="col-sm-6 form-group">
                                    <label for="patient_name" class="form-label">Patient Name</label>
                                    <input type="text" class="form-control" id="patient_name" name="patient_name" 
                                            value="<?php echo htmlspecialchars($patient_name); ?>" required>
                                            </div>
                                    <div class="col-sm-6 form-group ">
                                        <label for="is_deleted" class="form-label">Is Deleted</label><br>
                                        <select class="form-control" id="is_deleted" name="is_deleted" required>
                                            <option value="0" <?php if ($patient_deleted == 0) echo 'selected'; ?>>No</option>
                                            <option value="1" <?php if ($patient_deleted == 1) echo 'selected'; ?>>Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 form-group form-inline">
                                    <label for="patient_phone" class="form-label">Patient Phone</label>
                                    <input type="text" class="form-control" id="patient_phone" name="patient_phone" 
                                            value="<?php echo htmlspecialchars($patient_phone); ?>" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="patient_dep_no" class="form-label">Illness (Department):</label>
                                        <select name="patient_dep_no" id="patient_dep_no" class="form-control" required
                                                onchange="filterDoctors()" placeholder="select one">
                                            <option selected disabled ><?php
                                            if($patient_dep_no == 1){
                                                echo "Current: surgery";
                                            }elseif($patient_dep_no == 2){
                                                echo "Current: operation";
                                            }elseif($patient_dep_no == 3){
                                                echo "Current: psychology";
                                            }elseif($patient_dep_no == 4){
                                                echo "Current: emergency";
                                            }
                                            ?></option>
                                            <option value="1" >surgery</option>
                                            <option value="2" >operation</option>
                                            <option value="3" >psychology</option>
                                            <option value="4" >emergency</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="patient_doc_no" class="form-label">Doctor:</label>
                                        <select name="patient_doc_no" id="patient_doc_no" class="form-control" required>
                                            <option selected disabled><?php 
                                            $stmt = $conn->prepare("SELECT doctor_name FROM doctor WHERE doctor_id = :doctor_id");
                                            $stmt->bindParam(':doctor_id', $patient_doc_no);
                                            $stmt->execute();
                                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                            $doctor_name = $row['doctor_name'];
                                            echo htmlspecialchars($doctor_name); ?></option>
                                            <option style="display:block" disabled>Choose illness first</option>
                                            <?php
                                            // start session
                                            // session_start();
                                                $dsn = 'mysql:dbname=hospital;host=127.0.0.1;port=3306';
                                                $user = 'root';
                                                $pass = 'Ma123456*';

                                                    $conn = new PDO($dsn, $user, $pass);
                                                    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                                // Query to fetch doctor names and department numbers
                                                $select = "SELECT doctor_id, doctor_name, doctor_dep_no FROM doctor";
                                                $result = $conn->query($select);
                                                if (!$result) {
                                                    die("Query failed: " . $conn->error);
                                                }

                                                // Loop through the query results to populate options
                                                if ($result->rowCount() > 0) {
                                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                        $doctor_name = $row['doctor_name'];
                                                        $doctor_dep_no = $row['doctor_dep_no'];
                                                        $doctor_id = $row['doctor_id'];
                                                        echo "<option style='display:none' id=\"$doctor_dep_no\"
                                                                value=\"$doctor_id\">$doctor_name</option>";
                                                    }
                                                } else {
                                                    echo "<option value=\"\">No doctors found</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-12 text-center">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Update Patient</button>
                                    <p class=" fw-bold mx-4 pt-1 mb-0"> <a href="login.php"
                                        class="link-danger fw-bold text-danger">Sign In</a> Or <a href="signup.php"
                                        class="link-danger fw-bold text-danger">Sign Up</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

    // Show/Hide doctors
        function filterDoctors() {
            const illness = document.getElementById("patient_dep_no").value;
            const doctors = document.getElementById("patient_doc_no").options;
            const disabledOption = doctors[1];
            
            // Reset doctor selection
            document.getElementById("patient_doc_no").selectedIndex = 0;

            // Show/hide options based on the selected in illness
            for (let i = 1; i < doctors.length; i++) { // i = 1 to skip the "disabled" option
                const option = doctors[i];
                if (option.id === illness) {
                    option.style.display = 'block';
                    disabledOption.style.display = 'none';
                } else {
                    option.style.display = 'none';
                }
            }
        } 


    // Image Upload
        function imagefile(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileimg').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

</script>
</body>
</html>
