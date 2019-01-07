<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/4/2019
 * Time: 11:06 AM
 */

class View
{
    public function __construct() {
    }

    public function render($name, $data = "") {
        require 'views/' . $name . '.php';
    }
}