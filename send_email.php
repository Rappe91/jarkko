<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING));

    // Validate form data
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required.";
    } elseif (strlen($name) < 2) {
        $errors[] = "Name must be at least 2 characters long.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($message)) {
        $errors[] = "Message is required.";
    } elseif (strlen($message) < 10) {
        $errors[] = "Message must be at least 10 characters long.";
    }

    // If there are no errors, proceed with sending the email
    if (empty($errors)) {
        // Email details
        $to = "your-email@example.com"; // Replace with your email address
        $subject = "New Contact Form Submission";
        $headers = "From: " . $email . "\r\n" .
                   "Reply-To: " . $email . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        // Create the email content
        $emailContent = "Name: " . $name . "\n";
        $emailContent .= "Email: " . $email . "\n";
        $emailContent .= "Message:\n" . $message . "\n";

        // Send the email
        if (mail($to, $subject, $emailContent, $headers)) {
            // Redirect to a thank you page or display a success message
            echo "Thank you for contacting us. We will get back to you soon!";
        } else {
            // Display an error message
            echo "Sorry, there was an error sending your message. Please try again later.";
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>" . htmlspecialchars($error) . "</p>";
        }
        echo "<p>Please go back and correct the errors.</p>";
    }
} else {
    // Redirect to the form if accessed directly
    header("Location: contact-form.html");
    exit();
}
?>