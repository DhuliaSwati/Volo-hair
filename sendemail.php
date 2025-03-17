<?php
// Define some constants
define("RECIPIENT_NAME", "Volo Hair");
define("RECIPIENT_EMAIL", "hei@volohair.no");

// Read the form values
$success = false;
$userName = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : "";
$senderEmail = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
$userPhone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : "";
$userSubject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : "";
$message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : "";

// If all values exist, send the email
if ($userName && $senderEmail && $userPhone && $userSubject && $message) {
    $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
    $subject = "New Contact Form Submission: " . $userSubject;
    $headers = "From: " . $userName . " <" . $senderEmail . ">\r\n";
    $headers .= "Reply-To: " . $senderEmail . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $msgBody = "Name: " . $userName . "\n";
    $msgBody .= "Email: " . $senderEmail . "\n";
    $msgBody .= "Phone: " . $userPhone . "\n";
    $msgBody .= "Subject: " . $userSubject . "\n";
    $msgBody .= "Message: " . $message . "\n";

    // Send the email
    $success = mail($recipient, $subject, $msgBody, $headers);

    // Set Location After Successful Submission
    if ($success) {
        header('Location: contact.html?message=Successfull');
        exit();
    } else {
        header('Location: contact.html?message=Failed');
        exit();
    }
} else {
    // Set Location After Unsuccessful Submission
    header('Location: contact.html?message=Failed');
    exit();
}
?>