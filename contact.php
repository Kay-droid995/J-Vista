<?php
// Contact form processing

// Set recipient email (change to your actual email)
$recipient_email = "hello@jvistablendz.com";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data and sanitize inputs
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format. Please go back and try again.";
        exit;
    }
    
    // Set email subject
    $email_subject = "J-Vista Blendz Contact Form: " . $subject;
    
    // Set email headers
    $headers = "From: $name <$email>" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Build email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n";
    
    // Send email
    if (mail($recipient_email, $email_subject, $email_content, $headers)) {
        // Redirect to thank you page on success
        header("Location: thank-you.html");
        exit;
    } else {
        // Display error message if sending fails
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
    
} else {
    // Not a POST request, redirect to home page
    header("Location: index.html");
    exit;
}
?>