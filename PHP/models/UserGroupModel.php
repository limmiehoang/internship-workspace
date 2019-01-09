<?php

class UserGroupModel
{
    public function addLeaderToGroup($leaderId, $groupId) {
        global $db;

        try {
            $query = "INSERT INTO users_groups (user_id, group_id, role_id)
                      VALUES (:leaderId, :groupId, 2)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':leaderId', $leaderId);
            $stmt->bindParam(':groupId', $groupId);
            return $stmt->execute();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function addMemberToGroup($memberId, $groupId) {
        global $db;

        try {
            $query = "INSERT INTO users_groups (user_id, group_id, role_id)
                      VALUES (:memberId, :groupId, 3)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':memberId', $memberId);
            $stmt->bindParam(':groupId', $groupId);
            return $stmt->execute();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function findLeaderByGroupId($groupId) {
        global $db;

        try {
            $query = "SELECT users.id, username FROM users_groups
                      JOIN users ON users.id = users_groups.user_id
                      WHERE group_id = :groupId AND role_id = 2";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':groupId', $groupId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function findMembersByGroupId($groupId) {
        global $db;

        try {
            $query = "SELECT users.id, username FROM users_groups
                      JOIN users ON users.id = users_groups.user_id
                      WHERE group_id = :groupId AND role_id = 3";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':groupId', $groupId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function findGroupByUserId($userId) {
        global $db;

        try {
            $query = "SELECT * FROM users_groups
                      WHERE user_id = :userId";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (\Exception $e) {
            throw $e;
        }
    }
}