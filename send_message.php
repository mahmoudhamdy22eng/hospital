<?php
// send_message.php
require_once 'profile.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    // Validate and sanitize input
    $patientId = $_POST['patient_id'];
    $messageContent = htmlspecialchars($_POST['message']); 

    // Insert message into database
    $sql = "INSERT INTO `message` (`msg_pat_id`, `msg_content`) VALUES (:patient_id, :message_content)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':patient_id', $patientId);
    $stmt->bindParam(':message_content', $messageContent);
    
    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "Error sending message.";
    }
} else {
    echo "Unauthorized access.";
}
?>
