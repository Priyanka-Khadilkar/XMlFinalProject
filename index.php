<?php include('GoogleConfiguration.php');

require_once "database/UserContext.php";

if (isset($_SESSION['access_token'])) {
    header('Location: admin/home.php');
    exit();
}

//Set Login URL for google
$loginURL = $google_client->createAuthUrl();

if (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        if (!empty($data['id'])) {
            $_SESSION['user_id'] = $data['id'];

            $userContext = new UserContext();
            $user = $userContext->CheckUserExist($data['id']);
            if ($user == null) {
                $userContext = new UserContext();
                $user = $userContext->Add($data['id'], $data['email']);
                $_SESSION['db_id'] = $user;
            } else {
                $_SESSION['db_id'] = $user->id;
            }
        }
        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }
        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }
        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }
        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }
        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
        header('Location: admin/home.php');
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Food Adviser</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg_purple">
    <a class="navbar-brand logo" href="#">Food Adviser</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
<main role="main" class="container">
    <div class="jumbotron">
        <h1>Find the best restaurants, cafés, and bars advise</h1>
        <p class="lead">Ever needed to make a restaurant decision on the fly with a bunch of indecisive hungry? or maybe
            do you want itinerary ready with your favourite restaurants?
            if that’s the case then we’re hear to help!</p>
        <a class="btn btngoogle btn-lg bg_darkPurple" href="<?php echo $loginURL ?>" role="button">Login with Your Google
            account</a>
    </div>
</main>
<footer class="fixed-bottom bg_purple">
    <div class="padding9em container">
        &copy; Copyright 2020, Food Adviser
    </div>
</footer>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>