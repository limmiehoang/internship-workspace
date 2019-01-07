<?php

require 'config.php';
require_once 'vendor/autoload.php';

require 'libs/Bootstrap.php';
require 'libs/Controller.php';
require 'libs/View.php';
require 'libs/connection.php';

$dotenv = \Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$session = new \Symfony\Component\HttpFoundation\Session\Session();
$session->start();

$app = new Bootstrap();
