<?php

session_start();

if (!isset($_SESSION['email'])) {
    header('location:login.php');
}
?>
<?php include 'includes/header.php'; ?>

<body>

    <?php include 'includes/navbar.php'; ?>

    <div id="main" class="main p-5">
        <ul class="addtournav">
            <li>
                <p id="btn-form1" class="btn">Domestic Tours</p>
            </li>
            <li>
                <p id="btn-form2" class="btn">International Tours</p>
            </li>
            <li>
                <p id="btn-form3" class="btn">Activities & Tours</p>
            </li>
            <li>
                <p id="btn-form4" class="btn">Services Tours</p>
            </li>
        </ul>



        <section class="form__section form-container" id="form1">
            <?php
            include('../dbcon.php');

            if (isset($_POST['submit'])) {


                $tour_name = mysqli_real_escape_string($con, $_POST['tour_name']);
                $amount = mysqli_real_escape_string($con, $_POST['amount']);
                $no_of_days = mysqli_real_escape_string($con, $_POST['no_of_days']);
                $category = mysqli_real_escape_string($con, $_POST['category']);
                $highlights = mysqli_real_escape_string($con, $_POST['highlights']);
                $day = mysqli_real_escape_string($con, $_POST['day']);
                $day_title = mysqli_real_escape_string($con, $_POST['day_title']);
                $day_description =  $_POST['day_description'];
                $image = $_FILES['image']['name'];
                $img_tmp = $_FILES['image']['tmp_name'];
                $folder  = "../images/" . $image;


                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $image);
                $extension = end($extension);
                $size = getimagesize($image);
                if (in_array($extension, $allowed_files)) {
                    if ($size < 2) {
                        $insertquery = "INSERT INTO domiternary (tour_title, amount, noofdays, holidayctg, highlights, image)
                            VALUES('$tour_name','$amount','$no_of_days', '$category', '$highlights','$image')";

                        $iquery = mysqli_query($con, $insertquery);
                        move_uploaded_file($img_tmp, $folder);
                    } else {
            ?>
                        <script>
                            alert("File size too big. Should be less than 2MB");
                        </script>
                    <?php
                    }
                } else {
                    ?>
                    <script>
                        alert("File should be png, jpg or jpeg");
                    </script>
                <?php
                }
                if ($iquery) {
                    $tour_id = mysqli_insert_id($con);

                    // Insert itinerary data into the database
                    for ($i = 0; $i < count($day_description); $i++) {
                        $day = $i + 1;
                        $day_title = $day_title[$i];
                        $description = $day_description[$i];
                        $sql = "INSERT INTO daydetails (tour_id, day, day_title, day_description) VALUES ('$tour_id', '$day', '$day_title' '$description')";
                        mysqli_query($con, $sql);
                    }
                }
                ?>
                <script>
                    alert("Tour Added Successfully");
                    location.replace('addtour.php');
                </script>
            <?php
            }


            ?>
            <div class=" row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-details ">
                        <div class="title">
                            <h3>Add Domestic Tour</h3>
                        </div>
                        <div class="contact-form">
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-outline mb-4">
                                    <label for="tour_name">Tour Name</label>
                                    <input type="text" name="tour_name" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="amount">Enter Amount</label>
                                    <input type="text" name="amount" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="no_of_days">Enter Number of Days</label>
                                    <input type="text" name="no_of_days" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="category">Enter Category</label>
                                    <input type="text" name="category" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="highlights">Enter Highlights</label>
                                    <input type="text" name="highlights" class="form-control" required></input>
                                </div>




                                <!-- Image input -->
                                <div class="form-outline mb-4">
                                    <label for="image">Insert Image:</label>
                                    <input type="file" name="image" class="form-control" accept="image">
                                </div>

                                <h3>Itinerary</h3>
                                <button href="javascript:void(0)" type="button" class="add-day-btn float-end btn btn-primary btn-block mb-4">Add Day</button>
                                <br>
                                <br>

                                <div class="form-outline mb-4 mt-4" id="itinerary-container">
                                    <label for="day">Day </label>
                                    <input type="text" name="day[]" class="form-control" required></input>
                                    <label for="day_title">Day Title</label>
                                    <input type="text" name="day_title[]" class="form-control" required></input>
                                    <label for="day_description">Day Description</label>
                                    <textarea type="text" name="day_description[]" class="form-control" required></textarea>
                                </div>

                                <div class="paste-new-forms"></div>

                                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                                    Add Tour
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="form__section form-container" id="form2">


            <div class=" row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-details ">
                        <div class="title">
                            <h3>Add International Tours</h3>
                        </div>
                        <div class="contact-form">
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-outline mb-4">
                                    <label for="title">Tour Name</label>
                                    <input type="title" name="title" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="title">Enter Amount</label>
                                    <input type="title" name="title" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="title">Enter Number of Days</label>
                                    <input type="title" name="title" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="title">Enter Category</label>
                                    <input type="title" name="title" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="title">Enter Highlights</label>
                                    <input type="title" name="title" class="form-control" required></input>
                                </div>

                                <!-- Image input -->
                                <div class="form-outline mb-4">
                                    <label for="image">Insert Image:</label>
                                    <input type="file" name="image" class="form-control" accept="image">
                                </div>

                                <h3>Itinerary</h3>
                                <button href="javascript:void(0)" type="button" class="add-day-btn float-end btn btn-primary btn-block mb-4">Add Day</button>
                                <br>
                                <br>

                                <div class="form-outline mb-4 mt-4" id="itinerary-container">
                                    <label for="day">Day </label>
                                    <input type="title" name="day" class="form-control" required></input>
                                    <label for="title">Day Title</label>
                                    <input type="title" name="title" class="form-control" required></input>
                                    <label for="description">Day Description</label>
                                    <textarea type="title" name="description" class="form-control" required></textarea>
                                </div>

                                <div class="paste-new-forms"></div>

                                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                                    Add Tour
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="form__section form-container" id="form3">

            <div class=" row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-details ">
                        <div class="title">
                            <h3>Add Activities & Tours</h3>
                        </div>
                        <div class="contact-form">
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-outline mb-4">
                                    <label for="title">Activity Name</label>
                                    <input type="title" name="title" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="amount">Enter Amount</label>
                                    <input type="text" name="amount" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="highlights">Enter Highlights</label>
                                    <input type="text" name="highlights" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="tour-desc">Enter Tour Description</label>
                                    <textarea type="text" name="tour-desc" class="form-control" rows="4" required></textarea>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="image">Add Image</label>
                                    <input type="file" name="image" class="form-control" accept="image">
                                </div>

                                <!-- Iternary -->

                                <h3>Itinerary</h3>
                                <button href="javascript:void(0)" type="button" class="add-activity-btn float-end btn btn-primary btn-block mb-4">Add
                                    Activity</button>
                                <br>
                                <br>

                                <div class="form-outline mb-4 mt-4" id="itinerary-container">
                                    <label for="title">Activity Title</label>
                                    <input type="text" name="title" class="form-control" required></input>
                                    <label for="description">Activity Description</label>
                                    <textarea rows="4" type="text" name="description" class="form-control" required></textarea>
                                </div>

                                <div class="add-new-forms"></div>

                                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                                    Add Tour
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>



    <?php include 'includes/links.php'; ?>
