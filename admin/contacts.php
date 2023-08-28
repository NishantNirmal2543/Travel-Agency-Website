<?php

session_start();

if (!isset($_SESSION['email'])) {
    header('location:login.php');
}
?>
<?php include 'includes/header.php'; ?>

<body>
    <?php include('../includes/message.php'); ?>

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

        <h2>Enquiries</h2>
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Subject</th>
                </tr>
            </thead>
            <?php
            $postQuery = "SELECT * from contact ORDER BY id DESC";
            $runPQ = mysqli_query($con, $postQuery);
            while ($post = mysqli_fetch_assoc($runPQ)) {
            ?>
                <tbody>
                    <tr>
                        <td><?= $post['name'] ?> </td>
                        <td><?= $post['email'] ?> </td>
                        <td><?= $post['message'] ?> </td>
                        <td><?= $post['subject'] ?> </td>
                        <td>
                            <form action="deleteblog.php" method="POST">
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