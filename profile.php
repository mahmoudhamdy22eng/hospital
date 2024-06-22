<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Model1</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-6.5.2-web/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .modal-content {
            border-radius: 0.5rem; 
            max-width: 90%; 
            margin: 0 auto; 
        }
        #exampleModal {
            background-color: #0f6651;
        }
        .footer-color {
            background: #0cac85;
            border-radius: 0 0 0.5rem 0.5rem !important;
        }
        .footer-btn {
            background: #0f6651;
        }
        .check-container {
            background: #0cac85;
            height: 82px;
            width: 82px;
        }
        .iconheight {
            height: 36px;
            width: 36px;
        }
        .btn:hover {
            color: var(--bs-btn-hover-color);
            background: #06765b;
            border-color: #0f6651;
        }
        .angle::after {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            top: -1px;
            left: 48%;
            background: #fff;
            clip-path: polygon(50% 50%, 0 0, 100% 0);
        }
    </style>
    <script>
        $(document).ready(function () {
            $('#exampleModal').modal('show');
        })

        function redirectToLogin() {
            window.location.href = 'profile.php';
        }

        function home() {
            window.location.href = 'home.php';
        }

        // logout
        function logout() {
        // clear session storage
        sessionStorage.clear();
        window.location.href = 'login.php';
        }

    </script>
</head>

<body >
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 1000px;">
        <div class="modal-content rounded-4" style="overflow: auto;">
            <div class="modal-header border-0">
                <button type="button" class="btn-close shadow-none d-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 210px);">
                <div class="text-center">
                    <div class="d-flex justify-content-center pb-2">
                        <div class="check-container d-flex justify-content-center align-items-center rounded-pill">
                                <?php 

                                
                                    session_start();
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
                                    if ($_SESSION['u_type_no'] == 1){
                                        echo "<i class=\"fa-solid fa-user-doctor\" style=\"color: #fff; font-size: 36px\"></i>"."<br>";
                                    } else if ($_SESSION['u_type_no'] == 2){
                                        echo "<i class=\"fa-solid fa-hospital-user\" style=\"color: #fff; font-size: 36px\"></i>";
                                    } else if ($_SESSION['u_type_no'] == 3) {
                                        echo "<i class=\"fa-solid fa-user-tie\" style=\"color: #fff; font-size: 36px\"></i>";
                                    }
                                    // end connection
                                    $conn = null;
                                ?>
                        </div>
                    </div>
                    <h1 class="fw-bold">
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
                            
                            $firstName = ucfirst($_SESSION['username']);
                            $imgdoctor = $_SESSION['doctor_img'];
                            // $imgpatient = $_SESSION['patient_img'];
                            // $imgadmin = $_SESSION['admin_img'];
                            if ($_SESSION['u_type_no'] == 1){
                                echo "Welcome! <br>". "<img src=\"$imgdoctor\" height=\"50\" width=\"50\" alt=\"profile\">"."<br>". " Dr. $firstName"."<br>" ;
                            } else if ($_SESSION['u_type_no'] == 2){
                                echo "Good day,"."<br>". "<img src=\"$imgpatient\" height=\"50\" width=\"50\" alt=\"profile\">"."<br>". " $firstName"."<br>" ;
                            } else if ($_SESSION['u_type_no'] == 3) {
                                echo "Welcome! Admin. $firstName"."<br>";
                            }
                            // end connection
                            $conn = null;
                        ?>
                    </h1>
                </div>
            </div>

            <!-- profile -->
            <p class="fw-bold text-center" style="font-size: 18px">Your Profile!</p>
            <ul class="list-group list-group-flush">
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
                    
                // doctor
                    if ($_SESSION['u_type_no'] == 1){
                        $docName = ucwords(strtolower($_SESSION['doctor_name']));
                        $docphone = (strtolower($_SESSION['doctor_phone']));
                        // department filter
                        $docDepName = $_SESSION['doctor_dep_no'];
                            if ($docDepName == 1) {
                                $docDep = "Surgery";
                            } else if ($docDepName == 2) {
                                $docDep = "Operations";
                            } else if ($docDepName == 3) {
                                $docDep = "psychology";
                            }else if ($docDepName == 4) {
                                $docDep = "emergency";
                            }
                        $docscheduleStart = ucfirst(strtoupper($_SESSION['doc_schedule_start']));
                        $docscheduleEnd = ucfirst(strtoupper($_SESSION['doc_schedule_end']));
                        $depName = ucfirst(strtoupper($_SESSION['department_name']));
                        echo "<li class=\"list-group-item\">Full name: <b>$docName</b></li>
                        <li class=\"list-group-item\">Phone number: <b>$docphone</b></li>
                        <li class=\"list-group-item\">Schedule: <b>$docscheduleStart - $docscheduleEnd</b></li>
                        <li class=\"list-group-item\">Department: <b>$docDep</b></li>";
                    }
                // patient
                    if ($_SESSION['u_type_no'] == 2){
                        $patName = ucfirst(strtoupper($_SESSION['patient_name']));
                        echo "<li class=\"list-group-item\">Full name: <b>$patName</b></li>
                        <li class=\"list-group-item\">A second item</li>
                        <li class=\"list-group-item\">A third item</li>
                        <li class=\"list-group-item\">A fourth item</li>
                        <li class=\"list-group-item\">And a fifth one</li>";
                    }
                // admin
                    if ($_SESSION['u_type_no'] == 3) {
                        echo "<li class=\"list-group-item\">An item</li>
                        <li class=\"list-group-item\">A second item</li>
                        <li class=\"list-group-item\">A third item</li>
                        <li class=\"list-group-item\">A fourth item</li>
                        <li class=\"list-group-item\">And a fifth one</li>";
                    }
                    // end connection
                    $conn = null;
                ?>
                
            </ul><br>

            <!-- list content -->

            <ol class="list-group list-group-numbered">
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
                    
                // doctor
                    if ($_SESSION['u_type_no'] == 1){
                        $patName = ucwords(strtolower($_SESSION['patient_name']));
                        $patphone = (strtolower($_SESSION['patient_phone']));
                        $patimg = $_SESSION['patient_img'];
                        // department filter
                        echo '<p class="fw-bold text-center" style="font-size: 18px">Your Patients!</p><li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Patient : ' . $patName . '</div>
                                <ul>
                                    <li>Phone: ' . $patphone . '</li>
                                    <li><a onmouseover="this.style.cursor=\'pointer\'; this.style.textDecoration=\'underline\'" onmouseout="this.style.textDecoration=\'none\'" onclick="removepatient()" class=" text-danger">Remove</a> Or <a onmouseover="this.style.cursor=\'pointer\'; this.style.textDecoration=\'underline\'" onmouseout="this.style.textDecoration=\'none\'" onmouseout="this.style.textDecoration=\'none\'" onclick="showmessage()" class="text-decoration-none text-success">Send message</a></li>
                                </ul>
                            </div>
                            <span class="badge text-bg-primary rounded-pill">' . $patimg . '</span>
                        </li>';
                    }
                    ?>
            </ol>
    
    <!-- footer buttons -->
            <div class="modal-footer border-0 footer-color rounded-0 position-relative">
                <div class="angle m"></div>
                <div class="text-center mt-2">
                    <button type="button" class="btn shadow-none footer-btn text-white rounded-2" 
                            onclick="home()">Home page</button>
                </div>
                <div class="text-center mt-2">
                    <button type="button" class="btn shadow-none footer-btn text-white rounded-2" 
                            onclick="logout()">Log out</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
