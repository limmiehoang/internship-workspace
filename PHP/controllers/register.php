<?php

class Register extends Controller
{
    function __construct() {
        parent::__construct();
    }
    function index() {
        $response = $this->display_errors();
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

        $this->redirect('/');
    }
}