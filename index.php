<?php
include 'data.php';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>☀️ Wetter in <?php echo $cityName; ?></title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="app.js"></script>
</head>
<body>
<div class="flex-container locations">
    <div class="switch-container">
        <a href="?lat=47.5548&lon=7.57327&unit=<?php echo $unit; ?>" data-lat="47.5548" data-lon="7.57327" class="<?php echo ($lat == '47.5548' && $lon == '7.57327') ? 'active-link' : ''; ?>">Basel</a>
        <a href="?lat=46.948&lon=7.447&unit=<?php echo $unit; ?>" data-lat="46.948" data-lon="7.447" class="<?php echo ($lat == '46.948' && $lon == '7.447') ? 'active-link' : ''; ?>">Bern</a>
        <a href="?lat=47.367&lon=8.550&unit=<?php echo $unit; ?>" data-lat="47.367" data-lon="8.550" class="<?php echo ($lat == '47.367' && $lon == '8.550') ? 'active-link' : ''; ?>">Zurich</a>
    </div>
</div>
<div class="flex-container temperature-unit">
    <div class="switch-container">
        <a href="?unit=C&lat=<?php echo $lat; ?>&lon=<?php echo $lon; ?>" data-unit="C" class="<?php echo ($unit == 'C') ? 'active-link' : ''; ?>">Celsius</a>
        <a href="?unit=F&lat=<?php echo $lat; ?>&lon=<?php echo $lon; ?>" data-unit="F" class="<?php echo ($unit == 'F') ? 'active-link' : ''; ?>">Fahrenheit</a>
    </div>
</div>
<div id="content">
    <?php include 'content.php'; ?>
</div>
</body>
</html>
