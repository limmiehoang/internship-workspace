<?php
$page = 'user';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

    <div class="container">
        <div class="well">
            <h2>Add a user</h2>
            <?php // print display_errors(); ?>
            <form class="form-horizontal" method="post" action="../controllers/addUser.php">
                <?php include __DIR__ . '/inc/userForm.php' ?>
            </form>
        </div>
    </div>

<?php require_once __DIR__ . '/inc/footer.php'; ?>