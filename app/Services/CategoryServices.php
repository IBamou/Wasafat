<?php
namespace App\Services;

use App\Models\CategoryModel;
use App\Models\RecipeModel;

class CategoryServices {
    private $categoryModel;
    private $recipeModel;

    public function __construct() {
        $this->categoryModel = new CategoryModel();
        $this->recipeModel = new RecipeModel();
    }
    public function index() {
        $categories = $this->categoryModel->getCategories();
        $data = [
            'categories' => $categories
        ];
        return ['success' => true, 'data' => $data];
    }

    public function show(int $id) {
        $userId = $_SESSION['user']['id'];
        $category = $this->categoryModel->getCategoryById($id);
        $recipes = $this->recipeModel->getRecipesByCategory($id, $userId);
        $data = [
            'category' => $category,
            'recipes' => $recipes
        ];
        return ['success' => true, 'data' => $data];  
    }

    public function create() {
        return ['success' => true];
    }

    public function store() {
        $userId = $_SESSION['user']['id'];
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $description = isset($_POST['description']) ? trim($_POST['description']) : '';
        $errors = [];
        
        if (empty($name)) {
            $errors[] = 'Category name is required';
        }
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors, 'post' => $_POST];
        }
        
        $data = [
            'name' => htmlspecialchars($name),
            'description' => htmlspecialchars($description),
            'user_id' => $userId
        ];
        $this->categoryModel->storeCategory($data);
        return ['success' => true];
    }    
    
    public function edit(int $id) {
        $category = $this->categoryModel->getCategoryById($id);
        $data = [
            'category' => $category
        ];
        return ['success' => true, 'data' => $data];
    }    
    
    public function update(int $id) {
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $description = isset($_POST['description']) ? trim($_POST['description']) : '';
        $errors = [];
        
        if (empty($name)) {
            $errors[] = 'Category name is required';
        }
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors, 'post' => $_POST];
        }
        
        $data = [
            'id' => $id,
            'name' => htmlspecialchars($name),
            'description' => htmlspecialchars($description)
        ];
        $this->categoryModel->updateCategory($data);
        return ['success' => true];
    }

    public function delete(int $id) {
        $this->categoryModel->deleteCategory($id);
        return ['success' => true];
    }
}