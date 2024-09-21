<?php
include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
require_once '../../config/database.php';
require_once '../../config/functions.php';

$select = "SELECT * FROM customers";
$allData = mysqli_query($conn, $select);
$counter = 0;

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $select = "SELECT * FROM customers where id =$id";

    $oneRow = mysqli_query($conn, $select);
    //  Return one Row

    $numRows  =  mysqli_num_rows($oneRow);

    $data = mysqli_fetch_assoc($oneRow);


    $oldImage = $data['image'];
    unlink("./upload/$oldImage");



    $delete = "DELETE FROM customers where id  =$id";
    $d = mysqli_query($conn, $delete);
    $allData = mysqli_query($conn, $select);
}

?>

<div class="container col-9 mt-3">
    <div class="card">
        <form method="post" action="./search.php">
            <div class="row">
                <div class="col-9">
                    <div class="form-group">
                        <input type="text" id="myInput" name="searchValue" placeholder="Customer Name" class="form-control">
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-grid">
                        <button name="searchBtn" class="mt-2 btn btn-info"> Search </button>
                    </div>
                </div>
            </div>


        </form>
        <div class="card-body">
            <h6 class="mt-3"> List All Customers

                <a class="float-end btn btn-info" href="./create.php">Create</a>
            </h6>
            <table id="myTable" class="table mt-5">
                <tr>
                    <th>N#</th>
                    <th>Full Name</th>
                    <th>Email </th>
                    <th colspan="2">Action</th>
                </tr>
                <?php foreach ($allData as $item): ?>
                    <tr>
                        <th> <?= ++$counter  ?> </th>
                        <th> <?= $item['full_name']  ?> </th>
                        <th> <?= $item['email']  ?> </th>
                        <th> <img width="40" src="upload/<?= $item['image'] ?>" alt=""> </th>
                        <th> <a href="./edit.php?edit=<?= $item['id'] ?>"><i class="text-info fa-solid fa-pen-to-square"></i></a> </th>
                        <th> <a href="index.php?delete=<?= $item['id'] ?>"><i class="text-danger fa-solid fa-trash-can"></i></a> </th>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>




<?php
include_once '../../shared/script.php';
?>