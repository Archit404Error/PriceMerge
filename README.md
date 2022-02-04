# PriceMerge

## What it does
This website was built during the initial outbreak of the COVID-19 Pandemic in order to enable price tracking and combat price gouging. Users of the site automatically get email notificaitons upon product prices falling below a specified range, and may also search for particular products to get price comparisons.

In essence, PriceMerge provides a price watclist functionality that ended up helping over 25,000 users save their time, effort, and money when PPE prices were extremely high and supply was limited.

## Running the site
The backend of the site is written primarily in PHP, and hence in order to run the website it is necessary to download either [MAMP](https://www.mamp.info/en/mac/) or [XAMPP](https://www.apachefriends.org/index.html).

Next, run `git clone https://github.com/Archit404Error/PriceMerge` in order to download all project files, and move them into the directory required by your PHP development environment.

Finally, begin running PHP locally via one of the two aforementioned tools, and then run `open index.php` in your command line -- everything should now be up and running!

## How it works
Techstack: PHP, MySQL, HTML/CSS/JS (Bootstrap)
In an effort to not track any of our users' data, we enable users to input their emails and preferred prices for products, and then run a `cron.php` with a cron job in order to continually check if the product is below the user's specified price. If it is, we send an email to the user and clear the tracking data from our Database as soon as the email is sent.

We also track a few "core products" for every user, namely vital PPE equipment, with the cheapest / best product for a particular type of PPE being continually updated

## Demo
You can check out the site at [pricemerge.com](http://pricemerge.com)
