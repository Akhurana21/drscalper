<?php

// ===============================
// CONFIGURATION
// ===============================


$toEmail = "support@drscalper.com";

$smtpHost = "us3.smtp.mailhostbox.com";
$smtpPort = 587;
$smtpUser = "support@drscalper.com";
$smtpPass = "Danny@12123";

$telegramBotToken = "8905522272:AAGBMq-8-SMIcu48NMmfxx8rI941inlblAU";
$telegramChatId   = "8904749166";


// ===============================
// GET FORM DATA
// ===============================

$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$message = trim($_POST['message'] ?? '');


// ===============================
// BASIC VALIDATION
// ===============================

if ($name === '' || $email === '' || $message === '') {
    die("Please fill all required fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.");
}


// ===============================
// EMAIL
// ===============================

$subject = "New Website Enquiry - " . $name;

$emailBody = "
New enquiry received from modulyst.in

Name: $name
Email: $email
Phone: $phone

Message:
$message
";

$headers  = "From: $smtpUser\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$mailSent = mail(
    $toEmail,
    $subject,
    $emailBody,
    $headers
);


// ===============================
// TELEGRAM
// ===============================

$telegramMessage =
"🔔 *New Website Enquiry*\n\n" .
"*Name:* " . $name . "\n" .
"*Email:* " . $email . "\n" .
"*Phone:* " . $phone . "\n\n" .
"*Message:*\n" . $message;

$telegramUrl =
    "https://api.telegram.org/bot" .
    $telegramBotToken .
    "/sendMessage";

$postData = [
    'chat_id' => $telegramChatId,
    'text' => $telegramMessage,
    'parse_mode' => 'Markdown'
];

$ch = curl_init($telegramUrl);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$telegramResponse = curl_exec($ch);

curl_close($ch);


// ===============================
// RESULT
// ===============================

if ($mailSent) {
    header("Location: contact-success.html");
    exit;
}

header("Location: contact-failure.html");
exit;

?>