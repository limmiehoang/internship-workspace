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
            $this->redirect('/error');
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
            $this->redirect('/error');
        }
    }
    function addGroup() {
        global $session;

        require 'models/UserGroupModel.php';
        $userGroupModel = new UserGroupModel();

        $groupName = $this->request()->get('group_name');

        $leaderId = $this->request()->get('leader');

        $members = $this->request()->get('members');

        try {
            $groupId = $this->model->addGroup($groupName);

            $userGroupModel->addLeaderToGroup($leaderId, $groupId);

            foreach ($members as $memberId) {
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
}