<?php
$page = 'product';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

    <div class="container">
        <h2>Product List</h2>
        <?php echo $data['messages']; ?>
        <a href="/product/add" class="btn btn-primary pull-right" role="button">Add a product</a>
        <div class="pagination">
            <?php echo $data['pagination_links'];?>
        </div>
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
                foreach ($data['products'] as $product) {
                    include __DIR__ . '/inc/productRecord.php';
                }
                ?>
            </tbody>
        </table>
    </div>

<?php require_once __DIR__ . '/inc/footer.php'; ?>
