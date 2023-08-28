<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include('dbcon.php');

  $name = mysqli_real_escape_string($con, $_POST['name']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $destination = mysqli_real_escape_string($con, $_POST['destination']);
  $travelmonth = mysqli_real_escape_string($con, $_POST['travelmonth']);
  $message = mysqli_real_escape_string($con, $_POST['message']);

  $insertquery = "INSERT INTO booking (name, mobile, email, destination, month, message)
                            VALUES('$name', '$mobile', '$email', '$destination', '$travelmonth', '$message')";

  $iquery = mysqli_query($con, $insertquery);


  if ($iquery) {
?>
<script>
alert("Inserted Successfully");
location.replace("index.php");
</script>
<?php
  } else {
  ?>
<script>
alert("Not inserted");
</script>
<?php
  }
}

?>





<!-- Button trigger modal -->
<button type="button " class="btn bookbtn " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Book Now
</button>

<!-- Modal -->
<div class="modal fade booknow" style="color:black;" id="staticBackdrop" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog centered">
        <div class="col-lg-5 col-md-4 col-sm-0 ">
            <div class="formimg">
                <img src="images/others/formimg.webp" class="img-fluid float-left mr-3">
            </div>
        </div>
        <div class="col-lg-7 col-md-8 col-sm-12">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Welcome to Sacred India Tours & Travels</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">

                        <div class="form-outline mb-4">
                            <label>Name: </label>
                            <input type="text" name="name" class="form-control" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label>Phone No: </label>
                            <input type="mobile" name="mobile" class="form-control" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label>Email ID: </label>
                            <input type="email" name="email" class="form-control" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label>Travel Destination: </label>
                            <input type="text" name="destination" class="form-control" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label>Travel Month: </label>
                            <select class="form-control form-select" name="travelmonth">
                                <option vlaue="Mar-2023">Mar-2023</option>
                                <option vlaue="Mar-2023">Apr-2023</option>
                                <option vlaue="Mar-2023">May-2023</option>
                                <option vlaue="Mar-2023">Jun-2023</option>
                                <option vlaue="Mar-2023">Jul-2023</option>
                                <option vlaue="Mar-2023">Aug-2023</option>
                            </select>
                        </div>

                        <div class="form-outline mb-4">
                            <label>Message: </label>
                            <textarea class="form-control form-textarea" name="message" rows="2" cols="40"></textarea>
                        </div>

                        <div class="modal-footer justify-content-center">
                            <button type="submit" name="submit" class="btn submit_btn"
                                style="padding:5px;">Submit</button>
                        </div>
                    </form>
                    <div class="modal-footer justify-content-center">
                        <p> Call us at: <a href="tel:+91 9507505612" style="text-decoration: none;"> +91
                                9507505612</a></i>
                            <br>
                            Or Whatsapp Us<a
                                href="https://api.whatsapp.com/send?phone=+91 9507505612&text=Hello%2C%20I%20have%20a%20question."
                                target="_blank" style="text-decoration: none;" class="whatsapp-logo"> <i
                                    class="fa-brands fa-whatsapp whatsapp-icon" style="font-size:20px;"></i></a>
                        </p>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>