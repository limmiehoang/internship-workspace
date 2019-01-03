<?php
$page = 'product';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

    <div class="container">
        <div class="well">
            <h2>Add a product</h2>
            <?php // print display_errors(); ?>
            <form class="form-horizontal" method="post" action="../controllers/addProduct.php">
                <?php include __DIR__ . '/inc/productForm.php' ?>
            </form>
        </div>
    </div>

<?php
require_once __DIR__ . '/inc/footer.php';