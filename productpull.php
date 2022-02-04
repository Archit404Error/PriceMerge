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
        <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        
            require_once 'simple_html_dom.php';
            function scrapeSite($siteURL, $listingClass, $listingOffset, $priceClass, $priceOffset, $linkClass, $linkOffset, $item){
                $dom = file_get_html($siteURL, false);
                if(!empty($dom)){
                    $listing = ($dom -> find($listingClass))[$listingOffset];
                    $price = ($listing -> find($priceClass))[$priceOffset];
                    if(strpos($price, "from") === false){
                        echo "<div class = 'row justify-content-center'><h1 class = 'col-md-8'>Sorry, we couldn't find your results. Try being more specific.</h1></div>";
                    }
                    else{
                        $realPrice = str_replace("<div class=\"dD8iuc\"><span class=\"HRLxBb\">", "", explode("from", $price)[0]);
                        $realPrice = str_replace("</span>", "", $realPrice);
                        $siteName = str_replace("</div>", "", explode("from", $price)[1]);
                        $link = ($listing -> find($linkClass))[$linkOffset];
                        $link = $link -> find('a')[0];
                        if(strpos($link -> href, "http://") > 0 or strpos($link -> href, "https://") > 0){
                            $url = "http://google.com". $link -> href;
                        }
                        else
                            $url = $link -> href;
                        $title =  $link -> plaintext;
                        echo "<div class = 'row text-center justify-content-center'><h3 style = 'font-size: 6vh;'>You searched for: ". str_replace("+", " ", $item). "</h3></div>";
                        echo "<div style = 'height: 2vh'></div>";
                        echo "<div class = 'row justify-content-center'><a href = 'http://www.pricemerge.com/itemsearch.php'><button class = 'btn btn-primary'>Return to Compare Tool</button></a></div>";
                        echo "<div style = 'height: 2vh'></div>";
                        echo "<div class = 'row'>";
                        echo "<div class = 'col-md-2'></div>";
                        echo "<div style = 'padding: 3%; width: 100%;' class = 'text-center info-section col-md-8'>";
                        echo "<h3 style = 'font-size: 5vh;'><u>Best Match</u></h3>";
                        echo "<h3 style = 'font-size: 3vh;'>$title</h3>";
                        echo "<h3 style = 'font-size: 3vh;'><b>$realPrice</b> from $siteName</h3>";
                        echo "<a href='$url'>Click Here to Buy It!</a>";
                        echo "<div class = 'col-md-2'></div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class = 'row justify-content-center'><h1 class = 'col-md-8'>Sorry, we couldn't find your results. Try being more specific.</h1></div>";
                }
            }
            $item = $_POST['userProd'];
            $item = str_replace(" ", "+", $item);
            scrapeSite("https://www.google.com/search?psb=1&tbm=shop&q=$item&ved=0CAQQr4sDKAJqFwoTCLbFn-2Eg-sCFUQKZQodElsJZRAC", '.P8xhZc', 0, '.dD8iuc', 1, '.rgHvZc', 0, $item);
        ?>
    </body>
</html>