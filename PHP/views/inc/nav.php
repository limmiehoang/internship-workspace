<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Product Management</a>
        </div>
        <ul class="nav navbar-nav">
            <li <?php echo ($page == 'product') ? "class='active'" : ""; ?>>
                <a href="/PHP/views/product.php">Product</a>
            </li>
            <li <?php echo ($page == 'group') ? "class='active'" : ""; ?>>
                <a href="/PHP/views/group.php">Group</a>
            </li>
            <li <?php echo ($page == 'user') ? "class='active'" : ""; ?>>
                <a href="/PHP/views/user.php">User</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li <?php echo ($page == 'register') ? "class='active'" : ""; ?>>
                <a href="/PHP/views/register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
            </li>
            <li <?php echo ($page == 'login') ? "class='active'" : ""; ?>>
                <a href="/PHP/views/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
            </li>
        </ul>
    </div>
</nav>