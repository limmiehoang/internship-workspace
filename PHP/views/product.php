<?php
$page = 'product';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

    <div class="container">
        <h2>Product List</h2>
        <?php echo $data['messages']; ?>
        <a href="/product/add" class="btn btn-primary pull-right" role="button">Add a product</a>
        <div class="pagination">
            <?php echo $data['pagination_links'];?>
        </div>
        <div id="filter-panel">
            <label for="filter-category">Filter by: </label>
            <select id="filter-category">
                <option value="">Category</option>
                <?php foreach ($data['categories'] as $item) { ?>
                    <option value="<?php echo $item['id'];?>"><?php echo $item['category'];?></option>
                <?php } ?>
            </select>
            <select id="filter-group">
                <option value="">Group</option>
                <?php foreach ($data['groups'] as $item) { ?>
                    <option value="<?php echo $item['id'];?>"><?php echo $item['group_name'];?></option>
                <?php } ?>
            </select>
        </div>
        <table id="product-table" class="table table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Product</th>
                <th>Owner</th>
                <th>Category</th>
                <th>Group</th>
                <th class="center-align">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php include __DIR__ . '/inc/productTable.php'; ?>
            </tbody>
        </table>
    </div>

<?php require_once __DIR__ . '/inc/footer.php'; ?>
