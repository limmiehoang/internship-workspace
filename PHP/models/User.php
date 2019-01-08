<?php

class User
{
    public function __construct() {

    }

    public function findUserByUsername($username) {
        global $db;

        try {
            $query = "SELECT users.id, username, password, group_id, role_id FROM users
                      LEFT JOIN users_groups ON users_groups.user_id = users.id
                      WHERE username = :username";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function createUser($username, $password) {
        global $db;

        try {
            $query = "INSERT INTO users (username, password)"
                . "VALUES (:username, :password)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            return $this->findUserByUsername($username);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}