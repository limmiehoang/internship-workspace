<tr>
    <td><?php echo htmlspecialchars($group['id']) ?></td>
    <td><?php echo htmlspecialchars($group['name']) ?></td>
    <td><?php echo htmlspecialchars($group['username']) ?></td>
    <td class="center-align">
        <a href="/group/detail/<?php echo $group['id']?>">List</a>
    </td>
</tr>