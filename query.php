<html>
  <?php
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
    $item = $_POST['item'];
    $item = str_replace(" ", "+", $item);
    $url = 'https://www.amazon.com/s?k='. $item. '&ref=nb_sb_noss_2';
    $html = curl($url);
    $toFind = "a-price-whole";
    $i = 15;
    echo "Amazon Price: $";
    while($i < 20){
      $curr = $html{strpos($html, $toFind) + $i};
      if($curr == "<"){
        break;
      }
      echo $curr;
      $i++;
    }
    echo "<a href = $url> here </a><br>";
    $url = "https://www.flipkart.com/search?q=$item&otracker=search&otracker1=search&marketplace=FLIPKART&as-show=on&as=off";
    $html = curl($url);
    $toFind = "_1vC4OE";
    $i = 1;
    $toPrint = False;
    echo "Flipkart Price: ";
    while($i < 30){
      $curr = $html{strpos($html, $toFind) + $i};
      if($curr == "<"){
        break;
      }
      if($toPrint){
        echo $curr;
      }
      if($curr == ">"){
        $toPrint = True;
      }
      $i++;
    }
    echo "<a href = $url> here </a><br>";
    $url = "https://www.ebay.com/sch/i.html?_from=R40&_trksid=p2380057.m570.l1313.TR11.TRC2.A0.H1.X$item.TRS1&_nkw=$item&_sacat=0";
    $html = curl($url);
    $toFind = "s-item__price";
    $i = 15;
    echo "Ebay Price: ";
    while($i < 30){
      $curr = $html{strpos($html, $toFind) + $i};
      if($curr == "<" or $curr == "."){
        break;
      }
      echo $curr;
      $i++;
    }
    echo "<a href = $url> here </a><br>";
  ?>
</html>
