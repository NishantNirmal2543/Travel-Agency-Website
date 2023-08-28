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
    ?>
    <?php include 'includes/whatsapp.php'; ?>

    <section class="about-header" style="background-image: url(images/banner.jpg);">
        <div class="auto-container">
            <div class="content-box">
                <h3>About<span style="color:red">Hotels</span></h3>
            </div>
        </div>
    </section>

    <div class="about-hotels">
        <div class="hotel-desc abouthotel row">
            <div class="col-lg-4 col-sm-12">
                <div class="hotel-details">
                    <div class="hotel-name">
                        <h4>ROOMS & SUITES</h4>
                    </div>
                    <div class="hotel-description">
                        <p>Experience the full charms of Cyprus as you relax in your room complete with balcony offering breathtaking views of the sea or the hotel's pool. You'll be charmed by the décor here in a Mediterranean-inspired palette of blues.</p>
                    </div>
                </div>
            </div>

            <div class="hotel-image col-lg-8 col-sm-12">
                <img src="images/room.webp">
            </div>
        </div>

        <div class="hotel-desc abouthotel row">
          
            <div class="col-lg-4 col-sm-12">
                <div class="hotel-details">
                    <div class="hotel-name">
                        <h4>RESTAURANTS & BARS</h4>
                    </div>
                    <div class="hotel-description">
                        <p>Enjoy exceptional cuisine and tuck into dishes that are as creative as they are delectable. The hotel boasts four restaurants and three bars, giving you all the choice you need to tickle your taste-buds thanks to a wide range of local and international dishes served in a refined atmosphere. And don't forget to savour a cocktail by the water’s edge at the pool bar.</p>
                    </div>
                </div>
            </div>
            <div class="hotel-image col-lg-8 col-sm-12">
                <img src="images/bar.webp">
            </div>


        </div>

        <div class="hotel-desc abouthotel row">
            <div class="col-lg-4 col-sm-12">
                <div class="hotel-details">
                    <div class="hotel-name">
                        <h4>ACTIVITIES</h4>
                    </div>
                    <div class="hotel-description">
                        <p>A tennis court, spa and gym: make the most of your holiday at the Golden Bay Beach Hotel to get back into shape. Treat yourself to some well-deserved rest and sign the children up for the kid’s club. </p>
                    </div>
                </div>
            </div>

            <div class="hotel-image col-lg-8 col-sm-12">
                <img src="images/activity.webp">
            </div>
        </div>
    </div>









    <?php include_once('includes/footer.php'); ?>
</body>

</html>