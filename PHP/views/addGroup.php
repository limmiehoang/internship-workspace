<?php
$page = 'group';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

    <div class="container">
        <div class="well">
            <h2>Add a group</h2>
            <p><em>(*) This field is required</em></p>
            <?php echo $data['messages'];?>
            <form id="group-form" class="form-horizontal" method="post" action="/group/addGroup" autocomplete="off">
                <?php include __DIR__ . '/inc/groupForm.php' ?>
            </form>
        </div>
    </div>

<?php require_once __DIR__ . '/inc/footer.php'; ?>