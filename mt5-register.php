<?php

// ===============================
// CONFIGURATION
// ===============================

$telegramBotToken = "8905522272:AAGBMq-8-SMIcu48NMmfxx8rI941inlblAU";
$telegramChatId   = "8904749166";


// ===============================
// GET FORM DATA
// ===============================

$mt5AccountId    = trim($_POST['mt5_account_id'] ?? '');
$registeredEmail = trim($_POST['registered_email'] ?? '');
$telegramUsername = trim($_POST['telegram_username'] ?? '');


// ===============================
// BASIC VALIDATION
// ===============================

if ($mt5AccountId === '' || $registeredEmail === '' || $telegramUsername === '') {
    die("Please fill all required fields.");
}

if (!filter_var($registeredEmail, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.");
}


// ===============================
// TELEGRAM
// ===============================

$telegramMessage =
"🎯 *New MT5 Account Registration*\n\n" .
"*MT5 Account ID:* " . $mt5AccountId . "\n" .
"*Registered Email:* " . $registeredEmail . "\n" .
"*Telegram Username:* " . $telegramUsername;

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

if ($telegramResponse) {
    header("Location: registration-success.html");
    exit;
}

header("Location: registration-failure.html");
exit;

?>
