function initializeMap() {
    initRestauarntMap();
    initMap();
}

function initRestauarntMap() {
    var mapDiv = document.getElementById('mapRestaurant');
    if (mapDiv != undefined && mapDiv != null) {
        var lat = parseFloat($("#lat").val());
        var lng = parseFloat($("#long").val());
        var restaurantLocation = {lat: lat, lng: lng};
        var map = new google.maps.Map(mapDiv, {zoom: 18, center: restaurantLocation});
        var marker = new google.maps.Marker({position: restaurantLocation, map: map});
    }
}

var map, places;
var autocomplete;
var formattedAddress;

function initMap() {
    var iternityMap = document.getElementById('iternityMap');
    if (iternityMap != undefined && iternityMap != null) {
        map = new google.maps.Map(document.getElementById('iternityMap'), {
            mapTypeControl: false,
            panControl: false,
            zoomControl: false,
            streetViewControl: false
        });
        // Create the autocomplete object and associate it with the UI input control.
        // Restrict the search to the default country, and to place type "cities".
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */ (
                document.getElementById('autocomplete')), {
                types: ['(cities)']
            });
        places = new google.maps.places.PlacesService(map);

        autocomplete.addListener('place_changed', onPlaceChanged);

        // Add a DOM event listener to react when the user selects a country.
        // autocomplete.setComponentRestrictions([]);
    }
}

// When the user selects a city, get the place details for the city and
// zoom the map in on the city.
function onPlaceChanged() {
    var place = autocomplete.getPlace();
    if (place.geometry) {
        formattedAddress = place.vicinity;
        // console.log(place);
        //console.log(place.geometry.location);
        //alert(place.geometry.location);
    } else {
        document.getElementById('autocomplete').placeholder = 'Enter a city';
    }
}

function RefreshSomeEventListener() {
    // Remove handler from existing elements
    $("#userCityList .deleteUserCity").off();

    // Re-add event handler for all matching elements
    $("#userCityList .deleteUserCity").on("click", function() {
        var placeId = $(this).attr('id');
        var userId = $("#userDbId").val();
        $.get("../api/deleteCityFromUSer.php", {placeId: placeId})
            .done(function (data) {
                LoadUserCityData(userId)
            });
    });
}

function LoadUserCityData(userId) {
    $.get("../api/getUserCity.php", {user_id: userId})
        .done(function (data) {
            $("#userCityList").html("");
            $.each(data, function (i, item) {
                $("#userCityList").append("<li class='list-group-item d-flex justify-content-between align-items-center' value='" + item.id + "'>" + item.city_id +
                    "<a href='#' id='" + item.id + "' class='deleteUserCity'>Remove</a></li>");
            });
            RefreshSomeEventListener();
        });
}

$(function () {
    $('#userCityList').on('click', 'li.deleteUserCity', function () {
        var placeId = $(this).attr('id');
        var userId = $("#userDbId").val();
        $.get("../api/deleteCityFromUSer.php", {placeId: placeId})
            .done(function (data) {
                LoadUserCityData(userId)
            });
    });
    $("#addCity").click(function () {
        //alert("click");
        $city = formattedAddress;
        var userId = $("#userDbId").val();
        $.post('../api/addCityToUser.php',
            {cityName: $city, userId: userId},
            function (data) {
                LoadUserCityData(userId);
            }
        )
    });
    RefreshSomeEventListener();
})

