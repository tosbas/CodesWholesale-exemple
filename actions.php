<?php

require_once("oauth.php");

/**
 * Access Token sandbox
 */
define("ACCESS_TOKEN_SANDBOX", $accessToken);

/**
 * Url api sandbox
 */
define("URL_API_SANDBOX", "https://sandbox.codeswholesale.com");

/**
 * Url api platform sandbox https://sandbox.codeswholesale.com/v2/platforms
 */
define("URL_PLATFORM_SANDBOX",  "/v2/platforms");

/**
 *  Url api products sandbox https://sandbox.codeswholesale.com/v2/products
 */
define("URL_PRODUCT_SANDBOX",  "/v2/products");

/**
 *  Url api orders sandbox https://sandbox.codeswholesale.com/v2/orders
 */
define("URL_ORDER_SANDBOX",  "/v2/orders");


/**
 * Curl vers https://sandbox.codeswholesale.com/v2/{action} 
 * @param string $action Action 
 * @param string $type POST, GET
 * @param array $params [optionnal] POSTFIELDS
 * @return object $result
 * @see https://codeswholesale.com/documentation/
 */
function curlToAction($action, $type, $params = [])
{

    $array = ["POST", "GET"];

    $url =  URL_API_SANDBOX . $action;
    $bearer = ACCESS_TOKEN_SANDBOX;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    if (in_array($type, $array)) {
        if ($type === "GET") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        } else if ($type === "POST") {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }
    } else {
        $error = "Erreur: \"" . $type . "\" n'est pas reconnu comme type";
        return $error;
    }

    $headers = array();
    $headers[] = "Accept: */*";
    $headers[] = "Authorization: Bearer {$bearer}";
    $headers[] = "Content-Type: application/json";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        $error = 'Erreur:' . curl_error($ch);
        return $error;
    }
    curl_close($ch);

    return json_decode($result);
}



