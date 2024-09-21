<?php
include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
require_once '../../config/database.php';
require_once '../../config/functions.php';


// $select = "SELECT * FROM `alljoindata`";
$select = "SELECT * FROM `orders`";

$allData = mysqli_query($conn, $select);

if (isset($_GET['show'])) {
    $id = $_GET['show'];
    $select = "SELECT * FROM alljoindata where id =$id";

    $oneRow = mysqli_query($conn, $select);
    //  Return one Row

    $numRows  =  mysqli_num_rows($oneRow);
    if ($numRows == 1) {
        $data = mysqli_fetch_assoc($oneRow);
    } else {
        header("location: /round31/error404.php");
    }
} else {
    header("location: /round31/error404.php");
}

?>

<div class="container col-9 mt-3">
    <div class="card">

        <div class="card-body">
            <h6 class="mt-3"> List One Orders <?= $data['id'] ?>

                <a class="float-end btn btn-info" href="./create.php">Create</a>
            </h6>
            <hr>
            <h6> amount : <?= $data['amount'] ?></h6>
            <hr>
            <h6> product_name : <?= $data['product_name'] ?></h6>
            <hr>
            <h6> price : <?= $data['price'] ?></h6>
            <hr>
            <h6> full_name : <?= $data['full_name'] ?></h6>
            <hr>
            <h6> email : <?= $data['email'] ?></h6>
            <hr>
            <h6> phone : <?= $data['phone'] ?></h6>
            <hr>
        </div>
    </div>
</div>




<?php
include_once '../../shared/script.php';
?>