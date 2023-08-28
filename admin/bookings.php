<?php

session_start();

if (!isset($_SESSION['email'])) {
    header('location:login.php');
}
?>
<?php include 'includes/header.php'; ?>

<body>
    <?php include '../dbcon.php'; ?>
    <?php include 'includes/navbar.php'; ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <h2>Bookings</h2>
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Destination</th>
                    <th>Month</th>
                    <th>Message</th>
                    <th>Booked On</th>
                </tr>
            </thead>
            <?php
            $postQuery = "SELECT * from booking ORDER BY id DESC";
            $runPQ = mysqli_query($con, $postQuery);
            while ($post = mysqli_fetch_assoc($runPQ)) {
            ?>
                <tbody>
                    <tr>
                        <td><?= $post['name'] ?> </td>
                        <td><?= $post['mobile'] ?> </td>
                        <td><?= $post['email'] ?> </td>
                        <td><?= $post['destination'] ?> </td>
                        <td><?= $post['month'] ?> </td>
                        <td><?= $post['message'] ?> </td>
                        <td><?= date("Y-m-d h:ia", strtotime($post['created_at'])) ?></td>

                        <td>
                            <form action="deletebooking.php" method="POST">
                                <button type="submit" name="delete" value="<?= $post['id']; ?>" class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            <?php
            }
            ?>

        </table>

    </main><!-- End #main -->

    <?php include 'includes/links.php'; ?>


</body>

</html>