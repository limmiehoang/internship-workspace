<?php

class Login extends Controller
{
    function __construct() {
        parent::__construct();
    }
    function index() {
        require 'models/User.php';
        $model = new User();
        $this->view->render('login');
    }
    function doLogin() {}
}