<?php
$page = 'group';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

    <div class="container">
        <h2>Group List</h2>
        <a href="/PHP/views/addGroup.php" class="btn btn-primary pull-right" role="button">Add a group</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Group</th>
                <th>Leader</th>
                <th>Members</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php //put records ?>
            </tbody>
        </table>
    </div>

<?php require_once __DIR__ . '/inc/footer.php';
