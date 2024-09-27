<h1>Wetter in <?php echo $cityName; ?></h1>
<div class="weather"><!-- loop for each day -->
    <?php foreach ($newWeatherData as $dailyData) : ?>
        <div class="day">
            <div class="time"><?php echo $dailyData->date ?></div>
            <div class="weather-svg">
                <img src="<?php echo $dailyData->imageUrl ?>" width="76" height="66">
            </div>
            <div class="temperature">
                <div class="temperature_max"><?php echo $dailyData->temperature_max ?><?php echo $temperatureUnit?></div>
                <div class="temperature_min"><?php echo $dailyData->temperature_min ?><?php echo $temperatureUnit?></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php
if (!empty($frostDates)) {
    $frostWarning = "<b>Achtung:</b>Frostgefahr am " . implode(" und am ", $frostDates) . "!";
    echo '<div class="weather-warning">';
    echo '<img class="snowflake" src="./snowflake.svg"></img>';
    echo  $frostWarning;
    echo '</div>';
}
?>
