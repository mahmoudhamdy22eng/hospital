<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Sign Up</title>

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
                            <h1>Join Us Today!</h1>
                            <h5>Your Health, Our Priority : Sign Up Today for Compassionate Care!</h5>
                        </div>
                    </div>
                    <div class="col-md-7 col-md-pull-7">
                        <div class="booking-form">
                            <form id="doctorForm" method="POST" enctype="multipart/form-data">
                                <div class="form-group text-center">
                                    <label for="file" class="form-label"><b>Upload Your Profile Image</b></label><br>
                                    <img src="img/patient.png" 
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
                                        <label for="fname" class="form-label">First Name:</label>
                                        <input type="text" name="fname" id="fname" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="lname" class="form-label">Last Name:</label>
                                        <input type="text" name="lname" id="lname" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group form-inline">
                                        <label class="form-label mr-2">Gender : </label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="gender" id="male" value="1" 
                                                    class="form-check-input" required>
                                            <label class="form-check-label" for="male"> Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="gender" id="female" value="2" 
                                                    class="form-check-input" required>
                                            <label class="form-check-label" for="female"> Female</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="phone" class="form-label">Phone Number:</label>
                                        <input type="tel" name="phone" id="phone" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="illness" class="form-label">Your Illness (Department):</label>
                                        <select name="illness" id="illness" class="form-control" required
                                                onchange="filterDoctors()" placeholder="select one">
                                            <option selected disabled >select one</option>
                                            <option value="1" >surgery</option>
                                            <option value="2" >operation</option>
                                            <option value="3" >psychology</option>
                                            <option value="4" >emergency</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="doctor" class="form-label">Doctor:</label>
                                        <select name="doctor" id="doctor" class="form-control" required>
                                            <option selected disabled>select one</option>
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
                                    <div class="col-sm-6 form-group">
                                        <label for="UserName" class="form-label">Username:</label>
                                        <input type="text" name="UserName" id="UserName" class="form-control" 
                                                required>
                                    </div>
                                    <div class="col-sm-6 form-group"></div>
                                    <div class="col-sm-6 form-group">
                                        <label for="Password" class="form-label">Password:</label>
                                        <input type="password" name="Password" id="Password" class="form-control" 
                                                required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="confirmPassword" class="form-label">Confirm Password:</label>
                                        <input type="password" name="confirmPassword" id="confirmPassword" 
                                                class="form-control" required>
                                    </div>
                                    <div class="form-group text-center col-sm-12">
                                        <div class="form-check">
                                            <input type="checkbox" name="terms" id="terms" class="form-check-input" 
                                                    required>
                                            <label for="terms" class="form-check-label">
                                                I agree to the Terms and Conditions
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12 text-center">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
                                    <p class=" fw-bold mx-4 pt-1 mb-0">Already have an account? <a href="login.php"
                                        class="link-danger fw-bold text-danger">Sign In</a></p>
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
            const illness = document.getElementById("illness").value;
            const doctors = document.getElementById("doctor").options;
            const disabledOption = doctors[1];
            
            // Reset doctor selection
            document.getElementById("doctor").selectedIndex = 0;

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





<?php

$dsn = 'mysql:dbname=hospital;host=127.0.0.1;port=3306';
$user = 'root';
$pass = 'Ma123456*';

