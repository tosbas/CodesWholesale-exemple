<?php
/**
 * Client Id de sandbox
 */
define("CLIENT_ID_SANDBOX", "ff72ce315d1259e822f47d87d02d261e");

/**
 * Client secret de sandbox
 */
define("CLIENT_SECRET_SANDBOX", '$2a$10$E2jVWDADFA5gh6zlRVcrlOOX01Q/HJoT6hXuDMJxek.YEo.lkO2T6');

/**
 * Url oauth sandbox
 */
define("URL_OAUTH_SANDBOX", "https://sandbox.codeswholesale.com/oauth/token");

/**
 * Curl vers https://sandbox.codeswholesale.com/oauth/token
 * @param string $url Url oauth
 * @return $result
 */
function curlToOauth($url)
{

    $clientId = CLIENT_ID_SANDBOX;
    $clientSecret = CLIENT_SECRET_SANDBOX;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials&client_id={$clientId}&client_secret={$clientSecret}");

    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        $error =  'Erreur:' . curl_error($ch);
        return $error;
    }

    curl_close($ch);

    return json_decode($result);
}

$curlOauth = curlToOauth(URL_OAUTH_SANDBOX);
$accessToken = $curlOauth->access_token;