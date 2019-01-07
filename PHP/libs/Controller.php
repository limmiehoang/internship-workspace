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

    function isAuthenticated() {
        if (!$this->request()->cookies->has('access_token')) {
            return false;
        }
        try {
            \Firebase\JWT\JWT::$leeway = 1;
            \Firebase\JWT\JWT::decode(
                $this->request()->cookies->get('access_token'),
                getenv('SECRET_KEY'),
                ['HS256']
            );
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    function requireAuth() {
        if (!$this->isAuthenticated()) {
            $accessToken = new Symfony\Component\HttpFoundation\Cookie("access_token", "Expired", time()-3600, '/', getenv('COOKIE_DOMAIN'));
            $this->redirect('/login', ['cookies' => [$accessToken]]);
        }
    }

    function display_errors() {
        global $session;

        if (!$session->getFlashBag()->has('error')) {
            return;
        }

        $messages = $session->getFlashBag()->get('error');

        $response = '<div class="alert alert-danger alert-dismissible">';
        foreach ($messages as $message) {
            $response .= "{$message}<br/>";
        }
        $response .= '</div>';
        return $response;
    }
}