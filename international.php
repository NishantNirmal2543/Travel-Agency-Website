<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacred tours and travels</title>

    <?php include_once('includes/links.php'); ?>

</head>

<body>

    <?php include_once('includes/navbar.php');
    include 'dbcon.php';

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $post_per_page = 6;
    $result = ($page - 1) * $post_per_page;
    ?>

    <?php include 'includes/whatsapp.php'; ?>

    <div class="title about-header" style="background-image: url(images/bg/internationalbg.webp);">
        <h1>International <span style="color:red">Tours</span></h1>
    </div>
    <div class="bookbutton">
        <?php include_once('includes/book.php'); ?>
    </div>

    <section class="dom">
        <div class="row dom1 g-5 ">
            <?php
            $postQuery = "SELECT * from intiternary ORDER BY id DESC LIMIT $result, $post_per_page";
            $runPQ = mysqli_query($con, $postQuery);
            while ($post = mysqli_fetch_assoc($runPQ)) {
            ?>

            <div class="col-lg-4 col-md-6 col-sm-12">
                <a href="international2.php?id=<?= $post['id'] ?>" style="text-decoration: none; color: black;">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <img src="images/internationaltour/<?= $post['image'] ?>" alt="1" class="card-img">
                            <div class="short-info">
                                <div class="tourname">
                                    <img src="images/logo/intlogo.png" alt="logo" class="intlogo">
                                    <?= $post['tour_title'] ?>
                                </div>
                                <div class="tourprice">

                                    <span style="font-size: 20px;  float: right;" class="price">
                                        <sup>₹</sup>
                                        <?= $post['amount'] ?>/
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
            <?php
            $q = "SELECT * from intiternary";
            $r = mysqli_query($con, $q);
            $total_posts = mysqli_num_rows($r);
            $total_pages = ceil($total_posts / $post_per_page);


            ?>

        </div>
        <section class="blogp">
            <nav aria-label="Page navigation ">
                <ul class="pagination">
                    <?php
                    if ($page > 1) {
                        $switch = "";
                    } else {
                        $switch = "disabled";
                    }

                    if ($page < $total_pages) {
                        $nswitch = "";
                    } else {
                        $nswitch = "disabled";
                    }
                    ?>
                    <li class="page-item <?= $switch ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php
                    for ($opage = 1; $opage <= $total_pages; $opage++) {
                    ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $opage ?>"><?= $opage ?></a></li>

                    <?php
                    }
                    ?>

                    <li class="page-item <?= $nswitch ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </section>


        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
                <a href="international2.php?id=1" style="text-decoration: none; color: black;">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <img src="images/dubai.webp" alt="1" class="card-img">
                            <div class="short-info">
                                <div class="tourname">
                                    Majestic Dubai-5D/4N
                                </div>
                                <div class="tourprice">

                                    <span style="font-size: 20px;  float: right;" class="price">
                                        <sup>₹</sup>
                                        39,490/
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content-home">
                        <div class="cardd">


                            <div class="name">
                                <strong>Highlights:</strong> Dhow Dinner Cruise, Dubai Aquarium, Burj Khalifa, Desert
                                Safari with BBQ Dinner and Tanoura Show

                            </div>

                        </div>


                        <div class="butn">
                            <button class="button" onclick="document.location='international2.php?id=1'">Know
                                More</button>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">

                <a href="international2.php?id=2" style="text-decoration: none; color: black;">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <img src="images/bali.webp" alt="1" class="card-img">
                            <div class="short-info">
                                <div class="tourname">
                                    Romantic Trip To Bali - 7D/6N
                                </div>
                                <div class="tourprice">

                                    <span style="font-size: 20px;  float: right;" class="price">
                                        <sup>₹</sup>
                                        48,490/
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content-home">
                        <div class="cardd">
                            <div class="name">
                                <strong>Highlights:</strong> Bali Swing, Tegenungan Waterfalls, Water Sports (Banana
                                Boat, Adventure / Couple Parasailing, Jet Ski), Uluwatu Temple tour with Kecak & Fire
                                Dance Show, Candle Light dinner
                            </div>
                        </div>


                        <div class="butn">
                            <button class="button" onclick="document.location='international2.php?id=2'">Know
                                More</button>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">
                <a href="international2.php?id=3" style="text-decoration: none; color: black;">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <img src="images/vietnam.webp" alt="1" class="card-img">
                            <div class="short-info">
                                <div class="tourname">
                                    Honeymoon in Vietnam - 5D/4N
                                </div>
                                <div class="tourprice">
                                    <span style="font-size: 20px;  float: right;" class="price">
                                        <sup>₹</sup>
                                        28,490/
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content-home">
                        <div class="cardd">
                            <div class="name">
                                <strong>Highlights:</strong> Hanoi Train street, Tran Quoc Pagoda, Lotte Tower, Sun
                                World, Bich Dong Pagoda, Hang Mua Viewpoint
                            </div>
                        </div>


                        <div class="butn">
                            <button class="button" onclick="document.location='international2.php?id=3'">Know
                                More</button>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">
                <a href="international2.php?id=4" style="text-decoration: none; color: black;">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <img src="images/thailand.webp" alt="1" class="card-img">
                            <div class="short-info">
                                <div class="tourname">
                                    Thailand Tour - 7D/6N
                                </div>
                                <div class="tourprice">

                                    <span style="font-size: 20px;  float: right;" class="price">
                                        <sup>₹</sup>
                                        55,490/
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content-home">
                        <div class="cardd">
                            <div class="name">
                                <strong>Highlights:</strong> Phi Phi Island, Indian lunch, Phuket, Alcazar Cabaret show,
                                Coral Island tour with water sports
                            </div>
                        </div>

                        <div class="butn">
                            <button class="button" onclick="document.location='international2.php?id=4'">Know
                                More</button>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">
                <a href="international2.php?id=5" style="text-decoration: none; color: black;">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <img src="images/singapore.webp" alt="1" class="card-img">
                            <div class="short-info">
                                <div class="tourname">
                                    Magnificent Singapore - 5D/4N
                                </div>
                                <div class="tourprice">

                                    <span style="font-size: 20px;  float: right;" class="price">
                                        <sup>₹</sup>
                                        45,490/
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content-home">
                        <div class="cardd">
                            <div class="name">
                                <strong>Highlights:</strong> Night safari at Singapore Zoo, Sentosa Island, Universal
                                Studios, Garden by the Bay With Marina Bay Sand.
                            </div>
                        </div>

                        <div class="butn">
                            <button class="button" onclick="document.location='international2.php?id=5'">Know
                                More</button>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">
                <a href="international2.php?id=6" style="text-decoration: none; color: black;">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <img src="images/maldives.webp" alt="1" class="card-img">
                            <div class="short-info">
                                <div class="tourname">
                                    Maldives Delight - 5D/4N
                                </div>
                                <div class="tourprice">
                                    <span style="font-size: 20px;  float: right;" class="price">
                                        <sup>₹</sup>
                                        55,490/
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content-home">
                        <div class="cardd">
                            <div class="name">
                                <strong>Highlights:</strong> Sundeck, Sand Bank, whale submarine, scuba diving
                            </div>
                        </div>

                        <div class="butn">
                            <button class="button" onclick="document.location='international2.php?id=6'">Know
                                More</button>
                        </div>
                    </div>
                </a>
            </div> -->
        </div>
    </section>


    <?php include_once('includes/footer.php'); ?>


</body>

</html>