<?php
require_once 'profile.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_patient'])) {
    $patientId = $_POST['patient_id'];

    // Update database query
    $sql = "UPDATE `patient` SET `is_deleted` = 1 WHERE `patient_id` = :patient_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':patient_id', $patientId, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        // header('Location: doctor_dashboard.php');
        exit();
    } else {
        echo 'Failed to remove patient. Please try again later.';
    }
} else {
    echo 'Error: Invalid request.';
}
?>
