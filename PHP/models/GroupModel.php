<?php

class GroupModel
{
    public function getAllGroups() {
        global $db;

        try {
            $query = "SELECT groups.id, group_name, username FROM groups
                      JOIN users_groups ON users_groups.group_id = groups.id
                      JOIN users ON users.id = users_groups.user_id
                      WHERE role_id = 2";
            $stmt = $db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}