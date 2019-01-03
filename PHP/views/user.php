<?php
$page = 'user';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

    <div class="container">
        <h2>User List</h2>
        <a href="/PHP/views/addUser.php" class="btn btn-primary pull-right" role="button">Add a user</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Group</th>
                <th>Role</th>
            </tr>
            </thead>
            <tbody>
            <?php //put records ?>
            </tbody>
        </table>
    </div>

<?php require_once __DIR__ . '/inc/footer.php';
