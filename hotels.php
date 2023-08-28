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
    <section class="about-header" style="background-image: url(images/bg/banner.jpg);">
        <div class="auto-container">
            <div class="content-box">
                <h1>Trending<span style="color:red">Hotels</span></h1>
            </div>
        </div>
    </section>

    <section class="dom">


        <div class="row dom1 g-5 hotels">
            <?php
            $postQuery = "SELECT * from hotel ORDER BY id DESC LIMIT $result, $post_per_page";
            $runPQ = mysqli_query($con, $postQuery);
            while ($post = mysqli_fetch_assoc($runPQ)) {
            ?>

            <div class="col-lg-4 col-md-6 col-sm-12">

                <div class="card tour-cards">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <a href="hotels2.php?id=<?= $post['id'] ?>"><img
                                    src="images/hotel/<?= $post['main_image'] ?>" alt="1" class="card-img"></a>
                            <div class="short-info">
                                <div class="tourname">
                                    Hotels in <?= $post['hotel_place'] ?>
                                </div>
                                <div class="tourprice">
                                    <span style="font-size: 20px;  float: right;" class="price">
                                        ₹<?= $post['price'] ?>/Day
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="cardd">
                            <div class="name">
                                <strong>Highlights:</strong> <?= $post['highlights'] ?>
                            </div>
                            <div class="butn">
                                <button class="button" value="<?= $post['hotel_place'] ?>"
                                    onclick="document.location='hotels2.php?id=<?= $post['id'] ?>'">Know
                                    More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>

            <!-- <div class="col-lg-4 col-md-6 col-sm-12">

                <div class="card tour-cards">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <a href="varanasihotel.php"><img src="images/varanasihotel.webp" alt="1" class="card-img"></a>
                            <div class="short-info">
                                <div class="tourname">
                                    Hotels in Varanasi
                                </div>
                                <div class="tourprice">
                                    <span style="font-size: 20px;  float: right;" class="price">
                                        ₹1000/Day
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="cardd">
                            <div class="name">
                                <strong>Highlights:</strong> Surya Kaiser Palace, Heritage Divine, SITA, Amaya, Rivera
                                Palace
                            </div>
                            <div class="butn">
                                <button class="button" onclick="document.location='varanasihotel.php'">Know
                                    More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">

                <div class="card tourss-cards ">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <a href="ayodhyahotel.php"><img src="images/ayodhyahotel.webp" alt="1" class="card-img"></a>
                            <div class="short-info">
                                <div class="tourname">
                                    Hotels in Ayodhya
                                </div>
                                <div class="tourprice">
                                    <span style="font-size: 25px;  float: right;" class="price">
                                        ₹1300/Day
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="cardd">

                            <div class="name">
                                <strong>Highlights:</strong> Tirupati, Siyaram, The Ramayana, AP Palace
                            </div>
                            <div class="butn">
                                <button class="button" onclick="document.location='ayodhyahotel.php'">Know More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">

                <div class="card tourss-cards ">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <a href="gayahotel.php"><img src="images/bodhgayahotel.webp" alt="1" class="card-img"></a>
                            <div class="short-info">
                                <div class="tourname">
                                    Hotels in Gaya
                                </div>
                                <div class="tourprice">
                                    <span style="font-size: 20px;  float: right;" class="price">
                                        ₹1000/Day
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="cardd">

                            <div class="name">
                                <strong>Highlights:</strong> Bodhgaya Regency, Namastay, Sukhdeo Clarks Inn, Orchid
                            </div>
                            <div class="butn">
                                <button class="button" onclick="document.location='gayahotel.php'">Know More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">

                <div class="card tourss-cards">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <a href="mathurahotel.php"><img src="images/mathurahotel.webp" alt="1" class="card-img"></a>
                            <div class="short-info">
                                <div class="tourname">
                                    Hotels in Mathura
                                </div>
                                <div class="tourprice">

                                    <span style="font-size: 20px;  float: right;" class="price">
                                        ₹1300/Day

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="cardd">
                            <div class="name">
                                <strong>Highlights:</strong> Brijwasi Royal, Madhuvan, Sheetal Regency
                            </div>
                            <div class="butn">
                                <button class="button" onclick="document.location='mathurahotel.php'">Know More</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">

                <div class="card tourss-cards">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <a href="haridwarhotel.php"><img src="images/gangaexotica.webp" alt="1" class="card-img"></a>
                            <div class="short-info">
                                <div class="tourname">

                                    Hotels in Haridwar
                                </div>
                                <div class="tourprice">

                                    <span style="font-size: 20px;  float: right;" class="price">
                                        ₹1300/Day

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="cardd">
                            <div class="name">
                                <strong>Highlights:</strong> Ganga Exotica, Godwin, Trimurti, Trishul, Le Grand
                            </div>
                            <div class="butn">
                                <button class="button" onclick="document.location='haridwarhotel.php'">Know
                                    More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">

                <div class="card tourss-cards">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <a href="rishikeshhotel.php"><img src="images/rishikeshhotel.webp" alt="1" class="card-img"></a>
                            <div class="short-info">
                                <div class="tourname">

                                    Hotels in Rishikesh
                                </div>
                                <div class="tourprice">

                                    <span style="font-size: 20px;  float: right;" class="price">
                                        ₹1500/Day

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="cardd">
                            <div class="name">
                                <strong>Highlights:</strong> Grand Alova, Treepie Resort, Him River Resort, Pool Chhati
                                Resort
                            </div>
                            <div class="butn">
                                <button class="button" onclick="document.location='rishikeshhotel.php'">Know
                                    More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

    </section>

    <?php include_once('includes/footer.php'); ?>
</body>

</html>