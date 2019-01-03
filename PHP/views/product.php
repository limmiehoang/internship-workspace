<?php
$page = 'product';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

    <div class="container">
        <h2>Product List</h2>
        <a href="/PHP/views/addProduct.php" class="btn btn-primary pull-right" role="button">Add a product</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Product</th>
                <th>Owner</th>
                <th>Category</th>
                <th>Group</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php //put records ?>
            </tbody>
        </table>
    </div>

<?php require_once __DIR__ . '/inc/footer.php'; ?>
