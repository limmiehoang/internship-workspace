<?php

class Index extends Controller
{
    function __construct() {
        parent::__construct();
    }
    function index() {
        if ($this->isAuthenticated()) {
            $this->redirect('/product');
        } else {
            $response = $this->display_errors();
            $this->view->render('login', $response);
        }
    }
}