<div class="form-group">
    <label for="group-name" class="col-sm-2 control-label">Name your group</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="group-name" name="group_name" placeholder="Group Name" value="">
    </div>
</div>
<div class="form-group">
    <label for="leader" class="col-sm-2 control-label">Choose a leader</label>
    <div class="col-sm-10">
        <select class="form-control" id="leader" name="leader" required>
            <option value="" disabled selected>Choose a leader</option>
            <?php foreach ($data['users'] as $user) { ?>
                <option value='<?php echo $user['id'] ?>'>
                    <?php echo htmlspecialchars($user['username']) ?>
                </option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="members" class="col-sm-2 control-label">Add some people</label>
    <div class="col-sm-10">
        <?php foreach ($data['users'] as $user) { ?>
        <div class="checkbox">
            <label><input type="checkbox" name="members[]" value='<?php echo $user['id'] ?>'>
                <?php echo htmlspecialchars($user['username']) ?>
            </label>
        </div>
        <?php } ?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Add</button>
    </div>
</div>
