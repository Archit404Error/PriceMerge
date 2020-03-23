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

    echo "<br><a href = 'index.html'><button class = 'btn btn-primary'>Return to Home</button></a><br><br><br>";

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
    function scrapeSearch($url, $toFind, $i, $sitename, $category){
      $html = curl($url);
      echo "<h1>". $sitename. "<br></h1><h5><span class='badge badge-secondary'>$category</span></h5><h2>";
      $price = "";
      while($i < 30){
        $curr = $html{strpos($html, $toFind) + $i};
        if($curr == "<"){
          break;
        }
        $price = $price. $curr;
        $i++;
      }
      if(strpos($price, '$') === false and strpos($price, '₹') === false){
        $price = '$'. $price;
      }
      echo $price. "</h2><a href = $url><button class = 'btn btn-info'> here </button></a><hr>";
    }
    //Search Function end

    //Query formatitng start
    $item = $_POST['item'];
    $item = str_replace(" ", "+", $item);
    //Query formatting end

    //Amazon price pull start

    $url = 'https://www.amazon.com/s?k='. $item. '&ref=nb_sb_noss_2';
    scrapeSearch($url, "a-price-whole", 15, "Amazon", "multi-purpose");

    //Amazon price pull end

    //Flipkart price pull start

    $url = "https://www.flipkart.com/search?q=$item&otracker=search&otracker1=search&marketplace=FLIPKART&as-show=on&as=off";
    scrapeSearch($url, "_1vC4OE", 9, "FlipKart", "India multi-purpose");

    //Flipkart price pull end

    //Ebay price pull start

    $url = "https://www.ebay.com/sch/i.html?_from=R40&_trksid=p2380057.m570.l1313.TR11.TRC2.A0.H1.X$item.TRS1&_nkw=$item&_sacat=0";
    scrapeSearch($url, "s-item__price", 15, "Ebay", "multi-purpose");

    //Ebay price pull end

    //Walmart price pull start

    $url = "https://www.walmart.com/search/?query=$item";
    scrapeSearch($url, "price-characteristic", 22, "Walmart", "retailer");

    //Walmart price pull end

    //Etsy price pull start

    $url = "https://www.etsy.com/search?q=$item";
    scrapeSearch($url, "currency-value", 16, "Etsy", "Home Decor");

    //Etsy price pull end

    //Overstock price pull start

    $url = "https://www.overstock.com/$item,/k,/results.html?SearchType=Header";
    scrapeSearch($url, "currentPrice ", 15, "Overstock", "Home Decor");

    //Overstock price pull end

  ?>
  </div>
    <!-- BootStrap JS Stuff Start -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- BootStrap JS Stuff End -->
  </body>
</html>
