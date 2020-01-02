<meta charset="UTF-8">
<?php
if ($_POST["town"]) {
    $weather = "";
    $error = "";
    $site = file_get_contents('https://www.weather-forecast.com/locations/' . str_replace(' ', '', $_POST["town"]) . '/forecasts/latest');
    $file_headers = @get_headers('https://www.weather-forecast.com/locations/' . str_replace(' ', '', $_POST["town"]) . '/forecasts/latest');
    if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        $error = 'City not found';
    } else {
        $array = explode('<span class="phrase">', $site);
        $secondArray = explode('</span>', $array[1]);
        $weather = $secondArray[0];
    }
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>
    body {
        background-image: url("http://www.setwalls.ru/pic/201507/1920x1080/setwalls.ru-81765.jpg");
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    .container {
        width: 50%;
        padding: 20px;
        text-align: center;
        border: 2px;
        border-radius: 10px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%)
    }

    input {
        width: 40%;
    }
</style>
<div class="container">
    <form method="post">
        <div class="form-group">
            <label for="sity"><h2>Enter the name of the city</h2></label>
            <input type="text" class="form-control" name="town" placeholder="Paris, Moscow">
        </div>
        <button type="submit" class="btn btn-primary">Discover</button>
    </form>
    <div style="text-align: center">
        <?php if ($weather) {
            echo '<div class="alert alert-success" role="alert"><h2>Weather in ' . $_POST["town"] . '</h2><br>' . $secondArray[0] . '</div>';
        } else if ($error) {
            echo '<div class="alert alert-danger" role="alert"><h4>' . $error . '</h4><br><h5>Check the spelling of the city (in English)</h5></div>';
        }
        ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>