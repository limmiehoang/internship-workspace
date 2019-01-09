<tr>
    <td><?php echo htmlspecialchars($product['id']) ?></td>
    <td><?php echo htmlspecialchars($product['product_name']) ?></td>
    <td class="role<?php echo htmlspecialchars($product['role_id']) ?>"><?php echo htmlspecialchars($product['username']) ?></td>
    <td><?php echo htmlspecialchars($product['category']) ?></td>
    <td><?php echo htmlspecialchars($product['group_name']) ?></td>
    <td class="center-align action">
        <a href="">Detail</a>
        <?php if ($product['write_permission']) { ?>
        <a href="/product/edit/<?php echo $product['id']?>">Edit</a>
        <a class="del" href="/product/remove/<?php echo $product['id']?>">Delete</a>
        <?php } ?>
    </td>
</tr>