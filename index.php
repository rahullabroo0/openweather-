<?php
session_start();

$add="";
if(isset($_POST['city']))
{
$city=$_POST['city'];
$_SESSION['add1'].="<option value=".$city.">".$city."</option>";
$add=$_SESSION['add1'];
// echo $city;
}
$apiKey = "755c7c3f884cd176bbd63cb6260534ea";
if(!empty($city)){
    $cityId = $city;    
}else{
$cityId = "1273294";
}
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();
?>

<!doctype html>
<html>
<head>
<title>Forecast Weather using OpenWeatherMap with PHP</title>

<style>
body {
    font-family: Arial;
    font-size: 0.95em;
    color: #929292;
}

.report-container {
    border: #E0E0E0 1px solid;
    padding: 20px 40px 40px 40px;
    border-radius: 2px;
    width: 550px;
    margin: 0 auto;
}

.weather-icon {
    vertical-align: middle;
    margin-right: 20px;
}

.weather-forecast {
    color: #212121;
    font-size: 1.2em;
    font-weight: bold;
    margin: 20px 0px;
}

span.min-temperature {
    margin-left: 15px;
    color: #929292;
}

.time {
    line-height: 25px;
}
</style>

</head>
<body>

    <div class="report-container">
<form action="#" method="post" >
<select name="city">
    <option value="1273294">Delhi</option>
    <option value="1269515">Jaipur</option>
    <option value="1268865">Jodhpur</option>
</select>
<br><br>
<input type="submit" name="submit" value="submit">
</form>
<br>
<label>favorities</label>
<?php 
if(isset($city)){
 echo "<select name='city1'>";
 
 echo $add;
 echo "</select>";
}
?>
<?php
// if(!isset($_SESSION['add1'])){
// echo "<a href=".session_destroy().">Logout</a>";
// }else{
//     echo "<a href=".session_destroy().">Logout</a>";
// }
?>
<?php   $w='<h2>'. $data->name.' Weather Status</h2>
        <div class="time">
            <div>' .date("l g:i a", $currentTime).' </div>
            <div>' .date("jS F, Y",$currentTime).' </div>
            <div>' .ucwords($data->weather[0]->description).' </div>
        </div>
        <div class="weather-forecast">
            <img
                src="http://openweathermap.org/img/w/'.$data->weather[0]->icon.'.png"
                class="weather-icon" />' .$data->main->temp_max.' &deg;C<span
                class="min-temperature">' .$data->main->temp_min.' &deg;C</span>
        </div>
        <div class="time">
            <div>Humidity:' .$data->main->humidity.' %</div>
            <div>Wind:'   .$data->wind->speed.' km/h</div>
        </div>
    </div>';
    echo $w;
     echo '<a href="mail.php"> mail</a>';
    $_SESSION['w']=$w;
    ?>


</body>
</html>