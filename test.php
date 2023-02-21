<?php

require_once("actions.php");

// ******* Oauth  *******/
// print_r($curlOauth);

/******* Post Orders exemple  *******/
$array = [
    "allowPreOrder" => true,
    "orderId" => "Test commande multiple articles",
    "products" => [
        [
            "price" => 6.11,
            "productId" => "73662ef0-f571-4c22-bfdb-dd3ae2c1eb71",
            "quantity" => 1
        ],
        [
            "price" => 5.8,
            "productId" => "6fe4cd6c-b220-447c-9250-5185c5ac8a4c",
            "quantity" => 1
        ],

    ]
];

$curlOrder = curlToAction(URL_ORDER_SANDBOX, "POST", $array);

print_r($curlOrder);

//******* Get Produits exemple  *******/

$curlProduct = curlToAction(URL_PRODUCT_SANDBOX, "GET");

print_r($curlProduct);
