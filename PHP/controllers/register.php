<?php

class Register extends Controller
{
    function __construct() {
        parent::__construct();
    }
    function index() {
        $response = $this->display_messages();
        $this->view->render('register', $response);
    }
    function doRegister() {
        global $session;

        require 'models/UserModel.php';
        $model = new UserModel();

        $inputUsername = $this->request()->get('username');
        $inputUsername = filter_var($inputUsername, FILTER_SANITIZE_STRING);
        $inputUsername = trim($inputUsername);

        $inputPassword = $this->request()->get('password');
        $inputPassword = filter_var($inputPassword, FILTER_SANITIZE_STRING);
        $inputPassword = trim($inputPassword);

        if (strlen($inputUsername) < 5 || strlen($inputPassword) < 8) {
            $session->getFlashBag()->add('error', 'Please fill in required fields with enough characters.');
            $this->redirect('/register');
        }

        $user = $model->findUserByUsername($inputUsername);
        if (!empty($user)) {
            $session->getFlashBag()->add('error', 'Username already exists.');
            $this->redirect('/register');
        }

        $hashed = password_hash($inputPassword, PASSWORD_DEFAULT);

        $user = $model->createUser($inputUsername, $hashed);

        $session->set('username', $user['username']);
        $expTime = time() + 3600; // 1 hour
        $jwt = \Firebase\JWT\JWT::encode([
            'iss' => $this->request()->getBaseUrl(),
            'sub' => "{$user['id']}",
            'exp' => $expTime,
            'iat' => time(),
            'nbf' => time(),
            'role' => "{$user['role_id']}",
            'group' => "{$user['group_id']}",
        ], getenv("SECRET_KEY"), 'HS256');

        $accessToken = new Symfony\Component\HttpFoundation\Cookie('access_token', $jwt, $expTime, '/', getenv('COOKIE_DOMAIN'));

        $session->getFlashBag()->add('success', 'You have successfully registered and logged in.');
        $this->redirect('/', ['cookies' => [$accessToken]]);
    }
}