<?php
$page = 'product';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

    <div class="container">
        <h2>Product List</h2>
        <a href="/product/add" class="btn btn-primary pull-right" role="button">Add a product</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Product</th>
                <th>Owner</th>
                <th>Category</th>
                <th>Group</th>
                <th class="center-align">Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $datum) {
                    include __DIR__ . '/inc/productRecord.php';
                }
                ?>
            </tbody>
        </table>
    </div>

<?php require_once __DIR__ . '/inc/footer.php'; ?>
