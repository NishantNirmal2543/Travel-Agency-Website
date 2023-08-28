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
    $category = $_GET['category'];

    ?>
    <?php include 'includes/whatsapp.php';

    ?>
    <div class="title about-header" style="background-image: url(images/bg/varanasibg.webp);">
        <h1 style="text-transform: capitalize;"><?= $category ?><span style="color:red">Tours</span></h1>
    </div>

    <div class="bookbutton">
        <?php include_once('includes/book.php'); ?>
    </div>

    <section class="dom">
        <div class="row dom1 g-5 ">
            <?php
            $category = $_GET['category'];
            $postQuery = "SELECT * FROM domiternary WHERE holidayctg='$category'";
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

    </section>

    <?php include_once('includes/footer.php'); ?>


</body>

</html>