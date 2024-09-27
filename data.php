<?php
// Fetch GET parameters
$lat = isset($_GET['lat']) ? $_GET['lat'] : '47.5548'; // Default to Basel
$lon = isset($_GET['lon']) ? $_GET['lon'] : '7.57327'; // Default to Basel
$unit = isset($_GET['unit']) ? $_GET['unit'] : 'C'; // Default to Celsius

// build api url with the new lat and lon
$apikey = 'aa9fc0896077'; 
$apiUrl = "https://my.meteoblue.com/packagesV2/basic-day?apikey=" . $apikey . "&lat=" . $lat . "&lon=" . $lon;

$jsonData = file_get_contents($apiUrl);
$weatherData = json_decode($jsonData, true);

//so the city name changes
if ($lat == '46.948' && $lon == '7.447') {
    $cityName = 'Bern';
} elseif ($lat == '47.367' && $lon == '8.550') {
    $cityName = 'Zurich';
} else {
    $cityName = 'Basel';
}

//new array to hold all the processed weather data
$newWeatherData = [];

foreach (range(0, 4) as $dayIndex) { //loop for each day

    $dailyData = new stdClass(); // new class for allll the data
    
    // for the date
    $date = new DateTime($weatherData["data_day"]["time"][$dayIndex]);
    $dailyData->date = $date->format('d.m');

    // for the temperatures
    $temperature_max = $weatherData["data_day"]["temperature_max"][$dayIndex];
    $temperature_min = $weatherData["data_day"]["temperature_min"][$dayIndex];

    $dailyData->temperature_max = ($temperature_max < 0 && $temperature_max > -0.5) ? 0 : round($temperature_max); //to get and format the temperature
    $dailyData->temperature_min = ($temperature_min < 0 && $temperature_min > -0.5) ? 0 : round($temperature_min);

    if ($unit == 'F') {
        // Convert to Fahrenheit
        $dailyData->temperature_max = round($temperature_max * 9/5 + 32); //to get and format the temperature
        $dailyData->temperature_min = round($temperature_min * 9/5 + 32);
        $temperatureUnit = ' °F';
    } else {
        // Keep in Celsius
        $dailyData->temperature_max = round($temperature_max);
        $dailyData->temperature_min = round($temperature_min);
        $temperatureUnit = ' °C'; //better 2 if/else for this? temperature unit only needs to be loaded once...
    }

    // for the pictogramm
    $pictocode = $weatherData["data_day"]["pictocode"][$dayIndex];
    $formattedPictocode = str_pad($pictocode, 2, "0", STR_PAD_LEFT); //function to format the pictocode --> always two digit
    $dailyData->imageUrl = "https://static.meteoblue.com/assets/images/picto/" . $formattedPictocode . "_iday.svg";

    // Add the data to the array
    $newWeatherData[] = $dailyData;
}

// Prepare frost warnings
$frostDates = [];
foreach ($newWeatherData as $dailyData) {
    if ($dailyData->temperature_min < 0) {
        $frostDates[] = $dailyData->date;
    }
}
?>