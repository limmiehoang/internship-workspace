<?php

class CategoryModel
{
    public function getAllCategories() {
        global $db;

        try {
            $query = "SELECT id, category AS name FROM categories";
            return $db->query($query, PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}