<?php
require_once "../database/UserContext.php";
$cityName = $_POST['cityName'];
$userId = $_POST['userId'];

$userContext = new UserContext();
$count = $userContext->AddCityToUser($userId, $cityName);
if ($count) {
    echo "Added City";
} else {
    echo "Problem adding city";
}