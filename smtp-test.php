<?php

$host = 'us3.smtp.mailhostbox.com';
$port = 587;

echo "Testing connection to $host:$port<br>";

$connection = @fsockopen(
    $host,
    $port,
    $errno,
    $errstr,
    10
);

if ($connection) {
    echo "SUCCESS: Port $port is reachable.<br>";
    fclose($connection);
} else {
    echo "FAILED<br>";
    echo "Error number: " . $errno . "<br>";
    echo "Error message: " . htmlspecialchars($errstr) . "<br>";
}
