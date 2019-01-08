<?php

class Group extends Controller
{
    function __construct() {
        parent::__construct();
        require 'models/GroupModel.php';
        $this->model = new GroupModel();
        $this->requireAdmin();
    }
    function index() {
        try {
            $groups = $this->model->getAllGroups();
            $this->view->render('group', $groups);
        } catch (\Exception $e) {
            $this->redirect('/error');
        }
    }
    function add() {
        try {
            require 'models/UserModel.php';
            $users = new UserModel();
            $data['users'] = $users->getAllNonGroupUsers();
            $this->view->render('addGroup', $data);
        } catch (\Exception $e) {
            $this->redirect('/error');
        }
    }
}