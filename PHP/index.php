<?php

require 'config.php';
require_once 'vendor/autoload.php';

require 'libs/Bootstrap.php';
require 'libs/Controller.php';
require 'libs/View.php';
require 'libs/connection.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$app = new Bootstrap();
