<?php
$page = 'register';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

    <div class="container">
        <div class="well col-sm-6 col-sm-offset-3">
            <form class="form-signin" method="post" action="../controllers/doRegister.php">
                <h2 class="form-signin-heading">Registration</h2>
                <?php //print display_errors(); ?>
                <label for="input-username" class="sr-only">Username</label>
                <input type="username" id="input-username" name="username" class="form-control" placeholder="Username" required autofocus>
                <br>
                <label for="input-password" class="sr-only">Password</label>
                <input type="password" id="input-password" name="password" class="form-control" placeholder="Password" required>
                <br>
                <label for="confirm-password" class="sr-only">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                <br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
            </form>
        </div>
    </div>

<?php require_once __DIR__ . '/inc/footer.php'; ?>