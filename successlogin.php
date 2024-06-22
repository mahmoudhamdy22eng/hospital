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
            border-radius: 0.5rem; /* Adjust the radius as needed */
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
        });

        function redirectToProfile() {
            window.location.href = 'profile.php';
        }

        // move the cursor to the button
        document.body.addEventListener('click', function() {
        var lonelyButton = $('#exampleModal').modal('show');
        lonelyButton.focus();
    });
    </script>
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close shadow-none d-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="d-flex justify-content-center pb-2">
                            <div class="check-container d-flex justify-content-center align-items-center rounded-pill">
                                <i class="fa-solid fa-check" style="color: #fff; font-size: 36px"></i>
                            </div>
                        </div>
                        <h1 class="fw-bold">Successfully Logged in!</h1>
                        <p class="fw-bold">Now You are ready to view your profile.</p>
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center footer-color rounded-0 position-relative">
                    <div class="angle"></div>
                    <div class="text-center p-4">
                        <button type="button" id="button" class="btn shadow-none footer-btn text-white rounded-2 px-5"
                            onclick="redirectToProfile()" style="z-index: 222">Show Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
