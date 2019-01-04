<?php

class Register extends Controller
{
    function __construct() {
        parent::__construct();
    }
    function index() {
        $this->view->render('register');
    }
    function doRegister() {
        require 'models/User.php';
        $model = new User();

        $username = $this->request()->get('username');
        $password = $this->request()->get('password');

        $user = $model->findUserByUsername($username);
        if (!empty($user)) {
            $this->redirect('/register');
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $user = $model->createUser($username, $hashed);

        $this->redirect('/');
    }
}