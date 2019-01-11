<?php

class Category extends Controller
{
    function __construct() {
        parent::__construct();
        require 'models/CategoryModel.php';
        $this->model = new CategoryModel();
        $this->requireAuth();
    }
    function index() {
        $this->redirect('/myerror');
    }
}