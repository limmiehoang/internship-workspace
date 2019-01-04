<?php

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch ( \Exception $e ) {
    echo 'Error connecting to the Database: ' . $e->getMessage();
    exit;
}