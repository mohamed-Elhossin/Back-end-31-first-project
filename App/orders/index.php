<?php
include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
require_once '../../config/database.php';
require_once '../../config/functions.php';


// $select = "SELECT * FROM `alljoindata`";
$select = "SELECT * FROM `orders`";

$allData = mysqli_query($conn, $select);



$counter = 0;

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = "DELETE FROM orders where id  =$id";
    $d = mysqli_query($conn, $delete);
    $allData = mysqli_query($conn, $select);
}

?>

<div class="container col-9 mt-3">
    <div class="card">

        <div class="card-body">
            <h6 class="mt-3"> List All Orders

                <a class="float-end btn btn-info" href="./create.php">Create</a>
            </h6>
            <table class="text-center table mt-5">
                <tr>
                    <th>N#</th>
                    <th>amount</th>

                    <th colspan="3">Action</th>
                </tr>
                <tr>
                    <?php foreach ($allData as $item): ?>
                        <th><?= ++$counter ?></th>
                        <th><?= $item['amount']  ?></th>
                        <th> <a href="./show.php?show=<?= $item['id'] ?>" ><i class="text-primary fa-solid fa-eye"></i> </a> </th>
                        <th> <a href="./edit.php?edit=<?= $item['id'] ?>"><i class="text-warning fa-solid fa-pen-to-square"></i></a> </th>
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