<?php
function shortenUrl($longUrl)
{
    $apiUrl = "https://cleanuri.com/api/v1/shorten";

    $request = curl_init($apiUrl);

    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($request, CURLOPT_POST, true);
    curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query(['url' => $longUrl]));
    curl_setopt($request, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);

    $response = curl_exec($request);

    if (curl_errno($request)) {
        echo 'Error: ' . curl_error($request);
        return false;
    }
    curl_close($request);

    $responseData = json_decode($response, true);

    if (isset($responseData['result_url'])) {
        return $responseData['result_url'];
    } else {
        echo "Error: Unable to shorten URL. Response: " . $response;
        return false;
    }
}

$longUrl = readline("Enter the URL to shorten: ");
$shortUrl = shortenUrl($longUrl);

if ($shortUrl) {
    echo "Shortened URL: " . $shortUrl . "\n";
} else {
    echo "Failed to shorten the URL." . "\n";
}