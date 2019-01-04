<?php
require_once __DIR__ . '/inc/head.php';
?>

    <div class="main-wrapper">
        <!-- Main -->
        <div class="login-wrapper">
            <!-- Welcome image -->
            <div class="welcome-img main-col">
                <img src="/public/images/sign-in.png" alt="">
            </div>
            <!-- Login -->
            <div class="main-col">
                <div class="form-wrapper">
                    <!-- Title -->
                    <header class="my-row">
                        <div>
                            <h2>Sign in</h2>
                        </div>
                        <div>
                            or
                            <a href="/register">register</a>
                        </div>
                    </header>
                    <?php //print display_errors(); ?>
                    <!-- Sign in with google -->
                    <div class="google-btn">
                        <button class="btn">
                            Sign in with Google
                        </button>
                    </div>
                    <div class="or-hr">
                        or
                    </div>
                    <!-- Signin form -->
                    <div>
                        <form action="/login/doLogin" method="POST">
                            <p><input class="text-input" type="text" id="username" name="username" placeholder="Username" required></p>
                            <p><input class="text-input" type="password" id="password" name="password" placeholder="Password" required></p>
                            <p><small>This page is protected by reCAPTCHA, and subject to the Google <a href="">Privacy Policy</a> and <a href="">Terms of service</a>.</small></p>
                            <div class="submit my-row">
                                <div class="checkbox"><input type="checkbox" name="remember_me" id="cbox"><label for="cbox"><span>Remember me</span></label></div>
                                <button class="btn" type="submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                    <a href="">Forgot your password?</a>
                </div>
            </div>
        </div>
    </div>

<?php require_once __DIR__ . '/inc/footer.php'; ?>