<tr>
    <td><?php echo htmlspecialchars($datum['id']) ?></td>
    <td><?php echo htmlspecialchars($datum['product_name']) ?></td>
    <td class="role<?php echo htmlspecialchars($datum['role_id']) ?>"><?php echo htmlspecialchars($datum['username']) ?></td>
    <td><?php echo htmlspecialchars($datum['category']) ?></td>
    <td><?php echo htmlspecialchars($datum['group_name']) ?></td>
    <td>
        <a href="">View</a>
        <a href="/product/edit/<?php echo $datum['id']?>">Edit</a>
        <a class="del" href="/product/remove/<?php echo $datum['id']?>">Remove</a>
    </td>
</tr>