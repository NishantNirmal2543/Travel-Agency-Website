<?php include 'includes/header.php'; ?>

<body>

    <?php include_once('includes/navbar.php'); ?>
    <?php include 'dbcon.php';
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $post_per_page = 6;
    $result = ($page - 1) * $post_per_page; ?>

    <section class="home">
        <div class="videos">
            <video autoplay muted loop id="myVideo">
                <source src="images/video/sacred.mp4" type="video/mp4">
            </video>

            <div class="content">
                <div class="homecontent" style="background: #00000047!important;">
                    <h2>Discover hidden wonders on trips curated by<br> Sacred India Tour & Travels</h2>
                    <h3>Holiday Packages/Hotels/Activities & Tours</h3>

                    <button onclick="document.location='about.php'">Know More</button>
                </div>
            </div>
        </div>

    </section>
    <div class="bookbutton">
        <?php include_once('includes/book.php'); ?>
        <?php include 'includes/whatsapp.php'; ?>
    </div>

    <?php
    $sql = "SELECT title FROM blog ORDER BY id DESC LIMIT 3";
    $results = mysqli_query($con, $sql);
    if (!$results) {
        die('Error fetching data: ' . mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($results);
    $latest_post_title = $row['title'];
    ?>


    <div class="ticker">
        <div class="bigheading">Latest Blogs</div>
        <div class="text-update">

            <p><?php echo $latest_post_title; ?></p>
        </div>
    </div>

    <!--Domestic Tours-->
    <section class="tours">
        <div class="title">
            <h3>Domestic <span>Tours</span></h3>
        </div>

        <div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                    <?php

                    $postQuery = "SELECT * from domiternary ORDER BY id DESC LIMIT $result, $post_per_page";
                    $runPQ = mysqli_query($con, $postQuery);
                    while ($post = mysqli_fetch_assoc($runPQ)) {
                    ?>
                    <div class="card tours-cards swiper-slide">
                        <div class="ribbon-wrap">
                            <div class="ribbon">POPULAR</div>
                        </div>
                        <a href="dom2.php?id=<?= $post['id'] ?>" style="text-decoration: none; color: black;">
                            <div class="image-content">
                                <span class="overlay"></span>
                                <div class="card-image">
                                    <img src="images/domestictour/<?= $post['image'] ?>" alt="1" class="card-img">
                                    <div class="short-info">
                                        <div class="tourname">

                                            <i class="fa-solid fa-gopuram"></i>
                                            <?= $post['tour_title'] ?>
                                        </div>
                                        <div class="tourprice">

                                            <span style="font-size: 20px;  float: right;" class="price">
                                                ₹ <?= $post['amount'] ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-content-home">
                                <div class="cardd">
                                    <div class="name">
                                        <strong>Highlights:</strong> <?= $post['highlights'] ?>
                                    </div>
                                </div>


                                <div class="butn">
                                    <button class="button"
                                        onclick="document.location='dom2.php?id=<?= $post['id'] ?>'">Know
                                        More</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
        </div>

        <div class="dt">
            <button class="button" onclick="document.location='dom1.php'">View Domestic Tours</button>
        </div>

    </section>

    <!-- popular activies and tours -->
    <section class="tours">
        <div class="title">
            <h3>Popular Activities & <span>Tours</span></h3>
        </div>

        <div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">

                    <?php
                    $postQuery = "SELECT * from activityiternary ORDER BY id DESC LIMIT $result, $post_per_page";
                    $runPQ = mysqli_query($con, $postQuery);
                    while ($post = mysqli_fetch_assoc($runPQ)) {
                    ?>

                    <div class="card swiper-slide">
                        <div class="ribbon-wrap">
                            <div class="ribbon">POPULAR</div>
                        </div>
                        <a href="activity.php?id=<?= $post['id'] ?>" style="text-decoration: none; color:black;">
                            <div class="image-content">
                                <span class="overlay"></span>
                                <div class="card-image">
                                    <img src="images/activity/<?= $post['image'] ?>" alt="1" class="card-img">
                                    <div class="short-info">
                                        <div class="tourname">

                                            <i class="fa-solid fa-person-walking"></i>
                                            <?= $post['activity_title'] ?>
                                        </div>
                                        <div class="tourprice">

                                            <span style="font-size: 20px;  float: right;" class="price">
                                                ₹ <?= $post['amount'] ?>/
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content-home">
                                <div class="cardd">


                                    <div class="name">
                                        <strong>Highlights:</strong>=<?= $post['highlights'] ?>

                                    </div>

                                </div>


                                <div class="butn">
                                    <button class="button"
                                        onclick="document.location='activity.php?id=<?= $post['id'] ?>'">Know
                                        More</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
        </div>

        <div class="dt">
            <button class="button">View All Activities & Tours
            </button>
        </div>

    </section>

    <!-- international tours -->
    <section class="tours">
        <div class="title">
            <h3>Trending International <span>Destination</span></h3>
        </div>

        <div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                    <?php

                    $postQuery = "SELECT * from intiternary ORDER BY id DESC LIMIT $result, $post_per_page";
                    $runPQ = mysqli_query($con, $postQuery);
                    while ($post = mysqli_fetch_assoc($runPQ)) {
                    ?>
                    <div class="card tours-cards swiper-slide">
                        <div class="ribbon-wrap">
                            <div class="ribbon">POPULAR</div>
                        </div>
                        <a href="international2.php?id=<?= $post['id'] ?>" style="text-decoration: none; color: black;">
                            <div class="image-content">
                                <span class="overlay"></span>
                                <div class="card-image">
                                    <img src="images/internationaltour/<?= $post['image'] ?>" alt="1" class="card-img">
                                    <div class="short-info">
                                        <div class="tourname">

                                            <i class="fa-solid fa-gopuram"></i>
                                            <?= $post['tour_title'] ?>
                                        </div>
                                        <div class="tourprice">

                                            <span style="font-size: 20px;  float: right;" class="price">
                                                ₹ <?= $post['amount'] ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-content-home">
                                <div class="cardd">
                                    <div class="name">
                                        <strong>Highlights:</strong> <?= $post['highlights'] ?>
                                    </div>
                                </div>


                                <div class="butn">
                                    <button class="button"
                                        onclick="document.location='international2.php?id=<?= $post['id'] ?>'">Know
                                        More</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
        </div>

        <div class="dt">
            <button class="button" onclick="document.location='international.php'">View International Tours</button>

        </div>

    </section>

    <!-- trending hotels -->
    <section class="tours">
        <div class="title">
            <h3>Trending <span>Hotels</span></h3>
        </div>

        <div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                    <?php
                    $postQuery = "SELECT DISTINCT * from hotel ORDER BY id DESC LIMIT $result, $post_per_page";
                    $runPQ = mysqli_query($con, $postQuery);
                    while ($post = mysqli_fetch_assoc($runPQ)) {
                    ?>

                    <div class="card swiper-slide">
                        <div class="ribbon-wrap">
                            <div class="ribbon">POPULAR</div>
                        </div>
                        <a href="varanasihotel.php?id=<?= $post['id'] ?>" style="text-decoration: none; color: black;">
                            <div class="image-content">
                                <span class="overlay"></span>
                                <div class="card-image">
                                    <img src="images/hotel/<?= $post['main_image'] ?>" alt="1" class="card-img">
                                    <div class="short-info">
                                        <div class="tourname">
                                            <?= $post['hotel_place'] ?>
                                        </div>
                                        <div class="tourprice">
                                            <span style="font-size: 20px;  float: right;" class="price">
                                                ₹ <?= $post['price'] ?>/Day
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content-home">
                                <div class="cardd">
                                    <div class="name">
                                        <strong>Highlights:</strong><?= $post['highlights'] ?>
                                    </div>
                                </div>


                                <div class="butn">
                                    <button class="button"
                                        onclick="document.location='varanasihotel.phpid=<?= $post['id'] ?>'">Know
                                        More</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
        </div>

        <div class="dt">
            <button class="button" onclick="document.location='hotels.php'">See More Hotels</button>
        </div>

    </section>

    <!-- car rental -->
    <section class="tours">
        <div class="title">
            <h3>Cab/Car <span>Rental</span></h3>
        </div>

        <div class="slide-container swiper">
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                    <?php
                    $postQuery = "SELECT * from vehicle_details ORDER BY id DESC";
                    $runPQ = mysqli_query($con, $postQuery);
                    while ($post = mysqli_fetch_assoc($runPQ)) {
                    ?>
                    <div class="card swiper-slide">
                        <div class="ribbon-wrap">
                            <div class="ribbon">POPULAR</div>
                        </div>
                        <a href="carrental.php" style="text-decoration: none; color: black;">
                            <div class="image-content">
                                <span class="overlay"></span>
                                <div class="card-image">
                                    <img src="images/vehicle/<?= $post['image'] ?>" alt="1" class="card-img">
                                    <div class="short-info">
                                        <div class="tourname">
                                            <?= $post['vehicle_category'] ?>
                                        </div>
                                        <div class="tourprice">
                                            <span style="font-size: 20px;  float: right;" class="price">
                                                <sup>₹</sup>
                                                <?= $post['price'] ?> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content-home">
                                <div class="cardd">
                                    <div class="name">
                                        <strong>Cars:</strong><?= $post['vehicle_name'] ?>
                                    </div>
                                </div>
                                <div class="butn">
                                    <button class="button" onclick="document.location='carrental.php'">
                                        Know More
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
        </div>

        <div class="dt">
            <button class="button" onclick="document.location='carrental.php'">Know More</button>
        </div>

    </section>

    <!-- why us section -->
    <section class="whyus">
        <div class="tit">
            <h3>Why <span>Us?</span></h3>
        </div>
        <div class="why-us row">

            <div class="box col-lg-4 col-md-6 col-sm-12">
                <div class="why">
                    <img src="images/logo/w1.png" class="why-img">
                    <h3>Accomodation</h3>
                    <p>Comfortable & convenient hotels cherry picked by our hotel management team </p>
                </div>
            </div>
            <div class="box col-lg-4 col-md-6 col-sm-12">
                <div class="why">
                    <img src="images/logo/w2.png" class="why-img">
                    <h3>All meals</h3>
                    <p>Eat to your heart's content Breakfast. Lunch. Dinner.
                    </p>
                </div>
            </div>
            <div class="box col-lg-4 col-md-6 col-sm-12">
                <div class="why">
                    <img src="images/logo/w3.png" class="why-img">
                    <h3>On-tour transport</h3>
                    <p>Our itineraries include all rail, sea and road transport as part of the itinerary so you can
                        enjoy tension free</p>
                </div>
            </div>
            <div class="box col-lg-4 col-md-6 col-sm-12">
                <div class="why">
                    <img src="images/logo/w4.png" class="why-img">
                    <h3>Tour managers</h3>
                    <p>We have an exclusive team of 350 tour managers specialising in India and World tours</p>
                </div>
            </div>
            <div class="box col-lg-4 col-md-6 col-sm-12">
                <div class="why">
                    <img src="images/logo/w5.png" class="why-img">
                    <h3>Best value itinerary</h3>
                    <p>Our dedicated product & destination research team spends hours curating the best value for money
                        itineraries</p>
                </div>
            </div>
            <div class="box col-lg-4 col-md-6 col-sm-12">
                <div class="why">
                    <img src="images/logo/w6.png" class="why-img">
                    <h3>To and fro airfare</h3>
                    <p>Sacred India tours and travels are inclusive of airfare from many hubs within India unless you
                        pick the joining-leaving option</p>
                </div>
            </div>
        </div>
    </section>

    <!-- reviews -->
    <?php include_once("includes/review.php"); ?>

    <!--effect cards-->
    <section class="effect-card ">
        <div class="row ecw  g-5">

            <div class="col-lg-5 col-sm-12">
                <div class="swipers mySwipers">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide sl"><img src="images/internationaltour/bali.webp" class="ec"></div>
                        <div class="swiper-slide sl"><img src="images/domestictour/d1.webp" class="ec"></div>
                        <div class="swiper-slide sl"><img src="images/internationaltourdubai.webp" class="ec"></div>
                        <div class="swiper-slide sl"><img src="images/domestictour/ganga.webp" class="ec"></div>
                        <div class="swiper-slide sl"><img src="images/domestictour/kedarnath.webp" class="ec"></div>
                        <div class="swiper-slide sl"><img src="images/internationaltour/maldives.webp" class="ec"></div>
                        <div class="swiper-slide sl"><img src="images/internationaltour/singapore.webp" class="ec">
                        </div>
                        <div class="swiper-slide sl"><img src="images/domestictour/kashi.webp" class="ec"></div>
                        <div class="swiper-slide sl"><img src="images/activity/rafting.webp" class="ec"></div>
                    </div>
                    <div class="swiper-button-next swiper-navBtn"></div>
                    <div class="swiper-button-prev swiper-navBtn"></div>
                </div>
            </div>

            <div class="col-lg-7 col-mb-12">
                <div class="effect-content">
                    <h3>The world is waiting to be known, waiting to be experienced!</h3>
                    <p>Our exclusive customized holidays division can cater to every travel need: hotel, air tickets,
                        VISA, sightseeings, transfer or the entire package, all designed keeping in mind your interests!
                    </p>
                    <p><strong>Want to customize your holiday?</strong></p>
                    <p class="enquire addr"><i class="fa-solid fa-phone" style="color:blue; font-size:22px;"></i><a
                            href="tel:+91 9507505612" style="text-decoration: none;"> +91 9507505612</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!--- Footer Section -->
    <section>
        <?php include_once('includes/footer.php'); ?>
    </section>

</body>

</html>