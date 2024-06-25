<?php
// Check if doctor_id is provided via GET parameter
if (!isset($_GET['doctor_id'])) {
    // Handle case where doctor_id is not provided
    // For example, redirect to a previous page or show an error message
    header('Location: previous_page.php');
    exit();
}

$doctor_id = $_GET['doctor_id'];

// Connect to the database
$dsn = 'mysql:dbname=hospital;host=127.0.0.1;port=3306';
$user = 'root';
$pass = 'Ma123456*';

try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query to fetch doctor data based on doctor_id
    $stmt = $conn->prepare("SELECT * FROM doctor WHERE doctor_id = :doctor_id");
    $stmt->bindParam(':doctor_id', $doctor_id);
    $stmt->execute();
    
    // Fetch doctor data
    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Check if doctor data exists
    if (!$doctor) {
        // Handle case where doctor data is not found
        // For example, redirect to a previous page or show an error message
        header('Location: previous_page.php');
        exit();
    }
    
    // Extract doctor details
    $doctor_name = $doctor['doctor_name'];
    $doctor_img = $doctor['doctor_img'];
    $doctor_phone = $doctor['doctor_phone'];
    $doctor_dep_no = $doctor['doctor_dep_no'];
    $doc_schedule_start = $doctor['doc_schedule_start'];
    $doc_schedule_end = $doctor['doc_schedule_end'];
    $doctor_deleted = $doctor['is_deleted'];
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Handle form submission for updating doctor data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $new_doctor_name = $_POST['doctor_name'];
    $new_doctor_phone = $_POST['doctor_phone'];
    $new_doctor_dep_no = $_POST['doctor_dep_no'];
    $new_doc_schedule_start = $_POST['doc_schedule_start'];
    $new_doc_schedule_end = $_POST['doc_schedule_end'];
    $new_doctor_deleted = $_POST['is_deleted'];
    
    // Check if a file was uploaded
    if ($_FILES['file']['error'] === 0) {
        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        $file_size = $file['size'];
        $file_destination = 'files/' . $file_name;

        // Move the uploaded file to the destination folder
        if (empty($_POST['doctor_img']) || !isset($_POST['doctor_img'])) {
            // No new file uploaded, retain current image path from database
            $doctor_img = $doctor['doctor_img'];
        } else {
            $file = $_FILES['file'];
            $file_name = $file['name'];
            $file_tmp_name = $file['tmp_name'];
            $file_size = $file['size'];
            $file_destination = 'files/' . $file_name;

            if (move_uploaded_file($file_tmp_name, $file_destination)) {
                // Update patient data with the new image path
                $doctor_img = $file_destination;
            } else {
                // Handle file upload error if necessary
            }
        }
    }

    // Update doctor data in the database
    try {
        $update_stmt = $conn->prepare("UPDATE doctor SET doctor_name = :doctor_name, doctor_phone = :doctor_phone,
                                                    doctor_img = :doctor_img, doctor_dep_no = :doctor_dep_no, 
                                                    doc_schedule_start = :doc_schedule_start, doc_schedule_end = :doc_schedule_end,
                                                    is_deleted = :doctor_deleted 
                                                    WHERE doctor_id = :doctor_id");
        $update_stmt->bindParam(':doctor_name', $new_doctor_name);
        $update_stmt->bindParam(':doctor_img', $file_destination);
        $update_stmt->bindParam(':doctor_phone', $new_doctor_phone);
        $update_stmt->bindParam(':doctor_dep_no', $new_doctor_dep_no);
        $update_stmt->bindParam(':doc_schedule_start', $new_doc_schedule_start);
        $update_stmt->bindParam(':doc_schedule_end', $new_doc_schedule_end);
        $update_stmt->bindParam(':doctor_deleted', $new_doctor_deleted);
        $update_stmt->bindParam(':doctor_id', $doctor_id);
        
        $update_stmt->execute();
        
        // Redirect to a success page or back to the profile page
        echo '<script>window.location.href = "profile.php";alert("Dr. '.$doctor_name.' to Dr.'.$new_doctor_name.' Update successful!");</script>';
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
    <title>Update Doctor</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
                            <h1>Update Doctor!</h1>
                        </div>
                    </div>
                    <div class="col-md-7 col-md-pull-7">
                        <div class="booking-form">
                            <form id="doctorForm" method="POST" enctype="multipart/form-data">
                                <div class="form-group text-center">
                                    <label for="file" class="form-label"><b>Upload Doctor's Profile Image</b></label><br>
                                    <img src="<?php echo htmlspecialchars($doctor_img); ?>" 
                                        onmouseover="this.style.opacity='0.7', this.style.transform='scale(1.1)'" 
                                        onmouseout="this.style.opacity='1', this.style.transform='scale(1)'"
                                        alt="Profile Image" id="profileimg" width="220" height="200"
                                        onclick="document.getElementById('fileInput').click();"
                                        style="cursor: pointer;"><br>
                                    <input type="file" accept="image/*" onchange="imagefile(event)" required 
                                        style="display: none;" id="fileInput" name="file" class="form-control-file">
                                </div>
                                <div class="row align-items-center container justify-content-center">
                                    <div class="col-sm-6 form-group">
                                        <label for="doctor_name" class="form-label">Doctor's Name</label>
                                        <input type="text" class="form-control" id="doctor_name" name="doctor_name" 
                                            value="<?php echo htmlspecialchars($doctor_name); ?>" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="is_deleted" class="form-label">Is Deleted</label><br>
                                        <select class="form-control" id="is_deleted" name="is_deleted" required>
                                            <option value="0" <?php if ($doctor_deleted == 0) echo 'selected'; ?>>No</option>
                                            <option value="1" <?php if ($doctor_deleted == 1) echo 'selected'; ?>>Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 form-group form-inline">
                                        <label for="doctor_phone" class="form-label">Doctor's Phone</label>
                                        <input type="text" class="form-control" id="doctor_phone" name="doctor_phone" 
                                            value="<?php echo htmlspecialchars($doctor_phone); ?>" required>
                                    </div>
                                    <div class="col-sm-6 form-group form-inline">
                                        <label for="doctor_dep_no" class="form-label">Doctor's Department:</label>
                                        <select name="doctor_dep_no" id="doctor_dep_no" class="form-control" required>
                                            <option selected disabled ><?php
                                            if($doctor_dep_no == 1){
                                                echo "Current: surgery";
                                            }elseif($doctor_dep_no == 2){
                                                echo "Current: operation";
                                            }elseif($doctor_dep_no == 3){
                                                echo "Current: psychology";
                                            }elseif($doctor_dep_no == 4){
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
                                        <label for="doc_schedule_start" class="form-label">Schedule Start</label>
                                        <input type="time" class="form-control" id="doc_schedule_start" name="doc_schedule_start" 
                                            value="<?php echo htmlspecialchars($doc_schedule_start); ?>" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="doc_schedule_end" class="form-label">Schedule End</label>
                                        <input type="time" class="form-control" id="doc_schedule_end" name="doc_schedule_end" 
                                            value="<?php echo htmlspecialchars($doc_schedule_end); ?>" required>
                                    </div>
                                    <div class="form-group col-sm-12 text-center">
                                        <button type="submit" name="submit" class="btn btn-primary btn-lg"
                                                onclick="return validateForm()">Update Doctor</button>
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
        // Image Upload Preview
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

        // Function to validate file upload before form submission
        function validateForm() {
            var fileInput = document.getElementById('fileInput');
            if (!fileInput.value) {
                alert('Please upload a profile image.');
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>
</body>

</html>
