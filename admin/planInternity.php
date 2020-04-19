<?php
require_once "../includes/adminHeader.php";
require_once "../database/UserContext.php";
$userDbId = $_SESSION['db_id'];

$userContext = new UserContext();
$cities = $userContext->ListAllUserCity($userDbId);
?>
<main role="main" class="container">
    <div class="album py-5 bg-light">
        <h1>Places to visit</h1>
        <form>
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <label>Enter places to visit</label>
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="autocomplete">Enter places to visit</label>
                    <input id="autocomplete" name="autocomplete" class="form-control mb-2" placeholder="Enter a city"
                           type="text"/>
                </div>
                <div class="col-auto">
                    <input type="hidden" id="userDbId" value="<?= $userDbId ?>"/>
                    <input type="button" id="addCity" class="btn btnRed mb-2" value="Add"/>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-sm-6">
                <ul id="userCityList" class="list-group">
                    <?php foreach ($cities as $city) { ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= $city->city_id ?>
                            <a href="#" id="<?= $city->id ?>" class="deleteUserCity">Remove</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div id="iternityMap"></div>
            <div id="listing">
                <table id="resultsTable">
                    <tbody id="results"></tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php
require_once "../includes/adminFooter.php"
?>

