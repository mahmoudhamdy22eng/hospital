<?php
// handle_patient.php
include('conn.php'); // Include your database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove_patient'])) {
        // Handle remove patient action
        $patientId = $_POST['patient_id'];
        
        // Perform deletion logic (update is_deleted flag in this case)
        $sql = "UPDATE `patient` SET `is_deleted` = 1 WHERE `patient_id` = :patient_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':patient_id', $patientId);
        
        if ($stmt->execute()) {
            echo "<script type='text/javascript'>alert('Patient removed successfully!'); window.location.href = 'profile.php';</script>";
            // You can redirect or display a success message here
        } else {
            echo "<script type='text/javascript'>alert('Error removing patient.'); window.location.href = 'profile.php';</script>";
            // Handle error if removal fails
        }
    } elseif (isset($_POST['message'])) {
        // Handle send message action
        $patientId = $_POST['patient_id'];
        $messageContent = htmlspecialchars($_POST['message']); // You should always sanitize user input

        // Check if a message already exists for this patient
        $sql_check = "SELECT COUNT(*) AS num_messages FROM `messages` WHERE `msg_pat_id` = :patient_id";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bindParam(':patient_id', $patientId);
        $stmt_check->execute();
        $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
        $numMessages = (int)$row['num_messages'];

        if ($numMessages > 0) {
            // Update existing message for the patient
            $sql_update = "UPDATE `messages` SET `msg_content` = :message_content WHERE `msg_pat_id` = :patient_id";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bindParam(':patient_id', $patientId);
            $stmt_update->bindParam(':message_content', $messageContent);
            
            if ($stmt_update->execute()) {
                echo "<script type='text/javascript'>alert('Message updated successfully!'); window.location.href = 'profile.php';</script>";
                // You can redirect or display a success message here
            } else {
                echo "<script type='text/javascript'>alert('Error updating message.'); window.location.href = 'profile.php';</script>";
                // Handle error if update fails
            }
        } else {
            // Insert new message for the patient
            $sql_insert = "INSERT INTO `messages` (`msg_pat_id`, `msg_content`) VALUES (:patient_id, :message_content)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bindParam(':patient_id', $patientId);
            $stmt_insert->bindParam(':message_content', $messageContent);
            
            if ($stmt_insert->execute()) {
                echo "<script type='text/javascript'>alert('Message sent successfully!'); window.location.href = 'profile.php';</script>";
                // You can redirect or display a success message here
            } else {
                echo "<script type='text/javascript'>alert('Error sending message.'); window.location.href = 'profile.php';</script>";
                // Handle error if insertion fails
            }
        }
    } else {
        echo "<script type='text/javascript'>alert('Invalid action.'); window.location.href = 'profile.php';</script>";
        // Handle invalid action (optional)
    }
} else {
    echo "<script type='text/javascript'>alert('Unauthorized access.'); window.location.href = 'profile.php';</script>";
    // Handle unauthorized access attempt (optional)
}
?>
