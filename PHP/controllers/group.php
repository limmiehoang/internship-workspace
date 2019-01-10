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
            $data['groups'] = $this->model->getAllGroups();
            $data['messages'] = $this->display_messages();
            $this->view->render('group', $data);
        } catch (\Exception $e) {
            $this->redirect('/myerror');
        }
    }
    function add() {
        try {
            require 'models/UserModel.php';
            $users = new UserModel();
            $data['users'] = $users->getAllNonGroupUsers();
            $data['messages'] = $this->display_messages();
            $this->view->render('addGroup', $data);
        } catch (\Exception $e) {
            $this->redirect('/myerror');
        }
    }
    function addGroup() {
        global $session;

        require 'models/UserGroupModel.php';
        $userGroupModel = new UserGroupModel();

        $groupName = $this->request()->get('group_name');
        $groupName = trim($groupName);

        $leaderId = $this->request()->get('leader');

        $members = $this->request()->get('members');

        if (strlen($groupName) < 5 || !isset($leaderId)) {
            $session->getFlashBag()->add('error', 'Please fill in required fields.');
            $this->redirect('/group/add');
        }

        if (!empty($this->model->findGroupByName($groupName))) {
            $session->getFlashBag()->add('error', 'Group name already exists.');
            $this->redirect('/group/add');
        }

        try {
            $groupId = $this->model->addGroup($groupName);

            if (!empty($userGroupModel->findGroupByUserId($leaderId))) {
                $session->getFlashBag()->add('error', 'Sorry! Some of the users you selected are already in another group.');
                $this->redirect('/group/add');
            }

            $userGroupModel->addLeaderToGroup($leaderId, $groupId);

            foreach ($members as $memberId) {
                if (!empty($userGroupModel->findGroupByUserId($memberId))) {
                    $session->getFlashBag()->add('error', 'Sorry! Some of the users you selected are already in another group.');
                    $this->redirect('/group/add');
                }
                $userGroupModel->addMemberToGroup($memberId, $groupId);
            }

            $session->getFlashBag()->add('success', 'Record added successfully.');
            $this->redirect('/group');
        } catch (\Exception $e) {
            $session->getFlashBag()->add('error', 'Cannot add record. Please try again!');
            $this->redirect('/group/add');
        }
    }
    function detail($groupId) {
        require 'models/UserGroupModel.php';
        $userGroupModel = new UserGroupModel();

        $data['group'] = $this->model->findGroupById($groupId);

        $data['leader'] = $userGroupModel->findLeaderByGroupId($groupId);

        $data['members'] = $userGroupModel->findMembersByGroupId($groupId);

        $data['messages'] = $this->display_messages();
        $this->view->render('groupDetail', $data);
    }
    function fetch() {
        try {
            $data = $this->model->getAllGroups();
            $this->view->render('inc/select', $data);
        } catch (\Exception $e) {
            $this->redirect('/myerror');
        }
    }
}