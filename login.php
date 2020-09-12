<?php

$servername = "localhost";
$username = "id14829346_test";
$password = "7F$)6!J/TJ34=Yqa";
$database = "id14829346_logindb";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  if($_POST["loginuname"] && $_POST["loginpass"]){
    $loginuname = $_POST["loginuname"];
    $loginpass = $_POST["loginpass"];
    $sql = "SELECT pass FROM userinfo WHERE uname = '$loginuname' and pass LIKE '$loginpass'";
    $passcheck = $conn -> prepare($sql);
    $passcheck -> execute();
    $result = $passcheck -> fetch();
    if($result){
        $printer = "login valid";
        echo"login valid";
        setcookie('user', md5($loginuname), time() + (86400 * 1), "/");
    } else {
       $printer = "login invalid";
    }



  } else if ($_POST["signupuname"] && $_POST["signuppass"]){
    $signupuname = $_POST["signupuname"];
    $signuppass = $_POST["signuppass"];
    $sql = "SELECT uname FROM userinfo WHERE uname = '$signupuname'";
    $signupcheck = $conn -> prepare($sql);
    $signupcheck -> execute();
    $signupresult = $signupcheck -> fetch();
    if($signupresult){
      $printer = "user exists";
    } else {
      $conn -> exec("INSERT INTO userinfo (`uname`, `pass`) VALUES ('$signupuname', '$signuppass')");
      $printer = "sign up success";
    }

  }

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


?>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                  <li class="nav-item">
                    <a style = "color: white;" class="nav-link" href="login.html">Log In</a>
                  </li>
                </ul>
            </div>
        </nav>

</body>

</html>
