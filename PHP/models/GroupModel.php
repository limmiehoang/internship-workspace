<?php

class GroupModel
{
    public function getAllGroups() {
        global $db;

        try {
            $query = "SELECT groups.id, group_name, username FROM groups
                      LEFT JOIN users_groups ON users_groups.group_id = groups.id
                      LEFT JOIN users ON users.id = users_groups.user_id
                      WHERE role_id = 2";
            $stmt = $db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function addGroup($groupName) {
        global $db;

        try {
            $query = "INSERT INTO groups (group_name)
                      VALUES (:groupName)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':groupName', $groupName);
            $stmt->execute();
            return $db->lastInsertId();

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function findGroupById($groupId) {
        global $db;

        try {
            $query = "SELECT * FROM groups
                      WHERE id = :groupId";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':groupId', $groupId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function findGroupByName($groupname) {
        global $db;

        try {
            $query = "SELECT * FROM groups
                      WHERE group_name = :groupName";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':groupName', $groupName);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (\Exception $e) {
            throw $e;
        }
    }
}