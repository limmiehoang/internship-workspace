<?php

class Product extends Controller
{
    const ITEMS_PER_PAGE = 8;
    function __construct() {
        parent::__construct();
        require 'models/ProductModel.php';
        $this->model = new ProductModel();
    }
    function index() {
        $this->requireAuth();

        try {
            $data['messages'] = $this->display_messages();
            $data['categories'] = $this->get_categories();
            $data['groups'] = $this->get_groups();
            $this->view->render('product', $data);
        } catch (\Exception $e) {
            $this->redirect('/myerror');
        }
    }
    function add() {
        $this->requireAuth();

        try {
            $data['categories'] = $this->get_categories();
            $data['messages'] = $this->display_messages();
            $this->view->render('addProduct', $data);
        } catch (\Exception $e) {
            $this->redirect('/myerror');
        }
    }
    function addProduct() {
        global $session;

        $this->requireAuth();

        $productName = $this->request()->get('product_name');
        $productName = trim($productName);

        $category = $this->request()->get('category');

        $description = $this->request()->get('description');
        $description = trim($description);

        $ownerId = $this->decodeJwt('sub');

        if (strlen($productName) < 5 || !isset($category)) {
            $session->getFlashBag()->add('error', 'Please fill in required fields.');
            $this->redirect('/product/add');
        }

        try {
            $this->model->addProduct($productName, $category, $ownerId, $description);
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
        $data['messages'] = $this->display_messages();
        $this->view->render('editProduct', $data);
    }
    function editProduct($itemId) {
        global $session;

        $this->requireAuthorization($itemId, $this->model);

        $productName = $this->request()->get('product_name');
        $productName = trim($productName);

        $category = $this->request()->get('category');

        $description = $this->request()->get('description');
        $description = trim($description);

        if (strlen($productName) < 5 || !isset($category)) {
            $session->getFlashBag()->add('error', 'Please fill in required fields.');
            $this->redirect("/product/edit/$itemId");
        }

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
    function fetchTable()
    {
        $this->requireAuth();

        if (isset($_GET["pg"])) {
            $currentPage = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
        }

        if (empty($currentPage)) {
            $currentPage = 1;
        }

        $categoryId = (isset($_GET["cat"])) ? filter_input(INPUT_GET, "cat", FILTER_SANITIZE_NUMBER_INT) : null;
        $groupId = (isset($_GET["grp"])) ? filter_input(INPUT_GET, "grp", FILTER_SANITIZE_NUMBER_INT) : null;

        $categoryId = ($categoryId > 0) ? $categoryId : null;
        $groupId = ($groupId > 0) ? $groupId : null;

        $totalItems = $this->model->getProductCount($categoryId, $groupId);
        if ($totalItems == 0)
            $totalPages = 1;
        else
            $totalPages = ceil($totalItems / self::ITEMS_PER_PAGE);

        if ($currentPage > $totalPages) {
            $this->redirect("/product?pg=$totalPages");
        }

        if ($currentPage < 1) {
            $this->redirect("/product?pg=1");
        }
        $offset = ($currentPage - 1) * self::ITEMS_PER_PAGE;

        try {
            $data['products'] = $this->model->getProductsCustom($categoryId, $groupId, self::ITEMS_PER_PAGE, $offset);
            foreach ($data['products'] as &$product) {
                $product['write_permission'] = $this->isAuthorized($product['group_id'], $product['owner_id']);
            }
            unset($product);
            $data['pagination_links'] = $this->create_pagination_links($totalPages, $currentPage, $totalItems, self::ITEMS_PER_PAGE);
            $this->view->render('inc/productTable', $data);
        } catch (\Exception $e) {
            $this->redirect('/myerror');
        }
    }
}