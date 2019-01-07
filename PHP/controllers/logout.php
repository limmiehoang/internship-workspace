<?php

class Logout extends Controller
{
    function __construct() {
        parent::__construct();
    }
    function doLogout() {
        $accessToken = new Symfony\Component\HttpFoundation\Cookie("access_token", "Expired", time()-3600, '/', getenv('COOKIE_DOMAIN'));
        $this->redirect('/', ['cookies' => [$accessToken]]);
    }
}