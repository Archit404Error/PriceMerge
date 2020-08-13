<?php
    $email = $_POST['email'];
    $price = $_POST['price'];
    $id = intval($_POST['hiddenVal']);
    $servername = "localhost";
    $username = "id13018007_admin";
    $password = "Pricemerge123!";
    $database = "id13018007_products";
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
            echo 'we will contact you once the price drops!';
        } else {
            echo "We are already tracking this product for the email $email";
        }
    } catch(PDOException $e) {
        echo "Failed: ". $e->getMessage();
    }
?>
