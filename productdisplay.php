<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <nav class="navbar navbar-light main-navigation">
          <a class="navbar-brand" href="index.html" style = "color: white;">PriceMerge</a>
        </nav>
        <div style = "height: 10vh;"></div>
        <?php
            $products = ["Tissues", "Face Mask", "Hand Sanitizer", "Toilet Paper", "Soap"];
            $servername = "localhost";
            $username = "id13018007_admin";
            $password = "Pricemerge123!";
            $database = "id13018007_products";
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                // set the PDO error mode to exception
                $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM `Popular` WHERE 1;";
                $result = $conn -> query($sql);
                $result -> setFetchMode(PDO::FETCH_ASSOC);
                if($result -> rowCount() > 0){
                    while($row = $result -> fetch()){
                        echo "<div class = 'row'>";
                        echo "<div class = 'col-md-2'></div>";
                        echo "<div class = 'text-center info-section col-md-8'>";
                        echo "<h1>Product Type: ". $products[intval($row['id'])]. "</h1>";
                        echo "<h3>". $row['Name']. "</h3>";
                        echo "<h3>". $row['Price']. " from ". $row['Site']. "</h3>";
                        echo " <a href='". $row['URL']. "'>Link</a>, product".
                        " updated ". (time() - $row['time']). " seconds ago!";
                        echo "<div class = 'col-md-2'></div>";
                        echo "<div style = 'height: 3vh'></div>";
                        echo "<form class=\"form-inline\" action = \"emaildata.php\" method = POST>
                          <div class=\"form-group mb-2\">
                            <label for=\"staticEmail2\">Email Me At: </label>
                            <input type=\"email\" required name = \"email\"class=\"form-control\" id=\"staticEmail2\" placeholder =\"email@example.com\">
                          </div>
                          <div class=\"form-group mx-sm-3 mb-2\">
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
