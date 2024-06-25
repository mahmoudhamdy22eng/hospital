<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
	<title> Sign in</title>

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
							<h1>Sign in</h1>
							<h5 >Welcome, Back!</h5>
						</div>
					</div>
<!-- log in form -->
					<div class="col-md-7 col-md-pull-7">
						<div class="booking-form">
						<form id="doctorForm" method="POST" enctype="multipart/form-data" class="container" >
                            <!-- Image -->
							<div class="form-group text-center">
								<!-- <label for="file" class="form-label"><b>Upload Your Profile Image</b></label><br> -->
								<img src="img/health.png" 
                                	alt="Profile Image" id="profileimg" width="200" height="180"><br>
							</div>
							<!-- Username -->
							<div class="col-sm-8 form-group container">
								<label for="UserName" class="form-label">Username:</label>
								<input type="text" name="UserName" id="UserName" class="form-control" required>
							</div>
							
							<!-- empty -->
							<div class="col-sm-6 form-group">
								
							</div>

							<!-- Password -->
							<div class="col-sm-8 form-group container">
							<label for="Password" class="form-label">Password:</label>
                        	<input type="password" name="Password" id="Password" class="form-control" required>
							</div><br>

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
								<p class=" fw-bold mx-4 pt-1 mb-0">Don't have an account?<a href="signup.php"
									class="link-danger fw-bold text-danger">Sign Up</a></p>
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- Scripts -->


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>


<!-- php -->
<?php  

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
        $uploadstatus = 1;
        // Form data
        $username = htmlspecialchars($_POST['UserName']);
        $password = htmlspecialchars($_POST['Password']);
        
        $error = [];

// checks 
	// trial 1
        // get username and password from database and check with  inputs
        // $checkUsername = $conn->prepare("SELECT * FROM user WHERE user_name = :username");
		// $checkUsername->bindParam(':username', $username);
		// // $checkUsername->bindParam(':pass', $password);
		// // check if username exists in database or not
		// if ($checkUsername->rowCount() > 0) {
		// 	$checkPassword = $conn->prepare("SELECT user_pass FROM user WHERE user_name = :username 
		// 																And user_pass = :pass");
		// 	$checkPassword->bindParam(':pass', $password);
		// 	$checkPassword->bindParam(':username', $username);
		// 	$checkPassword->execute();
		// 	if ($checkPassword->rowCount() > 0) {
		// 		$_SESSION['username'] = $username;
		// 		$_SESSION['user_id'] = $userid;
		// 		$_SESSION['u_type_no'] = $usertype;
		// 		$uploadstatus = 1;
		// 	}else{
		// 		$error[] = "Incorrect username or password";
		// 		$uploadstatus = 0;
		// 	}			
		// }else{
		// 	$error[] = "Incorrect username or password";
		// 	$uploadstatus = 0;
		// }
		

