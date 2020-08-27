<?php
    require_once 'simple_html_dom.php';
    function scrapeSite($siteURL, $listingClass, $listingOffset, $priceClass, $priceOffset, $linkClass, $linkOffset, $id){
        $dom = file_get_html($siteURL, false);
        if(!empty($dom)){
            $listing = ($dom -> find($listingClass))[$listingOffset];
            $price = ($listing -> find($priceClass))[$priceOffset];
            $realPrice = str_replace("<div class=\"dD8iuc\"><span class=\"HRLxBb\">", "", explode("from", $price)[0]);
            $realPrice = str_replace("</span>", "", $realPrice);
            $siteName = str_replace("</div>", "", explode("from", $price)[1]);
            $link = ($listing -> find($linkClass))[$linkOffset];
            $link = $link -> find('a')[0];
            if(strpos($link -> href, "http://") > 0 or strpos($link -> href, "https://") > 0){
                echo "ADDED:". $link -> href;
                $url = "http://google.com". $link -> href;
            }
            else
                $url = $link -> href;
            $title =  $link -> plaintext;
            echo "$realPrice<br>$url<br>$title<br>$siteName";
            $currTime = time();
            $servername = "localhost";
            $username = "pricemerger";
            $password = "Pricemerge123!";
            $database = "Popularpricemerge";
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM `Popular` WHERE `id`=$id;";
                $result = $conn -> query($sql);
                if($result -> rowCount() == 1){
                    $toExec = "UPDATE `Popular` SET `id`='$id',`Name`='$title',`Price`='$realPrice',`Site`='$siteName',`URL`='$url',`time`='$currTime' WHERE `id`='$id';";
                    if(strpos($realPrice, "shipping") === false){
                        $conn -> exec($toExec);
                    } else {
                        echo "\n\n\nSHIPPP\n\n\n";
                    }
                    $notify = "SELECT * FROM `Notifications` WHERE `id`=$id";
                    $query = $conn -> query($notify);
                    if($query -> rowCount() >= 1){
                        while($row = $query -> fetch()){
                            $priceWanted = $row['priceVal'];
                            $priceWanted = str_replace('$', '', $priceWanted);
                            $priceWanted = str_replace(',', '', $priceWanted);
                            $priceWanted = intval($priceWanted);
                            $realPrice = str_replace('$', '', $realPrice);
                            $realPrice = str_replace(',', '', $realPrice);
                            $realPrice = intval($realPrice);
                            if($priceWanted > $realPrice){
                                $mail = mail($row['email'], "Subject: Your product's price went down!", "Hello!\n\nThis email is being sent to you because you wanted to be notified when id $id went below". $row['priceVal']. " the price is now $realPrice dollars, so but at: $url!");
                                $toRun = "UPDATE `Notifications` SET `email`='". $row['email']. "',`priceVal`='". $row['priceVal']. "',`id`='". $row['id']. "',`time`='". $row['time']. "',`emailed`='true' WHERE `email`='". $row['email']. "' AND `id` ='". $row['id']. "';";
                                $conn -> exec($toRun);
                            }
                        }
                    }
                    $delRemain = "DELETE FROM `Notifications` WHERE `emailed`='true';";
                    $conn -> exec($delRemain);
                } else {
                    $toExec = "INSERT INTO `Popular` (`id`, `Name`, `Price`, `Site`, `URL`, `time`) VALUES ('$id', '$title', '$realPrice', '$siteName', '$url', '$currTime');";
                    $conn -> exec($toExec);
                }
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        } else {
            echo "scrape fail";
        }
    }
    scrapeSite("https://www.google.com/search?psb=1&tbm=shop&q=tissues&ved=0CAQQr4sDKAJqFwoTCLbFn-2Eg-sCFUQKZQodElsJZRAC", '.P8xhZc', 0, '.dD8iuc', 1, '.rgHvZc', 0, 0);
    scrapeSite("https://www.google.com/search?psb=1&tbm=shop&q=face+mask&ved=0CAQQr4sDKAJqFwoTCLbFn-2Eg-sCFUQKZQodElsJZRAC", '.P8xhZc', 0, '.dD8iuc', 1, '.rgHvZc', 0, 1);
    scrapeSite("https://www.google.com/search?psb=1&tbm=shop&q=hand+sanitizer&ved=0CAQQr4sDKAJqFwoTCLbFn-2Eg-sCFUQKZQodElsJZRAC", '.P8xhZc', 0, '.dD8iuc', 1, '.rgHvZc', 0, 2);
    scrapeSite("https://www.google.com/search?psb=1&tbm=shop&q=toilet+paper&ved=0CAQQr4sDKAJqFwoTCLbFn-2Eg-sCFUQKZQodElsJZRAC", '.P8xhZc', 0, '.dD8iuc', 1, '.rgHvZc', 0, 3);
    scrapeSite("https://www.google.com/search?psb=1&tbm=shop&q=soap&ved=0CAQQr4sDKAJqFwoTCLbFn-2Eg-sCFUQKZQodElsJZRAC", '.P8xhZc', 0, '.dD8iuc', 1, '.rgHvZc', 0, 4);
?>
