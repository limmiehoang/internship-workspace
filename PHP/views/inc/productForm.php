<div class="form-group">
    <label for="product-name" class="col-sm-2 control-label">Name your product (*)</label>
    <div class="col-sm-10">
        <input  type="text" class="form-control" id="product-name" name="product_name" placeholder="Product Name"
                value="<?php echo (isset($data['item'])) ? htmlspecialchars($data['item']['product_name']) : ''?>"
                required>
    </div>
</div>
<div class="form-group">
    <label for="category" class="col-sm-2 control-label">Category (*)</label>
    <div class="col-sm-10">
        <select class="form-control" id="category" name="category">
            <?php foreach ($data['categories'] as $category) { ?>
                <option value='<?php echo $category['id'] ?>' <?php if (isset($data['item'])) echo ($data['item']['category_id'] == $category['id']) ? "selected" : ""?>>
                    <?php echo htmlspecialchars($category['category']) ?>
                </option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="description" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
        <textarea id="description" name="description" class="form-control" rows="5" placeholder="Description of the product"><?php if (isset($data['item'])) echo htmlspecialchars($data['item']['description'])?></textarea>
    </div>
</div>
