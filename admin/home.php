<?php
require_once "../includes/adminHeader.php";
require_once "../api/Restaurant.php";
require_once "../database/UserContext.php";
$restaurantList = null;
$locationdata = null;
$city = "";
$cityName = "";
$userDbId = $_SESSION['db_id'];
function SearchData($city)
{
    Global $restaurantList;
    $locationdata = GetLocationDetail($city);
    if (count($locationdata["location_suggestions"]) > 0) {
        $entityType = $locationdata["location_suggestions"][0]["entity_type"];
        $entity_id = $locationdata["location_suggestions"][0]["entity_id"];
        $restaurantList = GetTrendingRestaurantDetail($entity_id, $entityType);
    } else {
        echo "Please enter valid city name";
    }
}

$userContext = new UserContext();
$city = $userContext->GetRandomCity($userDbId);
if ($city != null) {
    $cityName = $city->city_id;
    $locationdata = GetLocationDetail($city->city_id);
    if ($locationdata != null) {
        if (count($locationdata["location_suggestions"]) > 0) {
            $entityType = $locationdata["location_suggestions"][0]["entity_type"];
            $entity_id = $locationdata["location_suggestions"][0]["entity_id"];
            $restaurantList = GetTrendingRestaurantDetail($entity_id, $entityType);
        } else {
            echo "Please enter valid city name";
        }
    }
}


//btn Add to favourite
if (isset($_POST["btnAddToFavourite"])) {
    $address = $_POST["address"];
    $name = $_POST["name"];
    $id = $_POST["id"];
    $searchCity = $_POST["searchCity"];
    $userDbId = $_SESSION['db_id'];
    SearchData($searchCity);
    //Check Restaurant Exist or not
    $userContext = new UserContext();
    $restaurantExist = $userContext->CheckRestaurantExist($id);
    if ($restaurantExist == null) {
        $userContext = new UserContext();
        $addedRestaurant = $userContext->AddRestaurant($id, $name, $address);
    } else {
        $addedRestaurant = $restaurantExist->id;
    }
    $userContext = new UserContext();
    $restaurantExist = $userContext->CheckRestaurantExistForUser($userDbId, $addedRestaurant);
    if ($restaurantExist == null) {
        $userContext = new UserContext();
        $restaurantExist = $userContext->AddFavRestaurantForUser($userDbId, $addedRestaurant);
    }
    header('Location: yourFavourites.php');
}
?>
    <main role="main" class="container">
        <div class="jumbotron">
            <h1>Find the best restaurants, cafés, and bars advise</h1>
            <form action="searchFood.php" target="_blank" METHOD="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="city" id="inputEmail4"
                               placeholder="Enter City to search">
                    </div>
                    <div class="form-group col-md-6">
                        <button type="submit" name="searchBtn" class="btn bg_darkPurple">Search</button>
                    </div>
                </div>
            </form>
            <div class="form-row">
                <a href="planInternity.php" class="btn btnRed">Add places to visit </a>
            </div>
        </div>
        <div>
            <?php
            if ($restaurantList != null) {
                ?>
                <h4>Recommendation for you</h4>
            <?php } ?>

        </div>
        <div class="album py-5 bg-light">
            <div class="container">
                <?php
                if ($restaurantList != null) {
                    ?>
                    <h5>Trending this week in <?= $cityName ?></h5>
                <?php } ?>
                <div class="row">
                    <?php
                    if ($restaurantList != null) {
                        ?>
                        <?php foreach ($restaurantList->restaurants as $item) {
                            ?>
                            <div class="col-md-4">
                                <form method="post" action="" class="card mb-4 box-shadow">
                                    <img class="card-img-top imgHeight200"
                                         src="<?= $item->restaurant->thumb ?>"
                                         alt="<?= $item->restaurant->name ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><span
                                            ><?= $item->restaurant->name ?><span></span></h5>
                                        <?php
                                        $rating = $item->restaurant->user_rating->aggregate_rating;
                                        echo $rating;
                                        echo "<span class='stars'>";
                                        for ($i = 1; $i <= 5; $i++) {
                                            if (round($rating - .25) >= $i) {
                                                echo "<i class='fa fa-star'></i>"; //fas fa-star for v5
                                            } elseif (round($rating + .25) >= $i) {
                                                echo "<i class='fa fa-star-half-o'></i>"; //fas fa-star-half-alt for v5
                                            } else {
                                                echo "<i class='fa fa-star-o'></i>"; //far fa-star for v5
                                            }
                                        }
                                        echo '</span>';
                                        ?>
                                        <div>
                                            <label class="text-darkPurple">Cuisines
                                                : </label><span
                                            > <?= $item->restaurant->cuisines ?></span>
                                        </div>
                                        <div>
                                            <label class="text-darkPurple">Address
                                                : </label><span
                                            > <?= $item->restaurant->location->address ?></span>
                                        </div>
                                        <div>
                                            <label class="text-darkPurple">Phone Numbers
                                                : </label> <span
                                            ><?= $item->restaurant->phone_numbers ?></span>
                                        </div>
                                        <input type="hidden" name="id"
                                               value="<?= $item->restaurant->id ?>">
                                        <input type="hidden" name="name"
                                               value="<?= $item->restaurant->name ?>">
                                        <input type="hidden" name="cuisines"
                                               value="<?= $item->restaurant->cuisines ?>">
                                        <input type="hidden" name="address"
                                               value="<?= $item->restaurant->location->address ?>">
                                        <input type="hidden" name="thumb"
                                               value="<?= $item->restaurant->thumb ?>">
                                        <input type="hidden" name="phone_numbers"
                                               value="<?= $item->restaurant->phone_numbers ?>">
                                        <input type="hidden" name="timings"
                                               value="<?= $item->restaurant->timings ?>">
                                        <input type="hidden" name="average_cost_for_two"
                                               value="<?= $item->restaurant->average_cost_for_two ?>">
                                        <input type="hidden" name="aggregate_rating"
                                               value="<?= $item->restaurant->user_rating->aggregate_rating ?>">
                                        <input type="hidden" name="currency"
                                               value="<?= $item->restaurant->currency ?>">
                                        <input type="hidden" name="latitude"
                                               value="<?= $item->restaurant->location->latitude ?>">
                                        <input type="hidden" name="longitude"
                                               value="<?= $item->restaurant->location->longitude ?>">
                                        <input type="hidden" name="searchCity"
                                               value="<?= $cityName ?>">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button formaction="restaurantDetail.php" formtarget="_blank"
                                                        type="submit"
                                                        name="btnViewDetail"
                                                        class="btn btn-sm btn-outline-secondary">View
                                                    Details
                                                </button>
                                                <button type="submit" formtarget="_self" id="postFavoriteData"
                                                        name="btnAddToFavourite"
                                                        class="btn btn-sm btn-outline-secondary">Add to
                                                    Favourite
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>
    </main>
<?php require_once "../includes/adminFooter.php" ?>