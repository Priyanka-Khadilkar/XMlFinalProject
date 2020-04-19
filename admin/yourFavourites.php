<?php
require_once "../includes/adminHeader.php";
require_once "../database/UserContext.php";
$userContext = new UserContext();
$userDbId = $_SESSION['db_id'];
$restaurantList = $userContext->ListAllFavRestaurants($userDbId);
?>
<main role="main" class="container">
    <div class="album py-5 bg-light">
        <div class="container">
            <h1>Your Favorite Restaurants</h1>
            <div class="row">
                <?php
                if ($restaurantList != null) {
                    foreach ($restaurantList as $item) {
                        ?>
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <div class="card-body">
                                    <h5 class="card-title"><span
                                        ><?= $item->name ?><span></span></h5>
                                    <div>
                                        <label class="text-darkPurple">Address
                                            : </label><span
                                        > <?= $item->address ?></span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="favouriteRestaurantDetails.php?id=<?=$item->zomato_id?>"
                                               class="btn btn-sm btn-outline-secondary">View
                                                Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</main>
<?php
require_once "../includes/adminFooter.php"
?>
