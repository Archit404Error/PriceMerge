<html>
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=.75">
        <title>Coronavirus Product Tracker - PriceMerge, track important CoronaVirus related resources online!</title>
        <meta name="description" content="The Coronavirus product tracker tool compares important information for PPE such as hand sanitizer, soap, face masks etc. 
        across thousands of sites! We also let you indicate what price you'd like to buy a product at, and we will automatically email you when the price drops below 
        that amount!">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel = "stylesheet" type = "text/css" href = "style.css">
        <style>
            .section{
                background-color: "#fafafa";
            }
            body{
                background-color: #fafafa;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light main-navigation">
            <a class="navbar-brand" href="index.php"><img style = "height: 5vh" src = "sitelogo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a style = "color: white;" class="nav-link" href="index.php">Home</a>
                  </li>
                  <li class="nav-item active">
                    <a style = "color: white;" class="nav-link" href="productdisplay.php">Coronavirus Product Tracker<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a style = "color: white;" class="nav-link" href="about.html">About Us</a>
                  </li>
                </ul>
            </div>
        </nav>
        <div style = "height: 10vh;"></div>
        <center>
            <h1>Coronavirus Product Tracker</h1>
            <h3 class = "col-md-6">This tool lets you compare prices across thousands of sites to find the best deals on vital COVID-19 Products. You can also indicate what price you want to buy a product at and get an email when the price drops!</h3>
        </center>
        <?php
            $products = ["Tissues", "Face Mask", "Hand Sanitizer", "Toilet Paper", "Soap"];
            $servername = "localhost";
            $username = "pricemerger";
            $password = "Pricemerge123!";
            $database = "Popularpricemerge";
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                // set the PDO error mode to exception
                $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $time = time();
                $id = rand();
                $conn -> exec("INSERT INTO `Visitors` (`time`, `id`) VALUES ('$time', '$id')");
                $sql = "SELECT * FROM `Popular` WHERE 1;";
                $result = $conn -> query($sql);
                $result -> setFetchMode(PDO::FETCH_ASSOC);
                if($result -> rowCount() > 0){
                    while($row = $result -> fetch()){
                        echo "<div class = 'row'>";
                        echo "<div class = 'col-md-2'></div>";
                        echo "<div style = 'padding: 5%;' class = 'text-center info-section col-md-8'>";
                        echo "<h3 style = 'font-size: 5vh;'><u>". $products[intval($row['id'])]. "</u></h3>";
                        echo "<h3 style = 'font-size: 3vh;'>". $row['Name']. "</h3>";
                        echo "<h3 style = 'font-size: 3vh;'><b>". $row['Price']. "</b> from ". $row['Site']. "</h3>";
                        echo " <a href='". $row['URL']. "'>Click Here to Buy It!</a>, product".
                        " updated ". (time() - $row['time']). " seconds ago!";
                        echo "<div class = 'col-md-2'></div>";
                        echo "<div style = 'height: 3vh'></div>";
                        echo "<form class=\"justify-content-center text-center\" action = \"emaildata.php\" method = POST>
                          <div class=\"form-group col-sm-12 col-md-8 offset-md-2\">
                            <label for=\"staticEmail2\">Email Me At: </label>
                            <input type=\"email\" required name = \"email\"class=\"form-control\" id=\"staticEmail2\" placeholder =\"email@example.com\">
                          </div>
                          <div class=\"form-group col-sm-12 col-md-8 offset-md-2\">
                            <label for=\"price\">When Price Falls Below: </label>
                            <input type=\"text\" required name = \"price\"class=\"form-control\" id=\"price\" placeholder=\"\$100\">
                          </div>
                          <input type = \"hidden\" name = \"hiddenVal\" value =". $row['id']. ">
                          <button type=\"submit\" class=\"btn btn-primary mb-2\">Confirm</button>
                        </form>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div style = 'height: 3vh;'></div>";
                    }
                }
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        ?>
    </body>
</html>
