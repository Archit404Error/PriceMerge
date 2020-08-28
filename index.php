<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=.5">

    <link rel="shortcut icon" href="favicon.png">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amiri&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="animate.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="wow.min.js"></script>
                  <script>
                  new WOW().init();
                  </script>
    <link rel = "stylesheet" type = "text/css" href = "style.css">
    <title>PriceMerge: compare prices across thousands of sites and save money!</title>
    <meta name="description" content="PriceMerge helps users save money on all products, including those that are in demand during the CoronaVirus Pandemic. 
    Not only do we compare prices across thousands of websites, we e-mail you when prices drop below the amount you've indicated you want to buy a product at, so you 
    never have to worry about missing out on deals!">
    <meta charset="UTF-8">
    <style>
      h1, h2, h3{
        color: white;
        font-family: 'Lato', sans-serif;
      }
      .outer {
        height: 100vh;
        display: flex;
      }
      .inner {
        margin: auto;
      }
      .landingGradient{
        background-image: linear-gradient(to bottom right, #FF4500, #FFBF00);
      }
      .landingTitle{
        color: white;
        font-family: 'Amiri', serif;
      }
      .bottom-align-text {
        position: absolute;
        bottom: 0;
        color: white;
      }
    </style>

    <script>
      $(document).ready(function() {
        $("#queryButton").click(function() {
          // add spinner to button
          $(this).html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
          );
        });
        $("#item").keypress(function() {
          // add spinner to button
          var keycode = (event.keyCode ? event.keyCode : event.which);
          if(keycode == '13'){
            $("#queryButton").html(
              `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
            );
          }
        });
      });
    </script>
  </head>
  <body>
    <?php
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
        } catch(PDOException $e){
            echo "Connection failed: ". $e -> getMessage();
        }
    ?>
        <nav class="navbar navbar-expand-lg navbar-light main-navigation">
            <a class="navbar-brand" href="index.php"><img style = "height: 5vh" src = "sitelogo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a style = "color: white;" class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a style = "color: white;" class="nav-link" href="productdisplay.php">Coronavirus Product Tracker</a>
                  </li>
                  <li class="nav-item">
                    <a style = "color: white;" class="nav-link" href="about.html">About Us</a>
                  </li>
                </ul>
            </div>
        </nav>

    <!-- Landing Start -->
    <div class="outer mw-100 container text-center landingGradient">
      <div class = "inner mw-100">
        <h1 class = "landingTitle animated wow fadeInUp display-1" style = "font-size: 10vh;"><b>Price<font color = "#004008">Merge</font></b></h1>
        <div class = "row d-flex justify-content-center">
          <h3 class = "col-md-6 col-sm-12" style = "font-size: 3vh">Save money while shopping online by tracking products across thousands of sites and recieve alerts when prices fall!</h3><br>
        </div>
        <div style = "height: 3vh;"></div>
        <div class = "row d-flex justify-content-center">
          <a href = "productdisplay.php"><button class = "btn btn-primary">Start Saving Money!</button></a>
          <div class = "bottom-align-text">
            <h5>Scroll down to learn more! Also, don't forget to send us your <a href = "https://forms.gle/uujFmj5fYchfrEKT8">feedback!</a></h5>
          </div>
        </div>
      </div>
    </div>
    <!-- Landing End -->
    
    <!-- How to Use Start -->
    <div class = "outer animated text-center mw-100" style = "background-color: #ff8c21;">
      <div class = "inner mw-100">
        <h2 class = "animated wow fadeInUp" style = "font-size: 8vh;">How Do I Use PriceMerge?</h2>
        <div style = "height: 2vh;"></div>
        <h9 class = "animated wow fadeInUp" style = "font-size: 3vh; color: white;"><i>There are two ways that you can currently use PriceMerge. The First is the built-in
        price comparison tool, which can compare the current price of a product across multiple websites and will show you how much the product costs on each given website.
        This tool is the one above, so all you have to do is type a product into the search bar and you're good to go! The other tool is the Coronavirus product tracker,
        built specifically around the Coronavirus. This tool displays the best price for important Coronavirus Personal Protective Equipment(PPE). You can also tell it
        to email you when the price drops below a certain price and you'll be emailed when the price falls with a link to buy the item!</i></h9>
      </div>
    </div>
    <!-- How to Use Start -->

    <!-- About Part 1 Start -->
    <div class = "outer animated text-center mw-100" style = "background-color: #ffbf00;">
      <div class = "inner mw-100">
        <h2 class = "animated wow fadeInUp" style = "font-size: 8vh;">Built for the <font color = "#004008">Pandemic</font></h2>
        <div style = "height: 2vh;"></div>
        <h9 class = "animated wow fadeInUp" style = "font-size: 3vh; color: white;"><i>Our site is built around the Coronavirus pandemic, and we want to give you the best deals on vital products as fast as possible.
        Our tools both serve to let you compare prices across multiple e-commerce sites and find the best, cheapest price for important products to keep you and your
        loved ones safe. Our site also has built in features to notify you via email when prices drop so that you always stay in the loop when prices drop and when products become
        cheaper and more affordable. We combat price gouging and price increases that larger ecommerce stores may conduct and prioritize your income and money, which is 
        especially important when the Coronavirus pandemic has left many unable to work.</i></h9>
      </div>
    </div>
    <!-- About Part 1 End -->

    <!-- About Part 2 Start -->
    <div class = "outer animated text-center mw-100" style = "background-color: #ff8c21;">
      <div class = "inner mw-100">
        <h2 class = "animated wow fadeInUp" style = "font-size: 8vh;">No Tracking, <font color = "#004008">Ever</font></h2>
        <div style = "height: 2vh;"></div>
        <h9 class = "animated wow fadeInUp" style = "font-size: 3vh; color: white;"><i>We are the only price comparison site that doesn't track and sell your data, letting you enjoy your privacy!
        Not only are we the only price comparison tool that emails you once an item's price drops, we also never sell your emails or shopping habits to any other company.
        You can use our website without having to worry about your data and vital information being tracked, as we understand that at these unprecedented times, it is far
        more important to help others through our site than track their data for money.</i></h9>
      </div>
    </div>
    <!-- About Part 2 End -->

    <!-- About Part 3 Start -->
    <div class = "outer animated text-center mw-100" style = "background-color: #ffbf00;">
      <div class = "inner mw-100">
        <h2 class = "animated wow fadeInUp" style = "font-size: 8vh;">Dedicated To Giving Back to <font color = "#004008">You</font></h2>
        <div style = "height: 2vh;"></div>
        <h9 class = "animated wow fadeInUp" style = "font-size: 3vh; color: white;"><i>Our services are completely free and we make no money; our only goal is to help people save
        during the Coronavirus Pandemic! We do not and will never charge you money to search for product, and we do not and will never show you any advertisements on the 
        website. Our only goal is helping you find good deals on important Coronavirus product and regular products while shopping online, and we do it all for free!</i></h9>
      </div>
    </div>
    <!-- About Part 3 End -->

    <!-- BootStrap JS Stuff Start -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- BootStrap JS Stuff End -->
  </body>
</html>
