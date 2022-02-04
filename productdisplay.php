<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=.75">
        <meta charset="utf-8">
        <link rel="shortcut icon" href="favicon.png">
        <title>Coronavirus Product Tracker - PriceMerge, track important CoronaVirus related resources online!</title>
        <meta name="description" content="The Coronavirus product tracker tool compares important information for PPE such as hand sanitizer, soap, face masks etc. 
        across thousands of sites! We also let you indicate what price you'd like to buy a product at, and we will automatically email you when the price drops below 
        that amount!">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel = "stylesheet" type = "text/css" href = "style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <link rel="stylesheet" type="text/css" href="animate.css">
        <script src="wow.min.js"></script>
        <script>
            new WOW().init();
        </script>
        <style>
            .section{
                background-color: "#fafafa";
            }
            body{
                background-color: #eff1f4;
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
                  <li class="nav-item">
                    <a style = "color: white;" class="nav-link" href="itemsearch.php">Compare Prices</a>
                  </li>
                  <li class="nav-item active">
                    <a style = "color: white;" class="nav-link" href="productdisplay.php">Product Watchlist<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a style = "color: white;" class="nav-link" href="about.html">About Us</a>
                  </li>
                </ul>
            </div>
        </nav>
        <div style = "height: 10vh;"></div>
        <center>
            <h1 class = "animated wow fadeInUp">Product Watchlist</h1>
            <h3 class = "col-md-6 animated wow fadeInUp" style = "color: #450600">This tool automatically updates the lowest prices of products that you want to track over time. It updates a product's cheapest price every 10 minutes and notifies you via email when prices drop below the limits you've indicated. By default, we have several important Coronavirus products in the watchlist so that you can save money and stay safe! To compare prices of other products, use the item comparison tool <a href = "itemsearch.php">here</a></h3>
        </center>
        <div style = "height: 2vh"></div>
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
                        " updated ". fmod((time() - $row['time']), 120). " seconds ago!";
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
        <!-- BootStrap JS Stuff Start -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- BootStrap JS Stuff End -->
    </body>
</html>
