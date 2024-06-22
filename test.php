<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Simple Form with Modal</title>
<style>
    /* Basic styling for modal */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0,0,0,0.4); /* Black with opacity */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* Close button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
</head>
<body>

<!-- The form -->
<form method="post">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <button type="submit" name="submit">Submit</button>
</form>

<!-- The Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Modal content here. This could be a success message or any other content.</p>
    </div>
</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the close button element
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Optional: Show modal when form is submitted
var form = document.querySelector('form');
form.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form from submitting

    // Show the modal
    modal.style.display = "block";
});
</script>

</body>
</html>




 <!-- Show/Hide doctors -->
        <!-- // function filterDoctors() {
        //     const illness = document.getElementById("illness").value;
        //     const doctors = document.getElementById("doctor").options;
            
        //     // Reset doctor selection
        //     document.getElementById("doctor").selectedIndex = 0;

        //     // Show/hide options based on the selected in illness
        //     for (let i = 1; i < doctors.length; i++) { // i = 1 to skip the "disabled" option
        //         const option = doctors[i];
        //         if (option.id === illness) {
        //             option.style.display = 'block';
        //         } else {
        //             option.style.display = 'none';
        //         }
        //     }
        // } -->