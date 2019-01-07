<?php

class Product extends Controller
{
    function __construct() {
        parent::__construct();
        require 'models/ProductModel.php';
        $this->model = new ProductModel();
    }
    function index() {
        $this->requireAuth();
        $products = $this->model->getAllProducts();
        $this->view->render('product', $products);
    }
    function add() {
        $this->requireAuth();
        $data['categories'] = $this->display_categories();
        $this->view->render('addProduct', $data);
    }
    function addProduct() {
        $productName = $this->request()->get('product_name');
        $productName = filter_var($productName, FILTER_SANITIZE_STRING);

        $category = $this->request()->get('category');
        $category = filter_var($category, FILTER_SANITIZE_STRING);

        $description = $this->request()->get('description');
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $ownerId = $this->decodeJwt('sub');

        try {
            $newProduct = $this->model->addProduct($productName, $category, $ownerId, $description);
            $this->redirect('/product');
        } catch (\Exception $e) {
            $this->redirect('/product/add');
        }
    }
    function edit($itemId) {
        $this->requireAuth();
        $item = $this->model->findProductById($itemId);

        if ($this->isOwner($item['owner_id'])) {
            $data['categories'] = $this->display_categories();
            $this->view->render('addProduct', $data);
            return;
        }
        $this->redirect('/');
    }
}