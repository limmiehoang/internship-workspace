<table class="table table-hover">
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
    <?php foreach ($data['products'] as $product) {
        include __DIR__ . '/productRecord.php';
    } ?>
    </tbody>
</table>

<div class="pagination">
    <?php echo $data['pagination_links'];?>
</div>

