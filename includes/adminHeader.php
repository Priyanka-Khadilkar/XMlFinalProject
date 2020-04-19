<?php
session_start();
if (isset($_SESSION['user_first_name'])) {
    $userFirstName = $_SESSION['user_first_name'];
    $userLastName = $_SESSION["user_last_name"];
    $userImage = $_SESSION["user_image"];
} else {
    header("location: ../logout.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Food Adviser</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg_purple">
    <a class="navbar-brand" href="../admin/home.php">Food Adviser</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link padding0 dropdown-toggle whiteColor" href="#" id="userDropdown" role="button"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-light small"><?= $userFirstName ?> <?= $userLastName ?></span>
                <img class="img-profile rounded-circle profile_pic" src="<?= $userImage ?>">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../admin/yourFavourites.php">
                    Your favourite restaurants
                </a>
                <a class="dropdown-item" href="../admin/planInternity.php">
                    Your places to visit
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../logout.php">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    Logout
                </a>
            </div>
        </li>
    </ul>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>