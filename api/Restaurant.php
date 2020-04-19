<?php

$ZOMATO_CFG = array(
    'url' => 'https://developers.zomato.com/api/v2.1', //replace with your own client ID
    'user_key' => 'bc1a152ce01e7f78eb24db0f4f00fb20', //replace with client secret retrieved from your dashboard (Apps & Credentials) on Paypal's developer site
);

$zomatoURL = "https://developers.zomato.com/api/v2.1";

function GetLocationDetail($city)
{
    Global $ZOMATO_CFG;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $ZOMATO_CFG["url"] . "/locations?query=" . $city,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "user-key: " . $ZOMATO_CFG["user_key"],
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

function GetRestaurantDetail($entity_id, $entity_type)
{
    Global $ZOMATO_CFG;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $ZOMATO_CFG["url"] . "/search?entity_id=" . $entity_id . "&entity_type=" . $entity_type,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "user-key: " . $ZOMATO_CFG["user_key"],
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response);
}

function GetRestaurantDetailById($restaurantId)
{
    Global $ZOMATO_CFG;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $ZOMATO_CFG["url"] . "/restaurant?res_id=" . $restaurantId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "user-key: " . $ZOMATO_CFG["user_key"],
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response);
}

function GetTrendingRestaurantDetail($entity_id, $entity_type)
{
    Global $ZOMATO_CFG;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $ZOMATO_CFG["url"] . "/search?entity_id=" . $entity_id . "&entity_type=" . $entity_type."&collection_id=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "user-key: " . $ZOMATO_CFG["user_key"],
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response);
}