</body>

<!-- <div class="col-lg-4 col-md-6 col-mb-12">
                <div class="car-img">
                    <img src="images/c1.webp" alt="car image">
                </div>
                <div class="car-desc">
                    <h5>
                        Car (Economy) Sedan
                    </h5>
                    <p>Tata Indigo/Swift Dzire/Toyota Etios</p>
                    <ul class="sublist">
                        <li>Air-Condition (cool + Warm)</li>
                        <li>Audio System</li>
                        <li>Comfortable Seats</li>
                        <li>Spacious leg space</li>
                        <li>Driver + 4 Seating</li>
                    </ul>
                    <?php include('includes/book.php'); ?>
                    <?php include 'includes/whatsapp.php'; ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-mb-12">
                <div class="car-img">
                    <img src="images/c2.webp" alt="car image">
                </div>
                <div class="car-desc">
                    <h5>
                        Car (Deluxe), SUV
                        </h4>
                        <p>Toyota Innova (6 / 7 seater)</p>
                        <ul class="sublist">
                            <li>Air-Condition (cool + Warm)</li>
                            <li>Audio System</li>
                            <li>Comfortable Seats (6 - Seater Bucket seating, 7 - Seater Sofa Seating)</li>
                            <li>Spacious leg space</li>
                            <li>Driver + (6 / 7 Seating)</li>
                        </ul>
                        <?php include('includes/book.php'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-mb-12">
                <div class="car-img">
                    <img src="images/c3.webp" alt="car image">
                </div>
                <div class="car-desc">
                    <h5>
                        Car (Premium)
                    </h5>
                    <p>Skoda Superb / Toyota Camry / Toyota Fortuner / BMW / Mercedes Benz / Audi Car / Land Rover</p>
                    <ul class="sublist">
                        <li>Air-Condition (cool + Warm)</li>
                        <li>Bluetooth Audio Streaming, Ipad / MP3 Media interface</li>
                        <li>LCD Screen Video system</li>
                        <li>Adjustable Power seats</li>
                        <li>Navigation System</li>
                    </ul>
                    <?php include('includes/book.php'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-mb-12">
                <div class="car-img">
                    <img src="images/c4.webp" alt="car image">
                </div>
                <div class="car-desc">
                    <h5>
                        Tempo Traveller
                    </h5>
                    <p>9+1 Seater</p>
                    <ul class="sublist">
                        <li>Fully Air-Condition(Cool + Warm)</li>
                        <li>Audio System</li>
                        <li>Equipped with LCD Screen</li>
                        <li>Maharaja Seats (1 X 1)</li>
                        <li>Spacious leg space with foot rest</li>
                        <li>Luxurious Interior</li>
                        <li>Fixed Glasses</li>
                    </ul>
                    <?php include('includes/book.php'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-mb-12">
                <div class="car-img">
                    <img src="images/c5.webp" alt="car image">
                </div>
                <div class="car-desc">
                    <h5>
                        Hi-Tech Coaches
                    </h5>
                    <p>35 / 40 / 45 Seater</p>
                    <ul class="sublist">
                        <li>Air-Condition (cool + Warm)</li>
                        <li>Audio System</li>
                        <li>Equipped with LCD Screen</li>
                        <li>Comfortable Seats with fully push back (2 X 2)</li>
                        <li>Spacious leg space with foot rest</li>
                        <li>Air Suspension</li>
                        <li>Mike System</li>
                    </ul>
                    <?php include('includes/book.php'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-mb-12">
                <div class="car-img">
                    <img src="images/c6.webp" alt="car image">
                </div>
                <div class="car-desc">
                    <h5>
                        Mini - Coaches
                    </h5>
                    <p>25 / 27 Seater</p>
                    <ul class="sublist">
                        <li>Air-Condition (cool + Warm)</li>
                        <li>Audio System</li>
                        <li>Video System</li>
                        <li>Comfortable Seats with push back (2 X 2)</li>
                        <li>Spacious leg space with foot rest</li>
                        <li>Air Suspension</li>
                        <li>Mike System</li>
                    </ul>
                    <?php include('includes/book.php'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-mb-12">
                <div class="car-img">
                    <img src="images/c7.webp" alt="car image">
                </div>
                <div class="car-desc">
                    <h5>
                        Volvo Coach
                    </h5>
                    <p>45 Seater</p>
                    <ul class="sublist">
                        <li>Air-Condition (cool + Warm)</li>
                        <li>Audio System</li>
                        <li>Equipped with LCD Screen</li>
                        <li>Reclaining Seats (2 X 2)</li>
                        <li>Spacious leg space with foot rest</li>
                        <li>Hydraulic Retrader</li>
                        <li>Full Air Suspension</li>
                    </ul>
                    <?php include('includes/book.php'); ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-mb-12">
                <div class="car-img">
                    <img src="images/c8.webp" alt="car image">
                </div>
                <div class="car-desc">
                    <h5>
                        Volvo Multi Axle Coach
                    </h5>
                    <p>53 Seater</p>
                    <ul class="sublist">
                        <li>Air-Condition (cool + Warm)</li>
                        <li>Audio System</li>
                        <li>Equipped with LCD Screen</li>
                        <li>Reclaining Seats (2 X 2)</li>
                        <li>Spacious leg space with foot rest</li>
                        <li>Hydraulic Retrader</li>
                        <li>Full Air Multi - Axle Suspension</li>
                    </ul>
                    <?php include('includes/book.php'); ?>
                </div>
            </div> -->