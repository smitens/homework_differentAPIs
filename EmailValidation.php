<?php
include("useAPI.php");
require 'vendor/autoload.php';
use Mailgun\Mailgun;

$email = readline ("Enter Your email address: ");

$emailValidation = new ValidateEmail("https://api.emailvalidation.io/", $email);
$response = json_decode($emailValidation->validateEmail());
echo "E-mail address $email validation score is $response->score, validation state $response->state.\n$email is $response->reason.\n";

if ($response->state == "deliverable") {

    $apiKey = getenv("MAILGUN_API_KEY");
    $domain = 'sandboxe71cc28cb4514920a35fc95833d73f7b.mailgun.org';

    $mgClient = Mailgun::create($apiKey);
    $params = [
        'from'    => 'you@yourdomain.com',
        'to'      => $email,
        'subject' => 'Hello World',
        'text'    => 'Hello World!'
    ];
    try {
        $result = $mgClient->messages()->send($domain, $params);
        echo "Email sent successfully!\n";
    } catch (Exception $e) {
        echo "Failed to send email: " . $e->getMessage() . "\n";
    }
} else {
    echo "Email validation failed. Please provide a valid email address.\n";
}