//  Check connection
try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store form inputs in session
    $_SESSION['form_data'] = $_POST;

        $target_dir = "files/";
        // File details
        $file = $_FILES["file"];
        $target_file = $target_dir . basename($file["name"]);
        $uploadstatus = 1;
        
        // Form data
        $isPatient = 2;
        $fname = htmlspecialchars($_POST['fname']);
        $lname = htmlspecialchars($_POST['lname']);
        $gender = htmlspecialchars($_POST['gender']);
        $phone = htmlspecialchars($_POST['phone']);
        $username = htmlspecialchars($_POST['UserName']);
        $password = htmlspecialchars($_POST['Password']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $confirmPassword = htmlspecialchars($_POST['confirmPassword']);
        $terms = isset($_POST['terms']);

        // Illness data 
        if (isset($_POST['illness'])) {
            $illness = htmlspecialchars($_POST['illness']); // <<<<<<< illness(department)
        }
        // Doctor data
        if (isset($_POST['doctor'])) {
            $doctor_id = htmlspecialchars($_POST['doctor']); // <<<<<<< doctor
        }

        $error = [];
        
// checks

        // File extension
        $imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        // Check image file or not
        if (empty($_FILES["file"]["tmp_name"])) {
            $error[] = "Please select an image file to upload.";
            $uploadstatus = 0;
        } elseif (!in_array($imageType, $allowedTypes)) {
            $error[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadstatus = 0;
        }
        else if (file_exists($target_file)) {
            $error[] = "Sorry, file already exists.";
            $uploadstatus = 0;
        }
        else {
            $check = @getimagesize($_FILES["file"]["tmp_name"]);
            if ($check === false) {
                $error[] = "File is not an image.";
                $uploadstatus = 0;
            }
        }
        // $check = getimagesize($_FILES["file"]["tmp_name"]);
        // if($check !== false) {
        //     $uploadstatus = 1;
        // } else {
        //     $error[] = "File is not an image.";
        //     $reset = $_POST['reset'];
        //     $uploadstatus = 0;
        // }

        // Check file size
        if ($_FILES["file"]["size"] > 5000000) {
            $error[] = "Sorry, your file is too large.";
            $uploadstatus = 0;
        }

        // check string first name and last name 
        if (!preg_match("/^[a-zA-Z-' ]*$/",$fname) || !preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
            $error[] = "Only letters and white space allowed";
            $uploadstatus = 0;
        }

        // check phone number (11 numbers) start with 0  
        if ( strlen($phone) != 11 || substr($phone, 0, 1) != 0) {
            $error[] = "Phone number should be 11 numbers, start with 0";
            // $reset = $_POST['reset'];
            $uploadstatus = 0;
        }

        // check username
        if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
            $error[] = "Only letters and white space allowed";
            $uploadstatus = 0;
        }

        // check password strong
        if (   strlen($password) < 8 
            || !preg_match("#[0-9]+#",$password) 
            || !preg_match("#[A-Z]+#",$password) 
            || !preg_match("#[a-z]+#",$password)) {
            $error[] = "Password should be at least 8 characters including at least one upper case letter, one number, and one special character.";
            $uploadstatus = 0;
        }

        // confirm password match
        if ($_POST['Password'] !== $_POST['confirmPassword']) {
            $error[] = "Password does not match";
            $uploadstatus = 0;
        }
    
        // Terms and conditions check
        if (!$terms) {
            $error[] = "You must agree to the terms and conditions.";
            $uploadstatus = 0;
        }

// Check uploadstatus
        if ($uploadstatus == 0) {
            $error[] = "please, try again.";
            
            foreach ($error as $value) { 
                echo "<script type='text/javascript'>alert('$value');</script>";
            }
        }
        

        // if uploadstatus is ok >>> try to upload file
else{
    if ($conn) {
// Insert the form data into the database
        // to user table
            try {
                $insertQuery = "INSERT INTO user (user_name, user_pass, u_type_no) 
                                    VALUES (:username, :pass, :isPatient)";
                $stmt = $conn->prepare($insertQuery);
                $stmt->bindValue(':username', $username);
                $stmt->bindValue(':pass', $hashed_password);
                $stmt->bindValue(':isPatient', $isPatient);

                $stmt->execute();
                $last_id = $conn->lastInsertId();
                // UPDATE patient SET patient_user_no = :last_id
                $updatePatient = "UPDATE patient SET patient_user_no = :last_id WHERE patient_user_no IS NULL";
                $stmt = $conn->prepare($updatePatient);
                $stmt->bindValue(':last_id', $last_id, PDO::PARAM_INT);

                $stmt->execute();

            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

        // to patient table
                try {
                    $insertPatient = "INSERT INTO patient (patient_name, patient_img, patient_phone, patient_dep_no,
                                        patient_gender, patient_user_no, patient_doc_no)
                                    VALUES (:fullname, :profileImage, :phone, :illness, 
                                            :gender, :user_id, :patient_doc_no)";
                    $stmt = $conn->prepare($insertPatient);
                    
                    $fullname = $_POST['fname'] . ' ' . $_POST['lname'];
                    $stmt->bindValue(':fullname', $fullname);
                    $stmt->bindValue(':profileImage', $target_file);
                    $stmt->bindValue(':phone', $phone);
                    $stmt->bindValue(':illness', $illness);
                    $stmt->bindValue(':gender', $gender);
                    $stmt->bindValue(':user_id', $last_id);
                    $stmt->bindValue(':patient_doc_no', $doctor_id);

                    $stmt->execute();
                    $last_id = $conn->lastInsertId();                           
                    // Update doc_pat table
                    $updateDocPat = "UPDATE doc_pat SET rel_patient = :last_id 
                                                    WHERE rel_patient IS NULL AND rel_doctor = :last_illness";
                    $stmt = $conn->prepare($updateDocPat);
                    $stmt->bindValue(':last_id', $last_id, PDO::PARAM_INT);
                    $stmt->bindValue(':last_illness', $doctor_id, PDO::PARAM_INT);
                    $stmt->execute();
                    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
                    
                    // Redirect to another page after successful execution
                    echo '<script>window.location.href = "success.php";</script>';
                    exit();
                    
                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            

        // to doc_pat table
                // try{
                    // $select = "SELECT doctor_id FROM doctor";
                    // $result = $conn->query($select);
                    // $doctor_id = $row['doctor_id'];

                //     $insertQuery = "INSERT INTO doc_pat (rel_doctor)
                //                     values (:doc_no)";
                //     $stmt = $conn->prepare($insertQuery);

                //     $stmt->bindParam(':doc_no',$doctor_id);
                //     // $stmt->bindParam(':pat_no',$);

                //     move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
                //     // Redirect to another page
                //     echo '<script>window.location.href = "success.php";</script>';

                //     $stmt->execute();
                //     // echo "Data inserted successfully.";

                // } catch(PDOException $e) {
                //     echo "Error: " . $e->getMessage();
                // }

        
                

            } else {
                $error[] = "Sorry, there was an error uploading your file."; 
                header("Location:". $_SERVER['PHP_SELF']);
                exit();
            }
        }
}

    // Close connection
    


    