<?php

class Product extends Controller
{
    function __construct() {
        parent::__construct();
    }
    function index() {
        $this->view->render('product');
    }
}