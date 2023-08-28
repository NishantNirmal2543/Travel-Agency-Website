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
    $result = ($page - 1) * $post_per_page; ?>
    <?php include 'includes/whatsapp.php'; ?>
    <section class="about-header" style="background-image: url(images/bg/banner.jpg);">
        <div class="auto-container">
            <div class="content-box">
                <h1>Holiday<span style="color:red">Packages</span></h1>
            </div>
        </div>
    </section>


    <section class="dom">
        <div class="title col-sm-12">
            <h3>Domestic<span style="color:red">Tours</span></h3>
        </div>
        <div class="row dom1 g-5 ">
            <?php
            $postQuery = "SELECT * from domiternary ORDER BY id DESC LIMIT $result, $post_per_page";
            $runPQ = mysqli_query($con, $postQuery);
            while ($post = mysqli_fetch_assoc($runPQ)) {
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
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
                            <button class="button" onclick="document.location='dom2.php?id=<?= $post['id'] ?>'">Know
                                More</button>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            }
            ?>
        </div>
        <?php
        $q = "SELECT * from domiternary";
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
    </section>

    <section class="dom">
        <div class="title col-sm-12">
            <h3>International<span style="color:red">Tours</span></h3>
        </div>
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
    </section>

    <?php include_once('includes/footer.php'); ?>


</body>

</html>