<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars(trim($_POST['subject'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    // Server-side validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo 'error';
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'error';
        exit;
    }

    // Email to send the message to
    $to = "saviourpat@gmail.com";
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $body = "<html><body>";
    $body .= "<h2>Message from: $name</h2>";
    $body .= "<p><strong>Email:</strong> $email</p>";
    $body .= "<p><strong>Subject:</strong> $subject</p>";
    $body .= "<p><strong>Message:</strong><br>$message</p>";
    $body .= "</body></html>";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
