    <option value="">All</option>
    <?php foreach ($data as $item) { ?>
    <option value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
    <?php } ?>