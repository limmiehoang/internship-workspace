<div class="form-group">
    <label for="product-name" class="col-sm-2 control-label">Name your product</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="product-name" name="product_name" placeholder="Product Name" value="">
    </div>
</div>
<div class="form-group">
    <label for="category" class="col-sm-2 control-label">Category</label>
    <div class="col-sm-10">
        <select class="form-control" id="category">
            <?php //put options ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="description" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
        <textarea name="description" class="form-control" rows="5" placeholder="Description of the product"></textarea>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Add</button>
    </div>
</div>
