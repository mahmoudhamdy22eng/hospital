<?php

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form data
    if (isset($_POST['patient_id'])) {
        $patient_id = $_POST['patient_id'];
        
        // Redirect to the page where patient data can be updated
        header('Location: update_patient.php?patient_id=' . urlencode($patient_id));
        exit();
    }
    else if (isset($_POST['doctor_id'])) {
        $doctor_id = $_POST['doctor_id'];
        
        // Redirect to the page where doctor data can be updated
        header('Location: update_doctor.php?doctor_id=' . urlencode($doctor_id));
        exit();
    }
}
?>
