<?php

include('../dbcon.php');

if (isset($_POST['delete1'])) {

    $id = $_POST['delete1'];

    $query = "SELECT * FROM domiternary WHERE id=$id";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        $image = $post['image'];
        $folder = '../images/domestictour' . $image;

        if ($folder) {
            unlink($folder);
            $delete_query = "DELETE FROM domiternary WHERE id=$id";
            $run = mysqli_query($con, $delete_query);
            if ($run) {

?>
                <script>
                    alert('Tour deleted successfully');
                    location.replace('managetours.php');
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert('Something went wrong');
                    location.replace('managetours.php');
                </script>
            <?php

            }
        }
    }
}

if (isset($_POST['delete2'])) {

    $id = $_POST['delete2'];

    $query = "SELECT * FROM intiternary WHERE id=$id";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        $image = $post['image'];
        $folder = '../images/internationaltour' . $image;

        if ($folder) {
            unlink($folder);
            $delete_query = "DELETE FROM intiternary WHERE id=$id";
            $run = mysqli_query($con, $delete_query);
            if ($run) {

            ?>
                <script>
                    alert('Tour deleted successfully');
                    location.replace('managetours.php');
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert('Something went wrong');
                    location.replace('managetours.php');
                </script>
            <?php

            }
        }
    }
}

if (isset($_POST['delete3'])) {

    $id = $_POST['delete3'];

    $query = "SELECT * FROM activityiternary WHERE id=$id";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        $image = $post['image'];
        $folder = '../images/activity' . $image;

        if ($folder) {
            unlink($folder);
            $delete_query = "DELETE FROM activityiternary WHERE id=$id";
            $run = mysqli_query($con, $delete_query);
            if ($run) {

            ?>
                <script>
                    alert('Tour deleted successfully');
                    location.replace('managetours.php');
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert('Something went wrong');
                    location.replace('managetours.php');
                </script>
            <?php

            }
        }
    }
}

if (isset($_POST['delete4'])) {

    $id = $_POST['delete4'];

    $query = "SELECT * FROM vehicle_details WHERE id=$id";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        $image = $post['image'];
        $folder = '../images/vehicle' . $image;

        if ($folder) {
            unlink($folder);
            $delete_query = "DELETE FROM vehicle_details WHERE id=$id";
            $run = mysqli_query($con, $delete_query);
            if ($run) {

            ?>
                <script>
                    alert('Vehicle deleted successfully');
                    location.replace('managetours.php');
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert('Something went wrong');
                    location.replace('managetours.php');
                </script>
            <?php

            }
        }
    }
}

if (isset($_POST['delete5'])) {

    $id = $_POST['delete5'];

    $query = "SELECT * FROM hotel WHERE id=$id";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        $image = $post['image'];
        $folder = '../images/hotel' . $image;

        if ($folder) {
            unlink($folder);
            $delete_query = "DELETE FROM hotel WHERE id=$id";
            $run = mysqli_query($con, $delete_query);
            if ($run) {

            ?>
                <script>
                    alert('Hotel deleted successfully');
                    location.replace('managetours.php');
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert('Something went wrong');
                    location.replace('managetours.php');
                </script>
        <?php

            }
        }
    }
}

if (isset($_POST['delete6'])) {
    $faq_id = $_POST['delete6'];

    $sql = "DELETE FROM faqs WHERE id = '$faq_id'";
    if ($con->query($sql) === TRUE) {
        ?>
        <script>
            alert("FAQ deleted successfully")
            location.replace('deletefaq.php')
        </script>
<?php
    } else {
        echo "Error deleting FAQ: " . $conn->error;
    }
}





?>