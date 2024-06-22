<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>

	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="stylesheet" href="fontawesome-free-6.5.2-web/css/all.min.css"/>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="signup.css">
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script>
		// go to doctor form
        function DirectDoctorForm() {
            window.location.href = "doctorform.php";
        }

        // go to patient form
        function DirectPatientForm() {
            window.location.href = "patientform.php";
        }
	</script>
</head>

<body>

<header class="p-3 text-dark" style="background-color: #708DB4;">
    <div class="container">
        <div class="row justify-content-center ">
            <!-- Logo Section -->
            <div class="col-lg-auto mb-3 mb-lg-0">
                <div class="d-flex justify-content-center justify-content-lg-start ">
                    <a href="home.php" class="d-flex align-items-center text-dark text-decoration-none">
                        <img src="img/health.png" height="70" width="70" alt="logo">
                    </a>
                </div>
            </div>

            <!-- Home and About Section -->
            <div class="col-lg-auto mb-3 mb-lg-0 pt-3">
                <ul class="nav justify-content-center justify-content-lg-start">
                    <li><a href="home.php" class="nav-link px-2 text-dark nvlink"><h5>Home</h5></a></li>
                    <li><a href="home.php" class="nav-link px-2 text-dark nvlink1"><h5>About</h5></a></li>
                </ul>
            </div>

            <!-- Buttons Section -->
            <div class="col-lg mb-3 mb-lg-0 d-flex justify-content-center 
                        justify-content-lg-end justify-content-md-center 
                        justify-content-sm-center col-sm-auto pt-3">
                <ul class="nav justify-content-center">
                    <li><button type="button" class="btn btn-success me-2" onclick="location.href='login.php'">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                        </button>
                    </li>
                    <li><button type="button" class="btn btn-warning ml-2" onclick="location.href='signup.php'">
                            <i class="fa-solid fa-circle-user"></i> Sign-up
                        </button>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</header>


<!-- form Section -->
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="col-md-5 col-sm-12">
						<div class="booking-cta">
							<br><h1>Sign Up</h1>
							<p style="color:#fff;">Please select your role: Patient or Doctor.</p>
						</div>
					</div>
					<div class="col-md-7" id="buttons-images">
						<div class="role-container ">
							<button type="button" id="doctorButton" class="btn btn-secondary" 
								onclick="DirectDoctorForm()">
								Doctor <i class="fas fa-chevron-down"></i>
							</button>
							<img src="img/doctor.png"  
								onmouseover="this.style.opacity='0.7'; this.style.transform='scale(1.1)';
														this.style.cursor='pointer';" 
								onmouseout="this.style.opacity='1'; this.style.transform='scale(1)';"
								onclick="DirectDoctorForm()"
								alt="Doctor Image" id="doctorimg" width="300" height="200">
						</div>
						<div class="role-container">
							<button type="button" id="patientButton" class="btn btn-secondary" 
								onclick="DirectPatientForm()">
								Patient <i class="fas fa-chevron-down"></i>
							</button>
							<img src="img/patient.png" 
								onmouseover="this.style.opacity='0.7'; this.style.cursor='pointer'; 
														this.style.transform='scale(1.1)';" 
								onmouseout="this.style.opacity='1'; this.style.transform='scale(1)';"
								onclick="DirectPatientForm()"
								alt="Patient Image" id="patientimg" width="200" height="200">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
