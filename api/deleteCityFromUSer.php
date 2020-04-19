<?php

require_once "../database/UserContext.php";

$placeId = $_GET["placeId"];
$userContext = new UserContext();
$cities = $userContext->DeleteCityFromUser($placeId);
$jsonprod = json_encode($cities);
header('Content-Type: application/json');
echo $jsonprod;