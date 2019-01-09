<tr>
    <td><?php echo htmlspecialchars($datum['id']) ?></td>
    <td><?php echo htmlspecialchars($datum['group_name']) ?></td>
    <td><?php echo htmlspecialchars($datum['username']) ?></td>
    <td class="center-align">
        <a class="del" href="/group/<?php echo $datum['id']?>">List</a>
    </td>
    <td class="center-align action">
        <a class="del" href="/group/remove/<?php echo $datum['id']?>">Remove</a>
    </td>
</tr>