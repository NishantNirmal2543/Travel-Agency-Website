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

    <?php include_once('includes/navbar.php'); ?>
    <?php include 'includes/whatsapp.php'; ?>

    <section class="about-header" style="background-image: url(images/bg/banner.jpg);">
        <div class="auto-container">
            <div class="content-box">
                <h1>Our<span style="color:red">Services</span></h1>
            </div>
        </div>
    </section>
    <div class="bookbutton">
        <?php include_once('includes/book.php'); ?>
    </div>

    <section class="dom">

        <div class="row dom1 g-5 ourservices ">

            <div class="col-lg-4 col-md-6 col-sm-12">

                <div class="card tour-cards">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <a href="holidaypackages.php"><img src="images/others/d2.webp" alt="1" class="card-img"></a>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="cardd">

                            <div class="name">
                                Holiday Packages
                            </div>
                            <div class="butn">
                                <button class="button" onclick="document.location='holidaypackages.php'">Know More</button>
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
                            <a href="hotels.php"><img src="images/others/hotel.jpg" alt="1" class="card-img"></a>

                        </div>
                    </div>
                    <div class="card-content">
                        <div class="cardd">

                            <div class="name">
                                Hotels
                            </div>
                            <div class="butn">
                                <button class="button" onclick="document.location='hotels.php'">Know More</button>
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
                            <a href="carrental.php"><img src="images/others/c2.webp" alt="1" class="card-img"></a>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="cardd">

                            <div class="name">
                                Car Rental
                            </div>
                            <div class="butn">
                                <button class="button" onclick="document.location='carrental.php'">Know More</button>
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
                            <a href="activities&tours.php"><img src="images/others/activity.jpg" alt="1" class="card-img"></a>

                        </div>
                    </div>
                    <div class="card-content">
                        <div class="cardd">

                            <div class="name">
                                Activities & Tours
                            </div>
                            <div class="butn">
                                <button class="button" onclick="document.location='activities&tours.php'">Know More</button>
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
                            <a href="flights.php"><img src="images/others/flight.jpg" alt="1" class="card-img"></a>

                        </div>
                    </div>
                    <div class="card-content">
                        <div class="cardd">

                            <div class="name">
                                Flights
                            </div>
                            <div class="butn">
                                <button class="button" onclick="document.location='flights.php'">Know More</button>
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
                            <a href="trains.php"><img src="images/others/train.jpg" alt="1" class="card-img"></a>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="cardd">
                            <div class="name">
                                Trains
                            </div>
                            <div class="butn">
                                <button class="button" onclick="document.location='trains.php'">Know More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include_once('includes/footer.php'); ?>


</body>

</html>