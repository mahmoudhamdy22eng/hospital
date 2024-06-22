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
	
	<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->
	<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
	
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
                                                    <i class="fa-solid fa-angles-left"></i> Back</button>
							<h1>join our team</h1>
							<h5 >Welcome, Doctor! We're thrilled to have you sign up with us.</h5>
						</div>
					</div>
<!-- doctor form -->
					<div class="col-md-7 col-md-pull-7">
						<div class="booking-form">
						<form id="doctorForm" method="POST" enctype="multipart/form-data" >
							<!-- Image -->
							<div class="form-group text-center">
								<label for="file" class="form-label"><b>Upload Your Profile Image</b></label><br>
								<img src="img/doctor.png" 
                                	onmouseover="this.style.opacity='0.7', this.style.transform='scale(1.1)'" 
                                	onmouseout="this.style.opacity='1', this.style.transform='scale(1)'"
                                	alt="Profile Image" id="profileimg" width="300" height="200"
                                	onclick="document.getElementById('fileInput').click();"
                                	style ="cursor: pointer;"><br>
                        		<input type="file" accept="image/*" onchange="imagefile(event)" style="display: none;"
                                	id="fileInput" name="file" class="form-control-file" id="file" >
							</div>
							<!-- First Name -->
							<div class="row align-items-center container justify-content-center">
								<div class="col-sm-6 form-group">
								<label for="fname" class="form-label">First Name:</label>
                        		<input type="text" name="fname" id="fname" class="form-control" required>
								</div>

							<!-- Last Name -->
								<div class="col-sm-6 form-group">
								<label for="lname" class="form-label">Last Name:</label>
                        		<input type="text" name="lname" id="lname" class="form-control" required>
							</div>

							<!-- gender -->
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

							<!-- Phone No. -->
							<div class="col-sm-6 form-group">
								<label for="phone" class="form-label">Phone Number:</label>
								<input type="tel" name="phone" id="phone" class="form-control" required>
							</div>

							<!-- Department -->
							<div class="col-sm-6 form-group">
								<label for="department" class="form-label">Department:</label>
								<select name="department" id="department" class="form-control" required>
									<option selected disabled>select one</option>
									<option value="1">surgery</option>
									<option value="2">operation</option>
									<option value="3">psychology</option>
									<option value="4">emergency</option>
								</select>
							</div>

							<!-- empty -->
							<div class="col-sm-6 form-group">
								
							</div>

							<!-- schedule -->
							<div class="col-sm-12 form-group">
								<label for="start-time" class="form-label">Schedule:</label>
								<div class="row">
									<div class="col-sm-5">
										<input type="time" name="start-time" id="start-time" class="form-control" required>
									</div>
									<div class="col-sm-2 text-md-center mb-2 mb-md-0">to</div>
									<div class="col-sm-5">
										<input type="time" name="end-time" id="end-time" class="form-control" required>
									</div>
                        		</div>
							</div>

							<!-- Username -->
							<div class="col-sm-6 form-group">
								<label for="UserName" class="form-label">Username:</label>
								<input type="text" name="UserName" id="UserName" class="form-control" required>
							</div>
							
							<!-- empty -->
							<div class="col-sm-6 form-group">
								
							</div>

							<!-- Password -->
							<div class="col-sm-6 form-group">
							<label for="Password" class="form-label">Password:</label>
                        	<input type="password" name="Password" id="Password" class="form-control" required>
							</div>

							<!-- confirm password -->
							<div class="col-sm-6 form-group">
								<label for="confirmPassword" class="form-label">Confirm Password:</label>
                        		<input type="password" name="confirmPassword" id="confirmPassword" 
                                                class="form-control" required>
							</div>

							<!-- terms & conditions -->
							<div class="form-group text-center col-sm-12">
								<div class="form-check">
                            		<input type="checkbox" name="terms" id="terms" class="form-check-input" required>
                            		<label for="terms" class="form-check-label">
																I agree to the Terms and Conditions</label>
                        		</div>
							</div>

							<!-- Submit -->
							<div class="form-group col-sm-12 text-center">
								<input type="submit" name="submit" class="btn btn-primary btn-lg"></input>
                                <p class=" fw-bold mx-4 pt-1 mb-0">Already have an account? <a href="login.php"
                                class="link-danger fw-bold text-danger">Sign In</a></p>
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close shadow-none d-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" onclick="redirectToLogin()">
                    <div class="text-center">
                        <div class="d-flex justify-content-center pb-2">
                            <div class="check-container d-flex justify-content-center align-items-center rounded-pill">
                                <i class="fa-solid fa-check" style="color: #fff; font-size: 36px"></i>
                            </div>
                        </div>
                        <h1 class="fw-bold">Successfully signed up!</h1>
                        <p class="fw-bold">Now You are ready to log in.</p>
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center footer-color rounded-0 position-relative">
                    <div class="angle"></div>
                    <div class="text-center p-4">
                        <button type="button" class="btn shadow-none footer-btn text-white rounded-2 px-5"
                            onclick="redirectToLogin()">Log in</button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


<!-- Scripts -->


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<script>
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

		// Modal success
$(document).ready(function() {
    $('#myForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        // Perform AJAX submission
        $.ajax({
            type: 'POST',
            url: 'submit_form.php',
            data: $(this).serialize(), // Serialize form data
            success: function(response) {
                // Show success modal
                $('#successModal').modal('show');
                $('#successMessage').text(response.message);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                // Handle errors if needed
            }
        });
    });
});


    </script>
</body>
</html>


