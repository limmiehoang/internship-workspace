<?php

class Group extends Controller
{
    function __construct() {
        parent::__construct();
    }
    function index() {
        $this->requireAdmin();
        $this->view->render('group');
    }
}