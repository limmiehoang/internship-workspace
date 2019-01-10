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
    function fetch() {
        try {
            $data = $this->model->getAllCategories();
            $this->view->render('inc/select', $data);
        } catch (\Exception $e) {
            $this->redirect('/myerror');
        }
    }
}