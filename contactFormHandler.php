<?php
// Email addresses where the form submission should be sent
$admin_emails = "manish2019web@gmail.com, ervontechnology@gmail.com"; // Separate emails with a comma

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $fullName = isset($_POST['fullName']) ? htmlspecialchars($_POST['fullName']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $contactNumber = isset($_POST['contactNumber']) ? htmlspecialchars($_POST['contactNumber']) : '';
    $projectType = isset($_POST['projectType']) ? htmlspecialchars($_POST['projectType']) : '';
    $additionalInfo = isset($_POST['additionalInfo']) ? htmlspecialchars($_POST['additionalInfo']) : '';

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Prepare email content
    $subject = "New Contact Form Submission from $fullName";
    $message = "
        You have received a new contact form submission. Here are the details:

        Full Name: $fullName
        Email: $email
        Contact Number: $contactNumber
        Project Type: $projectType
        Additional Information: $additionalInfo
    ";

    // Email headers
    $headers = "From: noreply@example.com\r\n"; // Use a proper "From" address
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email to multiple recipients
    if (mail($admin_emails, $subject, $message, $headers)) {
        echo "Success"; // You can change this response to JSON if required
    } else {
        echo "Error sending email";
    }
} else {
    echo "Invalid Request";
}
?>
