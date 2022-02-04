<html>
    <head>
        
        <meta name="viewport" content="width=device-width, initial-scale=.5">
    
        <link rel="shortcut icon" href="favicon.png">
    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Amiri&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="animate.css">
    
        <script src="wow.min.js"></script>
        <script>
            new WOW().init();
        </script>
        
        <link type = "text/css" rel = "stylesheet" href = "style.css">
        
        <title>PriceMerge Product Search</title>
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
                    <a style = "color: white;" class="nav-link" href="itemsearch.php">Compare Prices<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a style = "color: white;" class="nav-link" href="productdisplay.php">Product Watchlist</a>
                  </li>
                  <li class="nav-item">
                    <a style = "color: white;" class="nav-link" href="about.html">About Us</a>
                  </li>
                </ul>
            </div>
        </nav>
        <div style = "height: 38vh"></div>
        <div class = "row text-center justify-content-center">
            <h1 class = "col-md-12 animated wow fadeInUp">Item Price Comparison</h1>
            <h3 class = "col-md-6 animated wow fadeInUp" style = "color: #450600;">Search for the specific prices of products today across thousands of e-commerce websites! If you want, you can also add products to your product tracker, where they will continually be updated and you can be notified of price drops!</h3>
        </div>
        <div style = "height: 2vh"></div>
        <div class = "row">
            <div class = "col-md-3"></div>
            <form class = "col-md-6 animated wow fadeInUp" data-wow-delay = "200ms" method = "POST" action = "productpull.php">
                <div class = "input-group">
                    <input name = "userProd" required style = "width: 100%;" type = "text" class = "form-control" placeholder = "Search for a product to find the best price across thousands of sites(hit enter to search)">
                </div>
            </form>
            </div class = "col-md-2"></div>
        </div>
        <!-- BootStrap JS Stuff Start -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- BootStrap JS Stuff End -->
    </body>
</html>