<?php

session_start();

if (!isset($_SESSION['email'])) {
    header('location:login.php');
}
?>
<?php include 'includes/header.php'; ?>

<body>
    <?php include('../includes/message.php'); ?>

    <?php
    include '../dbcon.php';
    ?>
    <?php include 'includes/navbar.php'; ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <ul class="addtournav">
            <li>
                <p id="btn-table1" class="btn">Domestic Tours</p>
            </li>
            <li>
                <p id="btn-table2" class="btn">International Tours</p>
            </li>
            <li>
                <p id="btn-table3" class="btn">Activities & Tours</p>
            </li>
            <li>
                <p id="btn-table4" class="btn">Vehicles</p>
            </li>
            <li>
                <p id="btn-table5" class="btn">Hotels</p>
            </li>
        </ul>
        <div class="form-container" id="table1">
            <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr>
                        <th>Tour Name</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <?php
                $postQuery = "SELECT * from domiternary ORDER BY id DESC";
                $runPQ = mysqli_query($con, $postQuery);
                while ($post = mysqli_fetch_assoc($runPQ)) {
                ?>
                <tbody>
                    <tr>
                        <td><?= $post['tour_title'] ?> </td>
                        <td><?= $post['holidayctg'] ?> </td>
                        <td>
                            <form action="updatetour.php" method="GET">
                                <button type="submit" name="id" value="<?= $post['id']; ?>"
                                    class="btn btn-danger">EDIT</button>
                            </form>
                        </td>

                        <td>
                            <form action="deletetour.php" method="POST">
                                <button type="submit" name="delete1" value="<?= $post['id']; ?>"
                                    class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                <?php
                }
                ?>

            </table>
        </div>

        <div class="form-container" id="table2">
            <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr>
                        <th>Tour Name</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <?php
                $postQuery = "SELECT * from intiternary ORDER BY id DESC";
                $runPQ = mysqli_query($con, $postQuery);
                while ($post = mysqli_fetch_assoc($runPQ)) {
                ?>
                <tbody>
                    <tr>
                        <td><?= $post['tour_title'] ?> </td>
                        <td><?= $post['holidayctg'] ?> </td>
                        <td>
                            <form action="updateinttour.php" method="GET">
                                <button type="submit" name="id" value="<?= $post['id']; ?>"
                                    class="btn btn-danger">EDIT</button>
                            </form>
                        </td>

                        <td>
                            <form action="deletetour.php" method="POST">
                                <button type="submit" name="delete2" value="<?= $post['id']; ?>"
                                    class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                <?php
                }
                ?>

            </table>
        </div>

        <div class="form-container" id="table3">
            <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr>
                        <th>Tour Name</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <?php
                $postQuery = "SELECT * from activityiternary ORDER BY id DESC";
                $runPQ = mysqli_query($con, $postQuery);
                while ($post = mysqli_fetch_assoc($runPQ)) {
                ?>
                <tbody>
                    <tr>
                        <td><?= $post['activity_title'] ?> </td>
                        <td><?= $post['category'] ?> </td>
                        <td>
                            <form action="updateactivity.php" method="GET">
                                <button type="submit" name="id" value="<?= $post['id']; ?>"
                                    class="btn btn-danger">EDIT</button>
                            </form>
                        </td>

                        <td>
                            <form action="deletetour.php" method="POST">
                                <button type="submit" name="delete3" value="<?= $post['id']; ?>"
                                    class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                <?php
                }
                ?>

            </table>
        </div>

        <div class="form-container" id="table4">
            <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr>
                        <th>Vehicle Name</th>
                        <th>Vehicle Type</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <?php
                $postQuery = "SELECT * from vehicle_details ORDER BY id DESC";
                $runPQ = mysqli_query($con, $postQuery);
                while ($post = mysqli_fetch_assoc($runPQ)) {
                ?>
                <tbody>
                    <tr>
                        <td><?= $post['vehicle_name'] ?> </td>
                        <td><?= $post['vehicle_category'] ?> </td>
                        <td>
                            <form action="updatevehicle.php" method="GET">
                                <button type="submit" name="id" value="<?= $post['id']; ?>"
                                    class="btn btn-danger">EDIT</button>
                            </form>
                        </td>

                        <td>
                            <form action="deletetour.php" method="POST">
                                <button type="submit" name="delete4" value="<?= $post['id']; ?>"
                                    class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                <?php
                }
                ?>

            </table>
        </div>

        <div class="form-container" id="table5">
            <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr>
                        <th>Hotel Name</th>
                        <th>Hotel Place</th>
                        <th>Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <?php
                $postQuery = "SELECT * from hotel_details INNER JOIN hotel WHERE hotel_details.hotel_id = hotel.id ";
                $runPQ = mysqli_query($con, $postQuery);
                while ($post = mysqli_fetch_assoc($runPQ)) {
                ?>
                <tbody>
                    <tr>
                        <td><?= $post['name'] ?> </td>
                        <td><?= $post['hotel_place'] ?> </td>
                        <td><?= $post['price'] ?> </td>
                        <td>
                            <form action="edittour.php" method="GET">
                                <button type="submit" name="id" value="<?= $post['id']; ?>"
                                    class="btn btn-danger">EDIT</button>
                            </form>
                        </td>

                        <td>
                            <form action="deletetour.php" method="POST">
                                <button type="submit" name="delete5" value="<?= $post['id']; ?>"
                                    class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                <?php
                }
                ?>

            </table>
        </div>

    </main>


    <?php include 'includes/links.php'; ?>


</body>

</html>