// trial 2 
	
	$checkUsername = $conn->prepare("SELECT * FROM user WHERE user_name = :username");
	$checkUsername->bindParam(':username', $username);
	$checkUsername->execute();

	// Username exists, fetch user data
	if ($checkUsername->rowCount() > 0) {
		$userData = $checkUsername->fetch(PDO::FETCH_ASSOC);
		// $hashed_password = $userData['user_pass'];

		// Hashed password from database
		$hashed_password_from_db = $userData['user_pass'];
	// echo "Hashed Password from Database: " . $hashed_password_from_db . "<br>";
	
		
		if (password_verify($password, $hashed_password_from_db)) {
			// Set session variables and other logic here
			$_SESSION['user_name'] = $userData['user_name'];
			$_SESSION['user_id'] = $userData['user_id'];
			$_SESSION['u_type_no'] = $userData['u_type_no'];
		
			// doctor table
			$doctortable = $conn->prepare("SELECT * FROM doctor WHERE doctor_user_no = :user_id");
			$doctortable->bindParam(':user_id', $userData['user_id']);
			$doctortable->execute();
			$doctordata = $doctortable->fetch(PDO::FETCH_ASSOC);
			if ($doctordata) {
				$_SESSION['doctor_id'] = $doctordata['doctor_id'];
				$_SESSION['doctor_name'] = $doctordata['doctor_name'];
				$_SESSION['doctor_img'] = $doctordata['doctor_img'];
				$_SESSION['doctor_phone'] = $doctordata['doctor_phone'];
				$_SESSION['doctor_dep_no'] = $doctordata['doctor_dep_no'];
				$_SESSION['doc_schedule_start'] = $doctordata['doc_schedule_start'];
				$_SESSION['doc_schedule_end'] = $doctordata['doc_schedule_end'];
			}
			// patient table
			$patienttable = $conn->prepare("SELECT * FROM patient WHERE patient_user_no = :user_id");
			$patienttable->bindParam(':user_id', $userData['user_id']);
			$patienttable->execute();
			$patientdata = $patienttable->fetch(PDO::FETCH_ASSOC);
			if ($patientdata) {
				$_SESSION['patient_id'] = $patientdata['patient_id'];
				$_SESSION['patient_name'] = $patientdata['patient_name'];
				$_SESSION['patient_img'] = $patientdata['patient_img'];
				$_SESSION['patient_phone'] = $patientdata['patient_phone'];
				$_SESSION['patient_dep_no'] = $patientdata['patient_dep_no'];
				$_SESSION['patient_doc_no'] = $patientdata['patient_doc_no'];
			}

			// department table
			// $departmenttable = $conn->prepare("SELECT * FROM user WHERE u_dep_no = :user_id");
			// $departmenttable->bindParam(':user_id', $userData['department_id']);
			// $departmenttable->execute();
			// $depName = $departmenttable->fetch(PDO::FETCH_ASSOC);
			// $_SESSION['department_id'] = $depName['department_id'];
			// $_SESSION['department_name'] = $depName['department_name'];

			// doc_pat table
			// $doc_pattable = $conn->prepare("SELECT * FROM doc_pat WHERE doc_pat_user_no = :user_id");
			// $doc_pattable->bindParam(':user_id', $userData['user_id']);
			// $doc_pattable->execute();
			// $doc_patdata = $doc_pattable->fetch(PDO::FETCH_ASSOC);
			// $_SESSION['doc_pat_id'] = $doc_patdata['doc_pat_id'];
			// $_SESSION['doc_pat_name'] = $doc_patdata['doc_pat_name'];

			// admin table
			// $admintable = $conn->prepare("SELECT * FROM admin WHERE admin_user_no = :user_id");
			// $admintable->bindParam(':user_id', $userData['user_id']);
			// $admintable->execute();
			// $admindata = $admintable->fetch(PDO::FETCH_ASSOC);
			// $_SESSION['admin_id'] = $admindata['admin_id'];
			// $_SESSION['admin_name'] = $admindata['admin_name'];
			// $_SESSION['admin_img'] = $admindata['admin_img'];

			
		
			$uploadstatus = 1; 
		} else {
			$error[] = "Incorrect password";
			$uploadstatus = 0;
		}
	} else {
		$error[] = "Username does not exist";
		$uploadstatus = 0;
	}

// trial 3
        // $checkUsername->execute();
        // if ($checkUsername->rowCount() > 0) {
		// 	$checkPassword = $conn->prepare("SELECT user_pass FROM user WHERE user_name = :username
		// 																AND user_pass = :pass");
		// 	$checkPassword->bindParam(':username', $username);
		// 	$checkPassword->bindParam(':pass', $password);
			
		// 	$checkPassword->execute();
		// 	if ($checkPassword->rowCount() > 0) {
		// 	$uploadstatus = 1;
		// }else{
		// 	$error[] = "Incorrect username or password";
		// 	$uploadstatus = 0;
		// }			
		// }	

// Terms and conditions check
        // if (!$terms) {
        //     $error[] = "You must agree to the terms and conditions.";
        //     $uploadstatus = 0;
        // }

// Check uploadstatus
        if ($uploadstatus == 0) {
            // $error[] = "please, try again.";
            foreach ($error as $value) { 
                echo "<script type='text/javascript'>alert('$value');</script>";
            }
        }

        // if uploadstatus is ok >>> try to upload file
        else{

                echo '<script>window.location.href = "profile.php";</script>';
            } 
}

    // Close connection
    




