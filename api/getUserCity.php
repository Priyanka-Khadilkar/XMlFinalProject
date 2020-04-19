<?php

require_once "../database/UserContext.php";

$userId = $_GET["user_id"];
$userContext = new UserContext();
$cities = $userContext->ListAllUserCity($userId);
$jsonprod = json_encode($cities);
header('Content-Type: application/json');
echo $jsonprod;