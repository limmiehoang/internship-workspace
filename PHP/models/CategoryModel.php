<?php

class CategoryModel
{
    public function getAllCategories() {
        global $db;

        try {
            $query = "SELECT * FROM categories";
            return $db->query($query, PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}