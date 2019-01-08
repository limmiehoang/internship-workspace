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

    function decodeJwt($prop = null) {
        \Firebase\JWT\JWT::$leeway = 1;
        $jwt = \Firebase\JWT\JWT::decode(
            $this->request()->cookies->get('access_token'),
            getenv('SECRET_KEY'),
            ['HS256']
        );

        if ($prop === null) {
            return $jwt;
        }

        return $jwt->{$prop};
    }

    function isAuthenticated() {
        if (!$this->request()->cookies->has('access_token')) {
            return false;
        }
        try {
            $this->decodeJwt();
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

    function requireAdmin() {
        if (!$this->isAuthenticated()) {
            $accessToken = new Symfony\Component\HttpFoundation\Cookie("access_token", "Expired", time()-3600, '/', getenv('COOKIE_DOMAIN'));
            $this->redirect('/login', ['cookies' => [$accessToken]]);
        }
        try {
            if (!$this->decodeJwt('role') === 0) {
                $this->redirect('/');
            }
        } catch (\Exception $e) {
            $accessToken = new Symfony\Component\HttpFoundation\Cookie("access_token", "Expired", time()-3600, '/', getenv('COOKIE_DOMAIN'));
            $this->redirect('/login', ['cookies' => [$accessToken]]);
        }
    }

    function isAdmin() {
        if (!$this->isAuthenticated()) {
            return false;
        }

        try {
            return ($this->decodeJwt('role') == 1);
        } catch (\Exception $e) {
            return false;
        }
    }

    function isLeader($groupId) {
        if (!$this->isAuthenticated()) {
            return false;
        }

        try {
            if ($this->decodeJwt('role') != 2) {
                return false;
            }
            $groupLeading = $this->decodeJwt('group');
        } catch (\Exception $e) {
            return false;
        }

        return $groupId == $groupLeading;
    }

    function isOwner($ownerId) {
        if (!$this->isAuthenticated()) {
            return false;
        }

        try {
            $userId = $this->decodeJwt('sub');
        } catch (\Exception $e) {
            return false;
        }

        return $ownerId == $userId;
    }

    function isAuthorized($groupId, $ownerId) {
        if ($this->isAdmin() || $this->isLeader($groupId) || $this->isOwner($ownerId)) {
            return true;
        }
        return false;
    }

    function requireAuthorization($itemId, $model) {
        $this->requireAuth();
        $item = $model->findProductById($itemId);

        if ($this->isAuthorized($item['group_id'], $item['owner_id'])) {
            return $item;
        };

        $this->redirect('/');
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

    function get_categories() {
        require 'models/Category.php';
        $model = new Category();

        return $model->getAllCategories();
    }
}