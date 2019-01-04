<?php

class Login extends Controller
{
    function __construct() {
        parent::__construct();
    }
    function index() {
        $this->redirect('/');
    }
    function doLogin() {
        require 'models/User.php';
        $model = new User();

        $input_username = $this->request()->get('username');
        $user = $model->findUserByUsername($input_username);
        if (empty($user)) {
            $this->redirect('/login');
        }

        $input_password = $this->request()->get('password');
        if (!password_verify($input_password, $user['password'])) {
            $this->redirect('/login');
        }

        $expTime = time() + 3600; // 1 hour

        $jwt = \Firebase\JWT\JWT::encode([
                'iss' => $this->request()->getBaseUrl(),
                'sub' => "{$user['id']}",
                'exp' => $expTime,
                'iat' => time(),
                'nbf' => time(),
                'is_admin' => true
                ], getenv("SECRET_KEY"), 'HS256');

        $accessToken = new Symfony\Component\HttpFoundation\Cookie('access_token', $jwt, $expTime, '/', getenv('COOKIE_DOMAIN'));
        $this->redirect('/', ['cookies' => [$accessToken]]);
    }
}