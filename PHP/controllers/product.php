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

        try {
            $data['products'] = $this->model->getAllProducts();
            foreach ($data['products'] as &$product) {
                $product['write_permission'] = $this->isAuthorized($product['group_id'], $product['owner_id']);
            }
            unset($product);
            $data['messages'] = $this->display_messages();
            $this->view->render('product', $data);
        } catch (\Exception $e) {
            $this->redirect('/error');
        }

    }
    function add() {
        $this->requireAuth();

        try {
            $data['categories'] = $this->get_categories();
            $data['messages'] = $this->display_messages();
            $this->view->render('addProduct', $data);
        } catch (\Exception $e) {
            $this->redirect('/error');
        }
    }
    function addProduct() {
        global $session;

        $this->requireAuth();

        $productName = $this->request()->get('product_name');

        $category = $this->request()->get('category');

        $description = $this->request()->get('description');

        $ownerId = $this->decodeJwt('sub');

        try {
            $newProduct = $this->model->addProduct($productName, $category, $ownerId, $description);
            $session->getFlashBag()->add('success', 'Record added successfully.');
            $this->redirect('/product');
        } catch (\Exception $e) {
            $session->getFlashBag()->add('error', 'Cannot add record. Please try again!');
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
        global $session;

        $this->requireAuthorization($itemId, $this->model);

        $productName = $this->request()->get('product_name');

        $category = $this->request()->get('category');

        $description = $this->request()->get('description');

        try {
            $this->model->editProduct($itemId, $productName, $category, $description);
            $session->getFlashBag()->add('success', 'Recored edited successfully.');
            $this->redirect('/product');
        } catch (\Exception $e) {
            $session->getFlashBag()->add('error', 'Cannot edit record. Please try again!');
            $this->redirect("/product/edit/$itemId");
        }
    }
    function remove($itemId) {
        global $session;

        $this->requireAuthorization($itemId, $this->model);

        try {
            $this->model->removeProduct($itemId);
            $session->getFlashBag()->add('success', 'Record removed successfully.');
        } catch (\Exception $e) {
            $session->getFlashBag()->add('error', 'Cannot remove record. Please try again!');
        }
        $this->redirect('/product');
    }
}