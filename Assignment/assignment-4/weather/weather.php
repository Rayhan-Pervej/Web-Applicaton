<?php
$city=" ";

if (isset($_POST['submit'])) {
    $city = $_POST["city"];
    // API key
    $apiKey = "17d2f721f1759b6c6f2c11c619250860";

    // API endpoints for current weather and 5-day forecast with 3-hour intervals
    $currentWeatherUrl = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric";
    $forecastUrl = "https://api.openweathermap.org/data/2.5/forecast?q=$city&appid=$apiKey&units=metric";

    //  API request and  JSON data
    function getWeatherData($url) {
        $response = file_get_contents($url);
        return json_decode($response, true);
    }

    // current weather data
    $currentWeatherData = getWeatherData($currentWeatherUrl);

    //  5-day forecast data with 3-hour intervals
    $forecastData = getWeatherData($forecastUrl);

    //current weather
    $currentTemp=$currentWeatherData['main']['temp'];

    
    foreach ($forecastData['list'] as $forecast) {
        $date = date('Y-m-d', strtotime($forecast['dt_txt']));
        $time = date('H:i', strtotime($forecast['dt_txt']));
        
        
    }
}

else{
    $city = 'Dhaka';
    // API key
    $apiKey = "17d2f721f1759b6c6f2c11c619250860";

    // API endpoints for current weather and 5-day forecast with 3-hour intervals
    $currentWeatherUrl = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric";
    $forecastUrl = "https://api.openweathermap.org/data/2.5/forecast?q=$city&appid=$apiKey&units=metric";

    //  API request and  JSON data
    function getWeatherData($url) {
        $response = file_get_contents($url);
        return json_decode($response, true);
    }

    // current weather data
    $currentWeatherData = getWeatherData($currentWeatherUrl);

    //  5-day forecast data with 3-hour intervals
    $forecastData = getWeatherData($forecastUrl);

    //current weather
    $currentTemp=$currentWeatherData['main']['temp'];

    
    // foreach ($forecastData['list'] as $forecast) {
    //     $date = date('Y-m-d', strtotime($forecast['dt_txt']));
    //     $time = date('H:i', strtotime($forecast['dt_txt']));
        
        
    // }
}
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- font -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css -->

    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/weather.png" type="image/x-icon">

  <title>Weather</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light ">
    <a class="navbar-brand mx-auto navData" href="#"><img class="navText" src="img/weather.png" alt=""><h2>Weather</h2> </a> 
    
  </nav>

  <section class="formSection d-flex justify-content-center">
    <div class=" col-md-2 col-lg-2 col-xl-1 col-sm-3 col-4 text-center my-3">
      <form method="post">
        <div class="form-group ">
          <label class="formHeader"><h3>Enter City</h3></label>
          <input type="text" id="namneInput" name="city" class="form-control" id="exampleInputPassword1" placeholder=" <?php echo $city; ?>" required>
        </div>
        <input type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary"></input>
      </form>
    </div>
  </section>


<section class="banner">
    <h2> Weather Status For <span id="capitalize"> <?php echo $city; ?> </span></h2>
</section>


  <section class="weatherMain d-flex justify-content-center">
    <div class="card text-white mb-3 my-4">
        <div class="card-body">
            <h4>Current Temperature</h4>
            <div class="imgTemp">
                <img src="http://openweathermap.org/img/wn/<?php echo $currentWeatherData['weather'][0]['icon']?>@4x.png" class="weatherIcon" />
                <h3 class="card-text"><span id="current_temp"><?php echo $currentTemp ."°C"; ?></span></h3>

                <h3 style=" margin-left:1rem; color:rgb(13, 9, 44);" ><span id="capitalize"><?php echo $currentWeatherData['weather'][0]['description']; ?></span></h3>
            </div>
            <div class="otherInfo">
                <div class="otherInfoData">
                    <h5>Wind</h5>
                    <p><?php echo $currentWeatherData['wind']['speed'] ." km/h"; ?></p>
                </div>

                <div class="otherInfoData">
                    <h5>Humidity</h5>
                    <p><?php echo $currentWeatherData['main']['humidity'] ."%"; ?></p>
                </div>

                <div class="otherInfoData">
                    <h5>Pressure</h5>
                    <p><?php echo $currentWeatherData['main']['pressure'] ." mb"; ?></p>
                </div>
            </div>
        </div>
    </div>
  </section>

  <section class="forcast">
    
    <div class="container">
        <h3> 5 Days Weather </h3>
        <?php
        $groupedForecast = []; // Group forecast data by date
        foreach ($forecastData['list'] as $forecast) {
            $date = date('Y-m-d', strtotime($forecast['dt_txt']));
            $groupedForecast[$date][] = $forecast;
        }

        foreach ($groupedForecast as $date => $dailyForecast) :
        ?>
            <div class="card " >
                <div class="card-body">
                    <h6 class="card-title"><?php echo $date; ?></h6>
                    <div class="card-group">
                        <?php foreach ($dailyForecast as $forecast) : ?>
                            <?php
                            $time = date('H:i', strtotime($forecast['dt_txt']));
                            $temperature = $forecast['main']['temp'];
                            $weatherIcon = $forecast['weather'][0]['icon'];
                            $weatherDescription = $forecast['weather'][0]['description'];
                            ?> 
                            <div class="card text-center">
                                <div class="card-body">
                                    <img src="http://openweathermap.org/img/wn/<?php echo $weatherIcon; ?>@4x.png" class="weatherIcon" style="width: 50px; height: 50px;" />
                                    <h5 class="card-title"><?php echo $temperature . "°C"; ?></h5>
                                    <p class="card-text"><?php echo $time; ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

</body>

</html>