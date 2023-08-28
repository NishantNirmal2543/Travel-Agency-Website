<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('location:login.php');
}
?>

<?php include 'includes/header.php'; ?>

<body>

    <?php

    include('../dbcon.php');

    if (isset($_POST['update_tour'])) {
        $id = $_POST['id'];
        $tour_name = isset($_POST['tour_name']) ? mysqli_real_escape_string($con, $_POST['tour_name']) : '';
        $amount = isset($_POST['amount']) ? mysqli_real_escape_string($con, $_POST['amount']) : '';
        $no_of_days = isset($_POST['no_of_days']) ? mysqli_real_escape_string($con, $_POST['no_of_days']) : '';
        $category = isset($_POST['category']) ? mysqli_real_escape_string($con, $_POST['category']) : '';
        $highlights = isset($_POST['highlights']) ? mysqli_real_escape_string($con, $_POST['highlights']) : '';
        $inclusion = isset($_POST['inclusion']) ? mysqli_real_escape_string($con, $_POST['inclusion']) : '';
        $exclusion = isset($_POST['exclusion']) ? mysqli_real_escape_string($con, $_POST['exclusion']) : '';
        $day =    isset($_POST['day']) ? $_POST['day'] : array();
        $day_title = isset($_POST['day_title']) ? $_POST['day_title'] : array();
        $day_description = isset($_POST['day_description']) ?  $_POST['day_description'] : array();

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image = $_FILES['image']['name'];
            $img_tmp = $_FILES['image']['tmp_name'];
            $folder = "../images/internationaltour" . $image;

            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            if (in_array($extension, $allowed_files)) {
                $size = getimagesize($img_tmp);
                if ($size[0] < 2000 && $size[1] < 2000 && $_FILES['image']['size'] < 2097152) {
                    $updatequery = "UPDATE intiternary SET tour_title='$tour_name', amount='$amount', noofdays='$no_of_days', holidayctg='$category', highlights='$highlights', inclusion='$inclusion', exclusion='$exclusion', image='$image' WHERE id='$id'";
                    $uquery = mysqli_query($con, $updatequery);
                    if ($uquery) {
                        move_uploaded_file($img_tmp, $folder);
                        if ($uquery) {
                            var_dump($day_description);

                            // Insert itinerary data into the database
                            for ($i = 0; $i < count($day_description); $i++) {
                                $days = $day[$i];
                                $day_titles = $day_title[$i];
                                $description = $day_description[$i];
                                $sql = "UPDATE intdays SET day='$days', daytitle='$day_titles', daydesc='$description' ,tour_id='$id' ";
                                mysqli_query($con, $sql);
                            }
                        }
    ?>
                        <script>
                            alert("Tour updated Successfully");
                            location.replace('managetours.php');
                        </script>
                <?php
                    } else {
                        echo "Error updating tour: " . mysqli_error($con);
                    }
                } else {
                    echo "File size too big. Should be less than 2MB and dimensions less than 2000x2000.";
                }
            } else {
                echo "File should be png, jpg, or jpeg. The uploaded file has an extension of .$extension";
            }
        } else {
            $updatequery = "UPDATE intiternary SET tour_title='$tour_name', amount='$amount', noofdays='$no_of_days', holidayctg='$category', highlights='$highlights', inclusion='$inclusion', exclusion='$exclusion' WHERE id='$id'";
            $uquery = mysqli_query($con, $updatequery);
            if ($uquery) {
                if (count($day_description) > 0) {


                    for ($i = 0; $i < count($day_description); $i++) {
                        $days = mysqli_real_escape_string($con, $day[$i]);
                        $day_titles = mysqli_real_escape_string($con, $day_title[$i]);
                        $description = mysqli_real_escape_string($con, $day_description[$i]);

                        // Check if day already exists in database
                        $check_sql = "SELECT * FROM intdays WHERE tour_id='$id' AND day='$days'";
                        $result = mysqli_query($con, $check_sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Day already exists, update the day
                            $sql = "UPDATE intdays SET daytitle='$day_titles', daydesc='$description' WHERE tour_id='$id' AND day='$days'";
                            mysqli_query($con, $sql);
                        } else {
                            // Day doesn't exist, insert new day
                            $sql = "INSERT INTO intdays (tour_id, day, daytitle, daydesc) VALUES ('$id', '$days', '$day_titles', '$description')";
                            mysqli_query($con, $sql);
                        }
                    }
                }
                ?>
                <script>
                    alert("Tour updated Successfully");
                    location.replace('managetours.php');
                </script>
        <?php
            } else {
                echo "Error updating tour: " . mysqli_error($con);
            }
        }
    } else {
        $id = $_GET['id'];
        $selectquery = "SELECT * FROM intiternary WHERE id=$id";
        $squery = mysqli_query($con, $selectquery);
        $tour = mysqli_fetch_assoc($squery);
        $selectquery2 = "SELECT * FROM intdays WHERE tour_id=$id";
        $squery2 = mysqli_query($con, $selectquery2);
        $itinerary = mysqli_fetch_all($squery2, MYSQLI_ASSOC);
        ?>

        <?php include 'includes/navbar.php'; ?>

        <div id="main" class="main p-5">
            <section class="form__section">
                <div class=" row">
                    <div class="col-lg-8 col-sm-12">
                        <div class="contact-details ">
                            <div class="title">
                                <h3>Update Domestic Tour</h3>
                            </div>
                            <div class="contact-form">
                                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $tour['id'] ?>">
                                    <div class="form-outline mb-4">
                                        <label for="tour_name">Tour Name</label>
                                        <input type="text" name="tour_name" class="form-control" value="<?php echo $tour['tour_title'] ?>" required></input>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="amount">Enter Amount</label>
                                        <input type="text" name="amount" class="form-control" value="<?php echo $tour['amount'] ?>" required></input>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="no_of_days">Enter Number of Days</label>
                                        <input type="text" name="no_of_days" class="form-control" value="<?php echo $tour['noofdays'] ?>" required></input>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="category">Enter Category</label>
                                        <input type="text" name="category" class="form-control" value="<?php echo $tour['holidayctg'] ?>" required></input>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="highlights">Enter Highlights</label>
                                        <input type="text" name="highlights" class="form-control" value="<?php echo $tour['highlights'] ?>" required></input>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="inclusion">Enter Inclusion</label>
                                        <input type="text" name="inclusion" class="form-control" value="<?php echo $tour['inclusion'] ?>" required></input>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="highlights">Enter Exclusion</label>
                                        <input type="text" name="exclusion" class="form-control" value="<?php echo $tour['exclusion'] ?>" required></input>
                                    </div>
                                    <!-- Image input -->
                                    <div class="form-outline mb-4">
                                        <label for="image">Insert Image:</label>
                                        <input type="file" name="image" class="form-control" accept="image">
                                    </div>

                                    <h3>Itinerary</h3>
                                    <?php foreach ($itinerary as $day) { ?>
                                        <div class="form-outline mb-4 mt-4" id="itinerary-container">
                                            <label for="day">Day </label>
                                            <textarea type="text" name="day[]" class="form-control" required><?php echo $day['day'] ?></textarea>
                                            <label for="day_title">Day Title</label>
                                            <textarea type="text" name="day_title[]" class="form-control" required><?php echo $day['daytitle'] ?></textarea>
                                            <label for="day_description">Day Description</label>
                                            <textarea type="text" name="day_description[]" class="form-control" required><?php echo $day['daydesc'] ?></textarea>
                                        </div>
                                    <?php } ?>

                                    <div class="paste-new-forms"></div>

                                    <button href="javascript:void(0)" type="button" class="add-day-btn float-end btn btn-primary btn-block mb-4">Add Day</button>
                                    <br>
                                    <br>

                                    <button type="submit" name="update_tour" class="btn btn-primary btn-block mb-4">
                                        Update Tour
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <?php
    }
    ?>
    </main>
    <?php include 'includes/links.php'; ?>

</body>

</html>