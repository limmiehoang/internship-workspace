<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/4/2019
 * Time: 11:04 AM
 */

class Controller
{
    public function __construct()
    {
        $this->view = new View();
    }
    function request() {
        return \Symfony\Component\HttpFoundation\Request::createFromGlobals();
    }
    function redirect($location, $extra = []) {
        $response = \Symfony\Component\HttpFoundation\Response::create(null,
            \Symfony\Component\HttpFoundation\Response::HTTP_FOUND,
            ['Location' => $location]);
        if (key_exists('cookies', $extra)) {
            foreach ($extra['cookies'] as $cookie) {
                $response->headers->setCookie($cookie);
            }
        }
        $response->send();
        exit;
    }
}