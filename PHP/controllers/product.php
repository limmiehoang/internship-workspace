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
        foreach ($products as &$product) {
            $product['write_permission'] = $this->isAuthorized($product['group_id'], $product['owner_id']);
        }
        unset($product);
        $this->view->render('product', $products);
    }
    function add() {
        $this->requireAuth();
        $data['categories'] = $this->get_categories();
        $this->view->render('addProduct', $data);
    }
    function addProduct() {
        $productName = $this->request()->get('product_name');

        $category = $this->request()->get('category');

        $description = $this->request()->get('description');

        $ownerId = $this->decodeJwt('sub');

        try {
            $newProduct = $this->model->addProduct($productName, $category, $ownerId, $description);
            $this->redirect('/product');
        } catch (\Exception $e) {
            $this->redirect('/product/add');
        }
    }
    function edit($itemId) {
        $item = $this->requireAuthorization($itemId, $this->model);

        $data['categories'] = $this->get_categories();
        $data['item'] = $item;
        $this->view->render('editProduct', $data);
    }
    function editProduct($itemId) {
        $this->requireAuthorization($itemId, $this->model);

        $productName = $this->request()->get('product_name');

        $category = $this->request()->get('category');

        $description = $this->request()->get('description');

        try {
            $this->model->editProduct($itemId, $productName, $category, $description);
            $this->redirect('/product');
        } catch (\Exception $e) {
            $this->redirect("/product/edit/$itemId");
        }
    }
    function remove($itemId) {
        $this->requireAuthorization($itemId, $this->model);

        try {
            $this->model->removeProduct($itemId);
            echo "OK";
        } catch (\Exception $e) {
            echo $e;
        }
//        $this->redirect('/product');
    }
}