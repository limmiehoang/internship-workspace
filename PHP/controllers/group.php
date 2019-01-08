<?php

class Group extends Controller
{
    function __construct() {
        parent::__construct();
        require 'models/GroupModel.php';
        $this->model = new GroupModel();
    }
    function index() {
        $this->requireAdmin();
        try {
            $groups = $this->model->getAllGroups();
            $this->view->render('group', $groups);
        } catch (\Exception $e) {
            $this->redirect('/error');
        }
    }
}