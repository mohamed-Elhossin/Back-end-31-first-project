<?php
include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
require_once '../../config/database.php';
require_once '../../config/functions.php';
if (isset($_POST['send'])) {
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    // Image Code 

    $image_name =  rand(0,255) . rand(0,255)  .     $_FILES['MyImage']['name'];
   
    $tmp_name =  $_FILES['MyImage']['tmp_name'];
    $location = "./upload/$image_name";
    move_uploaded_file($tmp_name, $location );



    $insert = "INSERT INTO customers VALUES (null , '$name','$email','$gender','$phone' , '$image_name')";
    $i = mysqli_query($conn, $insert);
    redirect('customers/index.php');
}

 

?>

<div class="container col-9 mt-3">


    <div class="card">
        <div class="card-body">
            <h6 class="mt-3"> Create Customer
                <a class="float-end btn btn-info" href="./index.php">Back</a>
            </h6>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Customer Name</label>
                    <input type="text" class="form-control" name="full_name">
                </div>
                <div class="form-group">
                    <label for="">Customer email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group ">
                    <label for="">Customer gender</label>
                    <input type="radio" value="Male" name="gender">
                    Male
                    <input class="my-3 " type="radio" value="Female" name="gender">
                    Female
                </div>
                <div class="form-group">
                    <label for="">Customer phone</label>
                    <input type="tel" class="form-control" name="phone">
                </div>
                <div class="form-group">
                    <label for="">Customer Image </label>
                    <input type="file" accept="image/*" class="form-control" name="MyImage">
                </div>
                <div class="d-grid">
                    <button class="btn btn-info w-50 mx-auto" name="send">Submit </button>
                </div>
            </form>
        </div>
    </div>
</div>




<?php
include_once '../../shared/script.php';
?>