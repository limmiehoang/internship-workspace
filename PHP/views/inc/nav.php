<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Product Management</a>
        </div>
        <ul class="nav navbar-nav">
            <li <?php echo ($page == 'product') ? "class='active'" : ""; ?>>
                <a href="/product">Product</a>
            </li>
            <li <?php echo ($page == 'group') ? "class='active'" : ""; ?>>
                <a href="/group">Group</a>
            </li>
            <li <?php echo ($page == 'user') ? "class='active'" : ""; ?>>
                <a href="/user">User</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li <?php echo ($page == 'register') ? "class='active'" : ""; ?>>
                <a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Log Out</a>
            </li>
        </ul>
    </div>
</nav>