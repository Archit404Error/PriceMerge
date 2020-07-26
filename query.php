<html>
  <head>
    <link rel = "stylesheet" type = "text/css" href = "pace.css">
    <script src = "pace.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amiri&display=swap" rel="stylesheet">
    <style>
      h1{
        font-family: 'Lato', sans-serif;
        font-size: 6vh;
        color: black;
      }
      h2{
        font-family: 'Lato', sans-serif;
        font-size: 4vh;
        color: black;
      }
    </style>
  </head>
  <body>
    <div class = "text-center">
  <?php

    //Debugging code start
    //ini_set('display_errors', '1');
    //ini_set('display_startup_errors', '1');
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    //Debugging code end

    //Begin prices array
    $priceVals = array();
    //End prices array


    //Curl function start
    function curl($url){
      $headers[]  = "User-Agent:Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13";
      $headers[]  = "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
      $headers[]  = "Accept-Language:en-us,en;q=0.5";
      $headers[]  = "Accept-Encoding:gzip,deflate";
      $headers[]  = "Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.7";
      $headers[]  = "Keep-Alive:115";
      $headers[]  = "Connection:keep-alive";
      $headers[]  = "Cache-Control:max-age=0";

      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($curl, CURLOPT_ENCODING, "gzip");
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
      $data = curl_exec($curl);
      curl_close($curl);
      return $data;
    }
    //Curl function end

    //Search Function start
    function scrapeSearch($url, $toFind, $i, $sitename, $category, $end, $linktags, $starttwo, $startLink){
      global $priceVals;
      $html = curl($url);
      $compPrice = "<h1>". $sitename. "<br></h1><h5><span class='badge badge-secondary'>$category</span></h5><h2>";
      $price = "";
      while($i < $end){
        $curr = "";
        if(strpos($html, $toFind) !== false){
          $curr = $html{strpos($html, $toFind) + $i};
        } else {
          $compPrice = $compPrice. "word not found";
          break;
        }
        if($curr == "<"){
          break;
        }
        if($curr == ">"){
          $curr = "";
        }
        $price = $price. $curr;
        $i++;
      }
      if(strpos($price, '$') === false and strpos($price, '₹') === false){
        $price = '$'. $price;
      }
      if(strpos($price, "Access") === true){
        $price = "Not Found";
      }
      if($sitename == "FlipKart"){
        $price = trim($price, "2rQ-NK\"");
      }
      if($sitename == "Overstock"){
        $price = trim($price, "dText\"Sale ");
      }
      $compPrice = $compPrice. $price. "</h2>". testLink($url, $linktags, $starttwo, 200, $startLink);
      $priceVals[$price. "|". $sitename] = $compPrice;
    }
    //Search Function end

    //Test Function Start
    function testLink($url, $linktags, $start, $end, $startlink){
      $html = curl($url);
      $link = "";
      while(true){
        if($html{strpos($html, $linktags) + $start} == "\""){
          break;
        }
        if(strpos($html, $linktags) !== false){
          $link .= $html{strpos($html, $linktags) + $start};
        }
        $start++;
      }
      $final = "http://". $startlink. $link;
      return "<a href = $final><button class = \"btn btn-info\">Link</button></a><hr>";
    }
    //Test Function End

    //Print Function Start
    function displayPrices(){
      global $priceVals;
      ksort($priceVals, SORT_NATURAL);
      foreach($priceVals as $key => $priceDisp){
        echo explode("|", $key)[0];
        echo $priceDisp;
      }
    }
    //Print Function End

    //Query formatting start
    $item = $_POST['item'];
    $orig_item = $item;
    $item = str_replace(" ", "+", $item);
    //Query formatting end

    //Query Disp Start
    echo "<br><h1>You Searched For: $orig_item</h1>";
    echo "<br><a href = 'index.html'><button class = 'btn btn-primary'>Back to Search</button></a><br><br><hr>";
    //Query Disp End

    //Display Options Start
    echo "<br>
      <div class = 'row'>
      <div class = 'col-md-4'>
        <h3>Currency Selection</h3>
        <div class='form-check'>
          <input class='form-check-input' type='radio' name='gridRadios' id='gridRadios1' value='option1' checked>
          <label class='form-check-label' for='gridRadios1'>
            Dollar
          </label>
        </div>
        <div class='form-check'>
          <input class='form-check-input' type='radio' name='gridRadios' id='gridRadios2' value='option2'>
          <label class='form-check-label' for='gridRadios2'>
            Euro
          </label>
        </div>
        <div class='form-check'>
          <input class='form-check-input' type='radio' name='gridRadios' id='gridRadios2' value='option2'>
          <label class='form-check-label' for='gridRadios2'>
            Rupee
          </label>
        </div>
        </div>
        <div class = 'col-md-4'>
          <h3>Search Options</h3>
          <div class='form-check'>
            <input class='form-check-input' type='checkbox' name='gridRadios' id='gridRadios2' value='option2'>
            <label class='form-check-label' for='gridRadios1'>
              Exact Search
            </label>
          </div>
          <div class='form-check'>
            <input class='form-check-input' type='checkbox' name='gridRadios' id='gridRadios2' value='option2'>
            <label class='form-check-label' for='gridRadios1'>
              Alphabetical Ordering
            </label>
          </div>
        </div>
        <div class = 'col-md-4'>
          <h3>Display Amount</h3>
        </div>
        </div>
    <hr>";
    //Display Options End

    //Amazon price pull start

    $url = 'https://www.amazon.com/s?k='. $item. '&ref=nb_sb_noss_2';
    scrapeSearch($url, "a-price-whole", 15, "Amazon", "multi-purpose", 30, "a-link-normal a-text-normal\" href=\"", 35, "amazon.com");

    //Amazon price pull end

    //Flipkart price pull start

    $url = "https://www.flipkart.com/search?q=$item&otracker=search&otracker1=search&marketplace=FLIPKART&as-show=on&as=off";
    scrapeSearch($url, "_1vC4OE", 9, "FlipKart", "India multi-purpose", 30, "noopener noreferrer\" href=\"", 27, "flipkart.com");

    //Flipkart price pull end

    //Ebay price pull start

    $url = "https://www.ebay.com/sch/i.html?_from=R40&_trksid=p2380057.m570.l1313.TR11.TRC2.A0.H1.X$item.TRS1&_nkw=$item&_sacat=0";
    scrapeSearch($url, "s-item__price", 15, "Ebay", "multi-purpose", 30, "s-item__link\" href=\"", 0, "ebay.com");

    //Ebay price pull end

    //Walmart price pull start

    $url = "https://www.walmart.com/search/?query=$item";
    scrapeSearch($url, "price-characteristic", 22, "Walmart", "retailer", 30, "line-clamp-2 truncate-title\" href=\"", 35, "walmart.com");

    //Walmart price pull end

    //Etsy price pull start

    $url = "https://www.etsy.com/search?q=$item";
    scrapeSearch($url, "currency-value", 16, "Etsy", "Home Decor", 30, "data-palette-listing-image", 61, "etsy.com");

    //Etsy price pull end

    //Overstock price pull start

    $url = "https://www.overstock.com/$item,/k,/results.html?SearchType=Header";
    scrapeSearch($url, "currentPrice ", 15, "Overstock", "Home Decor", 40, "productCardLink\" href=\"", 48, "overstock.com");

    //Overstock price pull end

    //Google Shopping Price Start

    $url = "https://www.google.com/search?psb=1&tbm=shop&q=$item";
    //scrapeSearch($url, "class=\"HRLxBb\"", 15, "Google Shopping", "General Purpose", 30);

    //Google Shopping Price End

    //Jet price pull start, jet was discontinued by walmart

    $url = "https://jet.com/search?term=$item";
    //scrapeSearch($url, "hIuNJJ\">", 7, "Jet", "General Purpose", 30);

    //Jet price pull end

    //Macys price pull start

    $url = "https://www.macys.com/shop/featured/$item";
    scrapeSearch($url, "\"priceLabel\"></span> ", 19, "Macys", "Clothes", 30, "a href=\"/shop/product", 8, "macys.com");

    //Macys price pull end

    //Alibaba price pull start

    $url = "https://www.alibaba.com/trade/search?fsb=y&IndexArea=product_en&CatId=&SearchText=$item";
    scrapeSearch($url, "price medium\" title=\"", 21, "Alibaba", "General", 32, "organic-gallery-title one-line", 78, "alibaba.com");

    //Alibaba price pull end

    //Target price pull start

    $url = "https://www.target.com/s?searchTerm=$item&category=0%7CAll%7Cmatchallpartial%7Call+categories&tref=typeahead%7Cterm%7C1%7Cface+mask%7C%7C%7Cdefault&searchRawTerm=";
    scrapeSearch($url, "product-price", 21, "Target", "General", 32, "a href=\"/p/", 10, "target.com");

    //Target price pull end

    //Show Results Start

    displayPrices();

    //Show Results End

  ?>
  </div>
    <!-- BootStrap JS Stuff Start -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- BootStrap JS Stuff End -->
  </body>
</html>
