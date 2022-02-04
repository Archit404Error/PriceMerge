<?php
    $email = $_POST['email'];
    $price = $_POST['price'];
    $id = intval($_POST['hiddenVal']);
    $servername = "localhost";
    $username = "pricemerger";
    $password = "Pricemerge123!";
    $database = "Popularpricemerge";
    $time = time();
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM `Notifications` WHERE `id`=$id AND `email`='$email';";
        $result = $conn -> query($sql);
        if($result -> rowCount() == 0){
            $toExec = "INSERT INTO `Notifications` (`email`, `priceVal`, `id`, `time`, `emailed`) VALUES ('$email', '$price', '$id', '$time', 'false');";
            $conn -> exec($toExec);
            echo '<div class = "container"><center><h1 style = "color: black">Thanks for using PriceMerge! We will contact you once the price drops!</h1></center></div>';
        } else {
            echo "<div class = 'container'><center><h1 style = 'color: black'>We are already tracking this product for the email $email</h1></center></div>";
        }
    } catch(PDOException $e) {
        echo "Failed: ". $e->getMessage();
    }
?>
