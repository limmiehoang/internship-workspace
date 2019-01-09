<tr>
    <td><?php echo htmlspecialchars($group['id']) ?></td>
    <td><?php echo htmlspecialchars($group['group_name']) ?></td>
    <td><?php echo htmlspecialchars($group['username']) ?></td>
    <td class="center-align">
        <a href="/group/<?php echo $group['id']?>">List</a>
    </td>
    <td class="center-align action">
        <a href="/group/edit/<?php echo $group['id']?>">Edit</a>
        <a class="del" href="/group/remove/<?php echo $group['id']?>">Delete</a>
    </td>
</tr>