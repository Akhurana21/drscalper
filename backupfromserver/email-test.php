<?php

$to = "support@drscalper.com";

$subject = "MODULYST Website Email Test";

$message = "This is a test email from the MODULYST website.";

$headers = [];
$headers[] = "From: support@drscalper.com";
$headers[] = "Reply-To: support@drscalper.com";
$headers[] = "Content-Type: text/plain; charset=UTF-8";

$result = mail(
    $to,
    $subject,
    $message,
    implode("\r\n", $headers)
);

if ($result) {
    echo "PHP mail() returned SUCCESS.";
} else {
    echo "PHP mail() returned FAILED.";
}

?>