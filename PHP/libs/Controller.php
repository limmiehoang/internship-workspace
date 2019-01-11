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
        global $session;

        if (!$this->isAuthenticated()) {
            $accessToken = new Symfony\Component\HttpFoundation\Cookie("access_token", "Expired", time()-3600, '/', getenv('COOKIE_DOMAIN'));
            $this->redirect('/login', ['cookies' => [$accessToken]]);
        }
        try {
            if ($this->decodeJwt('role') != 1) {
                $session->getFlashBag()->add('error', 'You are not authorized to access this page.');
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

    function display_messages() {
        global $session;

        if (!$session->getFlashBag()->has('error') && !$session->getFlashBag()->has('success')) {
            return;
        }

        $errorMessages = $session->getFlashBag()->get('error');
        $successMessages = $session->getFlashBag()->get('success');

        $response = "";

        foreach ($errorMessages as $errorMessage) {
            $response .= '<div class="alert alert-danger alert-dismissible fade in">'
                        . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            $response .= "{$errorMessage}";
            $response .= '</div>';
        }

        foreach ($successMessages as $successMessage) {
            $response .= '<div class="alert alert-success alert-dismissible fade in">'
                        . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            $response .= "{$successMessage}";
            $response .= '</div>';
        }

        return $response;
    }

    function get_categories() {
        require 'models/CategoryModel.php';
        $model = new CategoryModel();

        return $model->getAllCategories();
    }

    function create_pagination_links($totalPages, $currentPage, $totalItems, $itemsPerPage)
    {
        $response = "<div>Pages: ";
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $currentPage) {
                $response .= " <span>$i</span>";
            } else {
                $response .= " <a href='/product?pg=$i'>$i</a>";
            }
        }
        $response .= "</div>";
        $offset = ($currentPage - 1) * $itemsPerPage;
        $response .= 'Showing ';
        if ($totalItems != 0)
            $response .= ($offset + 1);
        else
            $response .= $offset;
        $response .= ' to ';
        if (($offset + $itemsPerPage) < $totalItems)
            $response .= $offset + $itemsPerPage;
        else
            $response .= $totalItems;
        $response .= ' of ' . $totalItems . ' entries';
        return $response;
    }
}