<?php

session_start();

if (!isset($_SESSION['email'])) {
    header('location:login.php');
}
?>
<?php include 'includes/header.php'; ?>

<body>

    <?php include 'includes/navbar.php';
    include('../dbcon.php');
    ?>

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
                <p id="btn-form4" class="btn">Vehicles</p>
            </li>
            <li>
                <p id="btn-form5" class="btn">Hotels</p>
            </li>
        </ul>



        <section class="form__section form-container form_content" id="form1">
            <?php
            if (isset($_POST['submit1'])) {
                $tour_name = mysqli_real_escape_string($con, $_POST['tour_name']);
                $amount = mysqli_real_escape_string($con, $_POST['amount']);
                $no_of_days = mysqli_real_escape_string($con, $_POST['no_of_days']);
                $category = strtoupper(mysqli_real_escape_string($con, $_POST['category']));
                $highlights = mysqli_real_escape_string($con, $_POST['highlights']);
                $inclusion = mysqli_real_escape_string($con, $_POST['inclusion']);
                $exclusion = mysqli_real_escape_string($con, $_POST['exclusion']);
                $day = $_POST['day'];
                $day_title = $_POST['day_title'];
                $day_description = $_POST['day_description'];
                $image = $_FILES['image']['name'];
                $img_tmp = $_FILES['image']['tmp_name'];
                $folder  = "../images/domestictour/" . $image;
                $image2 = $_FILES['image2']['name'];
                $img2_tmp = $_FILES['image2']['tmp_name'];
                $folder2 = "../images/domestictour/" . $image2;

                $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
                $extension = explode('.', $image);
                $extension = end($extension);
                $size = filesize($img_tmp);
                if (in_array($extension, $allowed_files)) {
                    if ($size < 2000 * 1024) {
                        $extension2 = explode('.', $image2);
                        $extension2 = end($extension2);
                        $size2 = filesize($img2_tmp);
                        if (in_array($extension2, $allowed_files)) {
                            if ($size2 < 2000 * 1024) {
                                $insertquery = "INSERT INTO domiternary (tour_title, amount, noofdays, holidayctg, highlights, image,bgimage, inclusion, exclusion) VALUES('$tour_name','$amount','$no_of_days', '$category', '$highlights','$image', '$image2', '$inclusion', '$exclusion')";
                                $iquery = mysqli_query($con, $insertquery);
                                move_uploaded_file($img_tmp, $folder);
                                move_uploaded_file($img2_tmp, $folder2);

                                if ($iquery) {
                                    $tour_id = mysqli_insert_id($con);
                                    // Insert itinerary data into the database
                                    for ($i = 0; $i < count($day_description); $i++) {
                                        $days = mysqli_real_escape_string($con, $day[$i]);
                                        $day_titles = mysqli_real_escape_string($con, $day_title[$i]);
                                        $description = mysqli_real_escape_string($con, $day_description[$i]);
                                        $sql = "INSERT INTO daydetails (day, daytitle, daydesc, tour_id) VALUES ('$days', '$day_titles', '$description', '$tour_id')";
                                        if (!mysqli_query($con, $sql)) {
                                            echo "Error: " . mysqli_error($con);
                                        }
                                    }
            ?>
            <script>
            alert("Tour Added Successfully");
            location.replace('addtour.php');
            </script>
            <?php
                                } else {
                                ?>
            <script>
            alert("Error in adding tour. Please try again");
            </script>
            <?php
                                }
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
            alert("Invalid file type. Only PNG, JPG, JPEG, and WEBP files are allowed");
            </script>
            <?php
                        }
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
            alert("Invalid file type. Only PNG, JPG, JPEG, and WEBP files are allowed");
            </script>
            <?php
                }
            }
            ?>

            <div class=" row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-details ">
                        <div class="title">
                            <h3>Add Domestic Tour</h3>
                        </div>
                        <div class="contact-form">
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST"
                                enctype="multipart/form-data">
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
                                <div class="form-outline mb-4">
                                    <label for="inclusion">Enter Inclusion</label>
                                    <input type="text" name="inclusion" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="highlights">Enter Exclusion</label>
                                    <input type="text" name="exclusion" class="form-control" required></input>
                                </div>




                                <!-- Image input -->
                                <div class="form-outline mb-4">
                                    <label for="image">Insert Image:</label>
                                    <input type="file" name="image" class="form-control" accept="image" required>
                                </div>

                                <div class="form-outline mb-4">
                                    <label for="image">Insert Background Image:</label>
                                    <input type="file" name="image2" class="form-control" accept="image" required>
                                </div>

                                <h3>Itinerary</h3>
                                <button href="javascript:void(0)" type="button"
                                    class="add-day-btn float-end btn btn-primary btn-block mb-4">Add Day</button>
                                <br>
                                <br>

                                <div class="form-outline mb-4 mt-4" id="itinerary-container">
                                    <label for="day">Day </label>
                                    <input type="text" name="day[]" class="form-control" required></input>
                                    <label for="day_title">Day Title</label>
                                    <input type="text" name="day_title[]" class="form-control" required></input>
                                    <label for="day_description">Day Description</label>
                                    <textarea type="text" name="day_description[]" class="form-control"
                                        required></textarea>
                                </div>

                                <div class="paste-new-forms"></div>

                                <button type="submit" name="submit1" class="btn btn-primary btn-block mb-4">
                                    Add Tour
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="form__section form-container form_content" id="form2">
            <?php
            if (isset($_POST['submit2'])) {
                $tour_name = mysqli_real_escape_string($con, $_POST['tour_name']);
                $amount = mysqli_real_escape_string($con, $_POST['amount']);
                $no_of_days = mysqli_real_escape_string($con, $_POST['no_of_days']);
                $category = strtoupper(mysqli_real_escape_string($con, $_POST['category']));
                $highlights = mysqli_real_escape_string($con, $_POST['highlights']);
                $inclusion = mysqli_real_escape_string($con, $_POST['inclusion']);
                $exclusion = mysqli_real_escape_string($con, $_POST['exclusion']);
                $day = $_POST['day'];
                $day_title = $_POST['day_title'];
                $day_description = $_POST['day_description'];
                $image = $_FILES['image']['name'];
                $img_tmp = $_FILES['image']['tmp_name'];
                $folder  = "../images/internationaltour/" . $image;
                $image2 = $_FILES['image2']['name'];
                $img2_tmp = $_FILES['image2']['tmp_name'];
                $folder2  = "../images/internationaltour/" . $image2;

                $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
                $extension = explode('.', $image);
                $extension = end($extension);
                $size = filesize($img_tmp);
                if (in_array($extension, $allowed_files)) {
                    if ($size < 2000 * 1024) {
                        $extension2 = explode('.', $image2);
                        $extension2 = end($extension2);
                        $size2 = filesize($img2_tmp);
                        if (in_array($extension2, $allowed_files)) {
                            if ($size2 < 2000 * 1024) {
                                $insertquery = "INSERT INTO intiternary (tour_title, amount, noofdays, holidayctg, highlights, image, bgimage, inclusion, exclusion)
                                VALUES('$tour_name','$amount','$no_of_days', '$category', '$highlights','$image','$image2', '$inclusion', '$exclusion')";
                                $iquery = mysqli_query($con, $insertquery);
                                move_uploaded_file($img_tmp, $folder);
                                move_uploaded_file($img2_tmp, $folder2);

                                if ($iquery) {
                                    $tour_id = mysqli_insert_id($con);
                                    // Insert itinerary data into the database
                                    for ($i = 0; $i < count($day_description); $i++) {
                                        $days = mysqli_real_escape_string($con, $day[$i]);
                                        $day_titles = mysqli_real_escape_string($con, $day_title[$i]);
                                        $description = mysqli_real_escape_string($con, $day_description[$i]);
                                        $sql = "INSERT INTO intdays (day, daytitle, daydesc, tour_id) VALUES ('$days', '$day_titles', '$description', '$tour_id')";
                                        if (!mysqli_query($con, $sql)) {
                                            echo "Error: " . mysqli_error($con);
                                        }
                                    }
            ?>
            <script>
            alert("Tour Added Successfully");
            location.replace('addtour.php');
            </script>
            <?php
                                } else {
                                ?>
            <script>
            alert("Error in adding tour. Please try again");
            </script>
            <?php
                                }
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
            alert("Invalid file type. Only PNG, JPG, JPEG, and WEBP files are allowed");
            </script>
            <?php
                        }
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
            alert("Invalid file type. Only PNG, JPG, JPEG, and WEBP files are allowed");
            </script>
            <?php
                }
            }


            ?>
            <div class=" row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-details ">
                        <div class="title">
                            <h3>Add International Tour</h3>
                        </div>
                        <div class="contact-form">
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST"
                                enctype="multipart/form-data">
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
                                <div class="form-outline mb-4">
                                    <label for="inclusion">Enter Inclusion</label>
                                    <input type="text" name="inclusion" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="highlights">Enter Exclusion</label>
                                    <input type="text" name="exclusion" class="form-control" required></input>
                                </div>




                                <!-- Image input -->
                                <div class="form-outline mb-4">
                                    <label for="image">Insert Image:</label>
                                    <input type="file" name="image" class="form-control" accept="image" required>
                                </div>

                                <div class="form-outline mb-4">
                                    <label for="image">Insert Background Image:</label>
                                    <input type="file" name="image2" class="form-control" accept="image" required>
                                </div>

                                <h3>Itinerary</h3>
                                <button href="javascript:void(0)" type="button"
                                    class="add-day-btn float-end btn btn-primary btn-block mb-4">Add Day</button>
                                <br>
                                <br>

                                <div class="form-outline mb-4 mt-4" id="itinerary-container">
                                    <label for="day">Day </label>
                                    <input type="text" name="day[]" class="form-control" required></input>
                                    <label for="day_title">Day Title</label>
                                    <input type="text" name="day_title[]" class="form-control" required></input>
                                    <label for="day_description">Day Description</label>
                                    <textarea type="text" name="day_description[]" class="form-control"
                                        required></textarea>
                                </div>

                                <div class="paste-new-forms"></div>

                                <button type="submit" name="submit2" class="btn btn-primary btn-block mb-4">
                                    Add Tour
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="form__section form-container form_content" id="form3">
            <?php
            if (isset($_POST['add_activity'])) {
                $tour_name = mysqli_real_escape_string($con, $_POST['tour_name']);
                $amount = mysqli_real_escape_string($con, $_POST['amount']);
                $category = strtoupper(mysqli_real_escape_string($con, $_POST['category']));
                $highlights = mysqli_real_escape_string($con, $_POST['highlights']);
                $tour_desc = mysqli_real_escape_string($con, $_POST['tour_desc']);
                $activity_title =  $_POST['activity_title'];
                $activity_description =  $_POST['activity_description'];
                $image = $_FILES['image']['name'];
                $img_tmp = $_FILES['image']['tmp_name'];
                $folder  = "../images/activity/" . $image;
                $image2 = $_FILES['image2']['name'];
                $img2_tmp = $_FILES['image2']['tmp_name'];
                $folder2  = "../images/activity/" . $image2;

                $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
                $extension = explode('.', $image);
                $extension = end($extension);
                $size = filesize($img_tmp);
                if (in_array($extension, $allowed_files)) {
                    if ($size < 2000 * 1024) {
                        $extension2 = explode('.', $image2);
                        $extension2 = end($extension2);
                        $size2 = filesize($img2_tmp);
                        if (in_array($extension2, $allowed_files)) {
                            if ($size2 < 2000 * 1024) {
                                $insertquery = "INSERT INTO activityiternary (activity_title, amount, tourdesc, category, highlights, image, bgimage)
                         VALUES('$tour_name','$amount', '$tour_desc', '$category', '$highlights','$image', '$image2')";
                                $iquery = mysqli_query($con, $insertquery);
                                move_uploaded_file($img_tmp, $folder);
                                move_uploaded_file($img2_tmp, $folder2);

                                if ($iquery) {
                                    $tour_id = mysqli_insert_id($con);
                                    // Insert itinerary data into the database
                                    for ($i = 0; $i < count($activity_description); $i++) {
                                        $activity_titles =  mysqli_real_escape_string($con, $activity_title[$i]);
                                        $activity_descriptions =  mysqli_real_escape_string($con, $activity_description[$i]);
                                        $sql = "INSERT INTO activity ( tour_id, activitytitle, description) VALUES ( '$tour_id', '$activity_titles', '$activity_descriptions')";
                                        mysqli_query($con, $sql);
                                    }
            ?>
            <script>
            alert("Tour Added Successfully");
            location.replace('addtour.php');
            </script>
            <?php
                                } else {
                                ?>
            <script>
            alert("Error in adding tour. Please try again");
            </script>
            <?php
                                }
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
            alert("Invalid file type. Only PNG, JPG, JPEG, and WEBP files are allowed");
            </script>
            <?php
                        }
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
            alert("Invalid file type. Only PNG, JPG, JPEG, and WEBP files are allowed");
            </script>
            <?php
                }
            }

            ?>

            <div class=" row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-details ">
                        <div class="title">
                            <h3>Add Activities & Tours</h3>
                        </div>
                        <div class="contact-form">
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST"
                                enctype="multipart/form-data">
                                <div class="form-outline mb-4">
                                    <label for="tour_name">Activity Name</label>
                                    <input type="text" name="tour_name" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="amount">Enter Amount</label>
                                    <input type="text" name="amount" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="category">Enter Category</label>
                                    <input type="text" name="category" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="highlights">Enter Highlights</label>
                                    <input type="text" name="highlights" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="tour_desc">Enter Tour Description</label>
                                    <input type="text" name="tour_desc" class="form-control" rows="4" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="image">Add Image</label>
                                    <input type="file" name="image" class="form-control" accept="image" required>
                                </div>

                                <div class="form-outline mb-4">
                                    <label for="image">Insert Background Image:</label>
                                    <input type="file" name="image2" class="form-control" accept="image" required>
                                </div>

                                <!-- Iternary -->

                                <h3>Itinerary</h3>
                                <button href="javascript:void(0)" type="button"
                                    class="add-activity-btn float-end btn btn-primary btn-block mb-4">Add
                                    Activity</button>
                                <br>
                                <br>

                                <div class="form-outline mb-4 mt-4" id="itinerary-container">
                                    <label for="activity_title">Activity Title</label>
                                    <input type="text" name="activity_title[]" class="form-control" required></input>
                                    <label for="activity_description">Activity Description</label>
                                    <input rows="4" type="text" name="activity_description[]" class="form-control"
                                        required></input>
                                </div>

                                <div class="add-new-forms"></div>

                                <button type="submit" name="add_activity" class="btn btn-primary btn-block mb-4">
                                    Add Tour
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="form__section form-container form_content" id="form4">
            <?php

            if (isset($_POST['submit4'])) {


                $vehicle_category = mysqli_real_escape_string($con, $_POST['category']);
                $vehicle_name = mysqli_real_escape_string($con, $_POST['vehicle_name']);
                $price = mysqli_real_escape_string($con, $_POST['price']);
                $features = $_POST['vehicle_feature'];
                $image = $_FILES['image']['name'];
                $img_tmp = $_FILES['image']['tmp_name'];
                $folder  = "../images/vehicle/" . $image;


                $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
                $extension = explode('.', $image);
                $extension = end($extension);
                $size = filesize($image);
                if (in_array($extension, $allowed_files)) {
                    if ($size < 2) {
                        $insertquery = "INSERT INTO vehicle_details (vehicle_category, vehicle_name, price, image)
                                        VALUES('$vehicle_category','$vehicle_name', '$price','$image')";

                        $iquery = mysqli_query($con, $insertquery);
                        move_uploaded_file($img_tmp, $folder);
                        if ($iquery) {
                            $vehicle_id = mysqli_insert_id($con);

                            // Insert itinerary data into the database
                            for ($i = 0; $i < count($features); $i++) {
                                $feature = $features[$i];
                                $sql = "INSERT INTO vehicle_features ( vehicle_id, feature) VALUES ( '$vehicle_id', '$feature')";
                                mysqli_query($con, $sql);
                            }
                        }
            ?>
            <script>
            alert("Tour Added Successfully");
            location.replace('addtour.php');
            </script>
            <?php
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
            alert("File should be png, jpg, jpeg, webp");
            </script>
            <?php
                }
            }

            ?>

            <div class=" row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-details ">
                        <div class="title">
                            <h3>Add Vehicle Details</h3>
                        </div>
                        <div class="contact-form">
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST"
                                enctype="multipart/form-data">
                                <div class="form-outline mb-4">
                                    <label for="category">Vehicle Type</label>
                                    <input type="text" name="category" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="vehicle_name">Vehicle Name</label>
                                    <input type="text" name="vehicle_name" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="price">Enter Price</label>
                                    <input type="text" name="price" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="image">Add Image</label>
                                    <input type="file" name="image" class="form-control" accept="image">
                                </div>

                                <!-- Iternary -->

                                <h3>Vehicle Features</h3>

                                <button href="javascript:void(0)" type="button"
                                    class="add-feature1-btn float-end btn btn-primary btn-block mb-4">Add
                                    Feature</button>
                                <br>
                                <br>

                                <div class="form-outline mb-4 mt-4" id="itinerary-container">
                                    <label for="vehicle_feature">Enter Feature</label>
                                    <input type="text" name="vehicle_feature[]" class="form-control" required></input>
                                </div>

                                <div class="paste-new-feature1"></div>

                                <button type="submit" name="submit4" class="btn btn-primary btn-block mb-4">
                                    Add Vehicle
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="form__section form-container form_content" id="form5">
            <?php

            if (isset($_POST['submit5'])) {

                $hotel_place = mysqli_real_escape_string($con, $_POST['place']);
                $price = mysqli_real_escape_string($con, $_POST['price']);
                $highlights = mysqli_real_escape_string($con, $_POST['highlights']);
                $hotel_name = $_POST['name'];
                $hotel_desc = $_POST['description'];
                $main_image = $_FILES['main_image']['name'];
                $main_img_tmp = $_FILES['main_image']['tmp_name'];
                $main_image_folder  = "../images/hotel" . $main_image;

                $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
                $main_image_extension = explode('.', $main_image);
                $main_image_extension = end($main_image_extension);

                $main_image_size = filesize($main_img_tmp);

                if (in_array($main_image_extension, $allowed_files)) {
                    if ($main_image_size < 2000 * 1024) {
                        $insertquery = "INSERT INTO hotel (hotel_place, price, main_image, highlights)
                                    VALUES('$hotel_place', '$price','$main_image', '$highlights')";

                        $iquery = mysqli_query($con, $insertquery);
                        move_uploaded_file($main_img_tmp, $main_image_folder);
                        if ($iquery) {
                            $hotel_id = mysqli_insert_id($con);

                            // Insert hotel data into the database
                            for ($i = 0; $i < count($hotel_name); $i++) {
                                $name = $hotel_name[$i];
                                $desc = $hotel_desc[$i];
                                $image = $_FILES['hotel_image']['name'][$i];
                                $img_tmp = $_FILES['hotel_image']['tmp_name'][$i];
                                $folder  = "../images/" . $image;
                                $allowed_files = ['png', 'jpg', 'jpeg', 'webp'];
                                $extension = explode('.', $image);
                                $extension = end($extension);
                                $size = filesize($img_tmp);
                                if (in_array($extension, $allowed_files)) {
                                    if ($size < 2000 * 1024) {
                                        $sql = "INSERT INTO hotel_details (hotel_id, name, description, image) VALUES ('$hotel_id', '$name', '$desc', '$image')";
                                        mysqli_query($con, $sql);
                                        move_uploaded_file($img_tmp, $folder);
                                    } else {
            ?>
            <script>
            alert("File size too big. Should be less than 2");
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
                            }
                        }
                        ?>
            <script>
            alert("Hotel Added Successfully");
            location.replace('addtour.php');
            </script>
            <?php
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
            alert("File should be png, jpg, jpeg, webp");
            </script>
            <?php
                }
            }

            ?>

            <div class=" row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-details ">
                        <div class="title">
                            <h3>Add Hotel Details</h3>
                        </div>
                        <div class="contact-form">
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST"
                                enctype="multipart/form-data">
                                <div class="form-outline mb-4">
                                    <label for="place">Name of Place</label>
                                    <input type="text" name="place" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="price">Enter Price</label>
                                    <input type="text" name="price" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="highlights">Enter Highlights</label>
                                    <input type="text" name="highlights" class="form-control" required></input>
                                </div>
                                <div class="form-outline mb-4">
                                    <label for="main_image">Add Image</label>
                                    <input type="file" name="main_image" class="form-control" accept="image">
                                </div>

                                <!-- Iternary -->

                                <h3> Hotels</h3>

                                <button href="javascript:void(0)" type="button"
                                    class="add-hotel-btn float-end btn btn-primary btn-block mb-4">Add Hotel
                                </button>
                                <br>
                                <br>

                                <div class="form-outline mb-4 mt-4 " id="itinerary-container">
                                    <label class="pt-3" for="name">Enter Hotel Name: </label>
                                    <input type="text" name="name[]" class="form-control" required></input>
                                    <label class="pt-3" for="image">Add Image</label>
                                    <input type="file" name="hotel_image[]" class="form-control" required></input>
                                    <label class="pt-3" for="description">Add Description</label>
                                    <input type="text" name="description[]" class="form-control" required></input>
                                </div>

                                <div class="paste-new-hotel"></div>

                                <button type="submit" name="submit5" class="btn btn-primary btn-block mb-4">
                                    Add Hotel
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