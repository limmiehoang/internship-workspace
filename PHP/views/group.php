<?php
$page = 'group';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

    <div class="container">
        <h2>Group List</h2>
        <a href="/group/add" class="btn btn-primary pull-right" role="button">Add a group</a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Group</th>
                <th>Leader</th>
                <th>Members</th>
                <th class="center-align">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $datum) {
                include __DIR__ . '/inc/groupRecord.php';
            }
            ?>
            </tbody>
        </table>
    </div>

<?php require_once __DIR__ . '/inc/footer.php';
