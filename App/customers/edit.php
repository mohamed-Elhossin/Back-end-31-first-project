<?php
include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
require_once '../../config/database.php';
require_once '../../config/functions.php';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $select = "SELECT * FROM customers where id =$id";

    $oneRow = mysqli_query($conn, $select);
    //  Return one Row

    $numRows  =  mysqli_num_rows($oneRow);
    if ($numRows == 1) {
        $data = mysqli_fetch_assoc($oneRow);
    } else {
        header("location: /round31/error404.php");
    }



    if (isset($_POST['send'])) {
        $name = $_POST['full_name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        // Image Code 
        if (empty($_FILES['MyImage']['name'])) {
            $image_name =  $data['image'];
        } else {
            $oldImage = $data['image'];
            unlink("./upload/$oldImage");
            $image_name =  rand(0, 255) . rand(0, 255)  .     $_FILES['MyImage']['name'];
            $tmp_name =  $_FILES['MyImage']['tmp_name'];
            $location = "./upload/$image_name";
            move_uploaded_file($tmp_name, $location);
        }


        $insert = "UPDATE customers SET full_name= '$name', email = '$email', gender = '$gender', phone = '$phone' ,  image = '$image_name' where id =$id";
        $i = mysqli_query($conn, $insert);
        redirect('customers/index.php');
    }
} else {
    header("location: /round31/error404.php");
}



?>

<div class="container col-9 mt-3">
    <div class="card">

        <div class="card-body">
            <h6 class="mt-3"> Edit Customer
                <a class="float-end btn btn-info" href="./index.php">Back</a>
            </h6>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Customer Name</label>
                    <input type="text" value="<?= $data['full_name'] ?>" class="form-control" name="full_name">
                </div>
                <div class="form-group">
                    <label for="">Customer email</label>
                    <input type="email" value="<?= $data['email'] ?>" class="form-control" name="email">
                </div>
                <div class="form-group ">
                    <label for="">Customer gender</label>
                    <?php if ($data['gender'] == "Male"): ?>
                        <input type="radio" value="Male" checked name="gender">
                        Male
                        <input class="my-3 " type="radio" value="Female" name="gender">
                        Female
                    <?php else: ?>
                        <input type="radio" value="Male" name="gender">
                        Male
                        <input class="my-3 " checked type="radio" value="Female" name="gender">
                        Female
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="">Customer phone</label>
                    <input type="phone" value="<?= $data['phone'] ?>" class="form-control" name="phone">
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