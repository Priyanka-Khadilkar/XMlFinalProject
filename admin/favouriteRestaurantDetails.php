<?php
require_once "../includes/adminHeader.php";
require_once "../api/Restaurant.php";

if (isset($_GET["id"])) {

    $restauanrtId = $_GET["id"];
    $restaurantDetail = GetRestaurantDetailById($restauanrtId);
    $name = $restaurantDetail->name;
    $rating = $restaurantDetail->user_rating->aggregate_rating;
    $cuisines = $restaurantDetail->cuisines;
    $address = $restaurantDetail->location->address;
    $phone_numbers = $restaurantDetail->phone_numbers;
    $thumb = $restaurantDetail->thumb;
    $latitude = $restaurantDetail->location->latitude;
    $logitude = $restaurantDetail->location->longitude;
    $average_cost_for_two = $restaurantDetail->average_cost_for_two;
    $currency = $restaurantDetail->currency;
    $timings = $restaurantDetail->timings;
    $id = $restaurantDetail->id;
}
?>
    <main role="main" class="container">
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4 box-shadow">
                            <div class="card-body">
                                <h5 class="card-title"><?= $name ?></h5>
                                <?php
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
                                        : </label><span> <?= $cuisines ?></span>
                                </div>
                                <div>
                                    <label class="text-darkPurple">Address
                                        : </label><span
                                    > <?= $address ?></span>
                                </div>
                                <div>
                                    <label class="text-darkPurple">phone number
                                        : </label> <span
                                    ><?= $phone_numbers ?></span>
                                </div>
                                <div>
                                    <label class="text-darkPurple">Average Cost for Two
                                        : </label><span
                                    > <?= $average_cost_for_two ?><?= $currency ?></span>
                                </div>
                                <div class="marginBottom">
                                    <label class="text-darkPurple">Timings :
                                        : </label><span
                                    > <?= $timings ?></span>
                                </div>
                                <div>
                                    <a href="yourFavourites.php" role="button" class="btn btn-secondary btn-lg">Back to
                                        favourite List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" id="lat" value="<?= $latitude ?>">
                        <input type="hidden" id="long" value="<?= $logitude ?>">
                        <div>
                            <img class="marginBottom"
                                 src="<?= $thumb ?>"
                                 alt="<?= $name ?>">
                            <div class="card">
                                <div class="card-body">
                                    <div class="responsiveMap" id="mapRestaurant">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
require_once "../includes/adminFooter.php"
?>