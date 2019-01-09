<?php
$page = 'group';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

    <div class="container">
        <h2>Detail</h2>
        <?php echo $data['messages'];?>
        <label for="group-name" class="col-sm-2 control-label">Group Name</label>
        <div class="col-sm-10">
            <p id="group-name"><?php echo htmlspecialchars($data['group']['group_name']);?></p>
        </div>
        <label for="leader" class="col-sm-2 control-label">Leader</label>
        <div class="col-sm-10">
            <p id="leader"><?php echo htmlspecialchars($data['leader']['username']);?></p>
        </div>
        <label for="members" class="col-sm-2 control-label">Members</label>
        <div class="col-sm-10">
            <ul id="members" class="user-bullet">
            <?php foreach ($data['members'] as $member) { ?>
                <li><?php echo htmlspecialchars($member['username']) ?></li>
            <?php } ?>
            </ul>
        </div>
    </div>

<?php require_once __DIR__ . '/inc/footer.php'; ?>