<?php

class Index extends Controller
{
    function __construct() {
        parent::__construct();
    }
    function index() {
        if ($this->request()->cookies->has('access_token')) {
            $this->view->render('product');
        } else {
            $this->view->render('login');
        }
    }
}