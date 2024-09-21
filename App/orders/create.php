<?php
include_once '../../shared/head.php';
include_once '../../shared/navbar.php';
require_once '../../config/database.php';
require_once '../../config/functions.php';
// Get All Custoemrs
$customers = "SELECT * FROM customers";
$customersData = mysqli_query($conn, $customers);
// Get All Products
$products = "SELECT * FROM products";
$productsData = mysqli_query($conn, $products);


if (isset($_POST['send'])) {
    $amount = $_POST['amount'];
    $product = $_POST['product'];
    $customer = $_POST['customer'];

    $insert = "INSERT INTO  orders values(null , $amount ,$customer,$product)";
    $i  = mysqli_query($conn, $insert);

    redirect('orders/index.php');
}

?>

<div class="container col-9 mt-3">
    <div class="card">

        <div class="card-body">
            <h6 class="mt-3"> Create Orders
                <a class="float-end btn btn-info" href="./index.php">Back</a>
            </h6>
            <form method="post">
                <div class="form-group">
                    <label for="">Order Amount </label>
                    <input type="number" class="form-control" name="amount">
                </div>
                <div class="form-group">
                    <label for="">Customer Name </label>
                    <select class="form-control" name="customer">
                        <?php foreach ($customersData as $item): ?>
                            <option value="<?= $item['id']  ?>"><?= $item['full_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Product Name </label>
                    <select id="price" class="form-control" name="product">
                        <?php foreach ($productsData as $item): ?>
                            <option value="<?= $item['id'] ?>"><?= $item['product_name']  . "Price" . $item['price'] ?> </option>
                        <?php endforeach; ?>
                    </select>


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