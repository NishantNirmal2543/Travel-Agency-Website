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
  include('dbcon.php');
  ?>
  <?php include 'includes/whatsapp.php'; ?>

  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('dbcon.php');

    $message = mysqli_real_escape_string($con, $_POST['message']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);


    $insertquery = "INSERT INTO contact (message, name, email, subject)
                            VALUES('$message', '$name',  '$email', '$subject')";

    $iquery = mysqli_query($con, $insertquery);


    if ($iquery) {
  ?>
      <script>
        alert("Message Sent Successfully");
        location.replace("contact.php");
      </script>
    <?php
    } else {
    ?>
      <script>
        alert("Not Sent");
      </script>
  <?php
    }
  }

  ?>
  <section class="about-header" style="background-image: url(images/bg/contact.jpg);">

    <div class="auto-container">
      <div class="content-box">
        <h1>Contact Us</h1>
      </div>
    </div>

  </section>

  <section class="contactus">
    <div class="row">
      <div class="col-lg-8 col-sm-12">
        <div class="contact-details ">
          <div class="title">
            <h3>Contact Us</h3>
          </div>
          <div class="contact-form">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
              <div class="form-outline mb-4">
                <label for="message">Message:</label>
                <textarea type="message" name="message" class="form-control" required></textarea>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <label for="name">Name:</label>
                    <input type="name" name="name" class="form-control" required />
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" required />
                  </div>
                </div>
              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <label for="subject">Subject:</label>
                <input type="subject" name="subject" class="form-control" required />
              </div>

              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                Send
              </button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-sm-12">
        <div class="contact-info">
          <div class="addr">
            <p><img src="images/logo/location.png">
              Varanasi (Head Office)
              Panchkoshi Road, Pandeypur,
              Varanasi - 221002
            </p>
          </div>
          <div class="addr">
            <p><img src="images/logo/call.png">
              +91 9507505612
            </p>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3605.6967956777803!2d83.0005556!3d25.3479535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398e2f7e4d2c0ebb%3A0x4749a4ddc040bbe2!2sSacred%20India%20Tour%20%26%20Travels!5e0!3m2!1sen!2sin!4v1677848219241!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </section>





  <?php include_once('includes/footer.php'); ?>
</body>

</html>