<!-- php -->
<?php  

// session_start();

// Connect to database 
$dsn = 'mysql:dbname=hospital;host=127.0.0.1;port=3306';
$user = 'root';
$pass = 'Ma123456*';

try {
$conn = new PDO($dsn, $user, $pass); 

// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Connected successfully";
} catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Store form inputs in session
	// $_SESSION_start();
    // $_SESSION['form_data'] = $_POST;

        $target_dir = "files/";
        // File details
        $file = $_FILES["file"];
        $target_file = $target_dir . basename($file["name"]);
        $uploadstatus = 1;
        
        // Form data
        $isDoctor = 1;
        $fname = htmlspecialchars($_POST['fname']);
        $lname = htmlspecialchars($_POST['lname']);
        $gender = htmlspecialchars($_POST['gender']);
        $phone = htmlspecialchars($_POST['phone']);
        $username = htmlspecialchars($_POST['UserName']);
        $password = htmlspecialchars($_POST['Password']);
        $confirmPassword = htmlspecialchars($_POST['confirmPassword']);
        $terms = isset($_POST['terms']);
    
        // Additional data for doctors
        $isDoctor = isset($_POST['department']);
        if ($isDoctor) {
            $department = htmlspecialchars($_POST['department']);
            $start_time = htmlspecialchars($_POST['start-time']);
            $end_time = htmlspecialchars($_POST['end-time']);
        }
        
        $error = [];
        
// checks
        // make image file required if not uploaded
        // if (empty($file["name"])) {
        //     $error[] = "Please select an image file to upload1.";
        //     $uploadstatus = 0;
        // }
        
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

        // Check file size
        if ($_FILES["file"]["size"] > 5000000) {
            $error[] = "Sorry, your file is too large.";
            $uploadstatus = 0;
        }

        // check string first name and last name 
        if (!preg_match("/^[a-zA-Z-' ]*$/",$fname) || !preg_match("/^[a-zA-Z-' ]*$/",$lname)
                || strlen($fname) > 15 || strlen($lname) > 15 ) {
            $error[] = "Only letters and white space allowed and maximum 15 characters";
            $uploadstatus = 0;
        }

        // check phone number (11 numbers) start with 0  
        if ( strlen($phone) != 11 || substr($phone, 0, 1) != 0) {
            $error[] = "Phone number should be 11 numbers, start with 0";
            $uploadstatus = 0;
        }
        // Check phone number already exists in database
        $checkPhone = $conn->prepare("SELECT * FROM doctor WHERE doctor_phone = :phone");
        $checkPhone->bindParam(':phone', $phone);
        $checkPhone->execute();
        if ($checkPhone->rowCount() > 0) {
            $error[] = "Phone number already exists.";
        }

        // check username
        if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
            $error[] = "Only letters and white space allowed";
            $uploadstatus = 0;
        }

        // Check username already exists in database
        $checkUsername = $conn->prepare("SELECT * FROM user WHERE user_name = :username");
        $checkUsername->bindParam(':username', $username);
        $checkUsername->execute();
        if ($checkUsername->rowCount() > 0) {
            $error[] = "Username already exists.";
        }


        // check password strong
        if (strlen($_POST['Password']) < 8 
            || !preg_match("#[0-9]+#",$_POST['Password']) 
            || !preg_match("#[A-Z]+#",$_POST['Password']) 
            || !preg_match("#[a-z]+#",$_POST['Password'])) {
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
            // $error[] = "please, try again.";
            
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
                                        VALUES (:username, :pass, :isDoctor)";
                    $stmt = $conn->prepare($insertQuery);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':pass', $password);
                    $stmt->bindParam(':isDoctor', $isDoctor);
                
                    $stmt->execute();
                    $last_id = $conn->lastInsertId();
                    // UPDATE doctor SET doctor_user_no = :last_id
                    $updateQuery = "UPDATE doctor SET doctor_user_no = :last_id WHERE doctor_user_no IS NULL";
                    $stmt = $conn->prepare($updateQuery);
                    $stmt->bindParam(':last_id', $last_id, PDO::PARAM_INT);
                
                    $stmt->execute();

                // echo "Data inserted and updated successfully.";
                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }

        // to doctor table
                try {
                    $profileImage = $target_file;
                    $insertQuery = "INSERT INTO doctor (doctor_name, doctor_img, doctor_phone, doctor_dep_no, 
                                                doctor_gender, doc_schedule_start, doc_schedule_end, doctor_user_no)
                                    VALUES (concat(:fname, ' ', :lname), :profileImage, :phone, 
                                                :department, :gender, :start_time, :end_time, :user_id)";
                    $stmt = $conn->prepare($insertQuery);
                    $stmt->bindParam(':fname', $fname);
                    $stmt->bindParam(':lname', $lname);
                    $stmt->bindParam(':profileImage', $profileImage);
                    $stmt->bindParam(':phone', $phone);
                    $stmt->bindParam(':department', $department);
                    $stmt->bindParam(':gender', $gender);
                    $stmt->bindParam(':start_time', $start_time);
                    $stmt->bindParam(':end_time', $end_time);
                    $stmt->bindParam(':user_id', $last_id);
                    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
                    
                    // Redirect to another page
                    echo '<script>window.location.href = "success.php";</script>';

                    $stmt->execute();
                    // echo "Data inserted successfully.";
                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }

        
                

            } else {
                $error[] = "Sorry, there was an error uploading your file."; 
                header("Location:". $_SERVER['PHP_SELF']);
                exit();
            }
        }
}

    // Close connection
    




