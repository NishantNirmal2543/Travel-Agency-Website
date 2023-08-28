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

    <h2>Manage Posts</h2>
    <table class="table table-striped table-advance table-hover">
      <thead>
        <tr>
          <th>Title</th>
          <th>Posted On</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <?php
      $postQuery = "SELECT * from blog ORDER BY id DESC";
      $runPQ = mysqli_query($con, $postQuery);
      while ($post = mysqli_fetch_assoc($runPQ)) {
      ?>
        <tbody>
          <tr>
            <td><?= $post['title'] ?> </td>
            <td><?= date("Y-m-d h:ia", strtotime($post['created_at'])) ?></td>
            <td>
              <form action="editblog.php" method="GET">
                <button type="submit" name="id" value="<?= $post['id']; ?>" class="btn btn-danger">EDIT</button>
              </form>
            </td>

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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>