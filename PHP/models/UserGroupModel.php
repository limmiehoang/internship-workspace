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
}