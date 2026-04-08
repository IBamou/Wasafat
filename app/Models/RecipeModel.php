<?php
namespace App\Models;

use App\Configs\Database;
use PDO;
use PDOException;
class RecipeModel extends Database {
    public function __construct() {
        parent::__construct();
    }

    public function getRecipes() {
        try {
            $sql = 'SELECT * FROM recipes ORDER BY created_at DESC';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function countByUser(int $userId): int {
        try {
            $sql = 'SELECT COUNT(*) as count FROM recipes WHERE user_id = :user_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        } catch (PDOException $e) {
            return 0;
        }
    }

    public function getRecipeById(int $id) {
        try {
            $sql = 'SELECT * FROM recipes WHERE id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function storeRecipe(array $data) {
        try {
            $sql = 'INSERT INTO recipes (name, description, user_id, category_id, ingredients, instructions, preparation_time, cooking_time, difficulty) 
                    VALUES (:name, :description, :user_id, :category_id, :ingredients, :instructions, :preparation_time, :cooking_time, :difficulty)';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
            $stmt->bindParam(':ingredients', $data['ingredients'], PDO::PARAM_STR);
            $stmt->bindParam(':instructions', $data['instructions'], PDO::PARAM_STR);
            $stmt->bindParam(':preparation_time', $data['preparation_time'], PDO::PARAM_INT);
            $stmt->bindParam(':cooking_time', $data['cooking_time'], PDO::PARAM_INT);
            $stmt->bindParam(':difficulty', $data['difficulty'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateRecipe(array $data) {
        try {
            $sql = 'UPDATE recipes SET name = :name, description = :description, category_id = :category_id, 
                    ingredients = :ingredients, instructions = :instructions, preparation_time = :preparation_time, 
                    cooking_time = :cooking_time, difficulty = :difficulty WHERE id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
            $stmt->bindParam(':ingredients', $data['ingredients'], PDO::PARAM_STR);
            $stmt->bindParam(':instructions', $data['instructions'], PDO::PARAM_STR);
            $stmt->bindParam(':preparation_time', $data['preparation_time'], PDO::PARAM_INT);
            $stmt->bindParam(':cooking_time', $data['cooking_time'], PDO::PARAM_INT);
            $stmt->bindParam(':difficulty', $data['difficulty'], PDO::PARAM_STR);
            $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteRecipe(int $id) {
        try {
            $sql = 'DELETE FROM recipes WHERE id = :id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getCategories() {
        try {
            $sql = 'SELECT id, name FROM categories ORDER BY name ASC';
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getRecipesByCategory(int $categoryId, int $userId) {
        try {
            $sql = 'SELECT * FROM recipes WHERE category_id = :category_id AND user_id = :user_id ORDER BY created_at DESC';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }
}



