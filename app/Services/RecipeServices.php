<?php
namespace App\Services;

use App\Models\RecipeModel;
use App\Helpers\ValidationHelper;

class RecipeServices {
    private $recipeModel;
    private $validationHelper;

    public function __construct() {
        $this->recipeModel = new RecipeModel();
        $this->validationHelper = new ValidationHelper();
    }
    public function index() {
        $recipes = $this->recipeModel->getRecipes();
        $data = [
            'recipes' => $recipes   
        ];
        return ['success' => true, 'data' => $data];
    }

    public function show(int $id) {
        $recipe = $this->recipeModel->getRecipeById($id);
        $data = [
            'recipe' => $recipe
        ];
        return ['success' => true, 'data' => $data];  
    }

    public function create() {
        $categories = $this->recipeModel->getCategories();
        $csrf_token = $this->validationHelper->generateCSRFToken();
        $_SESSION['csrf_token'] = $csrf_token;
        return ['success' => true, 'data' => ['categories' => $categories]];
    }

    public function store() {
        if (!isset($_POST['csrf_token']) || !$this->validationHelper->verifyCSRFToken($_POST['csrf_token'])) {
            return ['success' => false, 'errors' => ['Invalid request. Please try again.'], 'post' => $_POST];
        }
        
        $userId = $_SESSION['user']['id'];
        $errors = [];
        
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        
        // Validate
        if (empty($name)) {
            $errors[] = 'Recipe name is required';
        }
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors, 'post' => $_POST];
        }
        
        $description = isset($_POST['description']) ? htmlspecialchars(trim($_POST['description'])) : '';
        
        // Handle ingredients array
        $ingredientsArray = $_POST['ingredients'] ?? [];
        $ingredients = [];
        foreach ($ingredientsArray as $ing) {
            $ing = trim($ing);
            if (!empty($ing)) {
                $ingredients[] = htmlspecialchars($ing);
            }
        }
        $ingredients = implode("\n", $ingredients);
        
        // Handle instructions array
        $instructionsArray = $_POST['instructions'] ?? [];
        $instructions = [];
        foreach ($instructionsArray as $inst) {
            $inst = trim($inst);
            if (!empty($inst)) {
                $instructions[] = htmlspecialchars($inst);
            }
        }
        $instructions = implode("\n", $instructions);
        
        $preparation_time = !empty($_POST['preparation_time']) ? (int)$_POST['preparation_time'] : null;
        $cooking_time = !empty($_POST['cooking_time']) ? (int)$_POST['cooking_time'] : null;
        $difficulty = isset($_POST['difficulty']) ? $_POST['difficulty'] : 'medium';
        $category_id = !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null;
        
        $data = [
            'name' => $name,
            'description' => $description,
            'user_id' => $userId,
            'category_id' => $category_id,
            'ingredients' => $ingredients,
            'instructions' => $instructions,
            'preparation_time' => $preparation_time,
            'cooking_time' => $cooking_time,
            'difficulty' => $difficulty
        ];
        $this->recipeModel->storeRecipe($data);
        return ['success' => true];
    }    
    
    public function edit(int $id) {
        $recipe = $this->recipeModel->getRecipeById($id);
        $categories = $this->recipeModel->getCategories();
        $data = [
            'recipe' => $recipe,
            'categories' => $categories
        ];
        return ['success' => true, 'data' => $data];
    }    
    
    public function update(int $id) {
        if (!isset($_POST['csrf_token']) || !$this->validationHelper->verifyCSRFToken($_POST['csrf_token'])) {
            return ['success' => false, 'errors' => ['Invalid request. Please try again.'], 'post' => $_POST];
        }
        
        $errors = [];
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        
        if (empty($name)) {
            $errors[] = 'Recipe name is required';
        }
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors, 'post' => $_POST];
        }
        
        $description = isset($_POST['description']) ? htmlspecialchars(trim($_POST['description'])) : '';
        
        // Handle ingredients array
        $ingredientsArray = $_POST['ingredients'] ?? [];
        $ingredients = [];
        foreach ($ingredientsArray as $ing) {
            $ing = trim($ing);
            if (!empty($ing)) {
                $ingredients[] = htmlspecialchars($ing);
            }
        }
        $ingredients = implode("\n", $ingredients);
        
        // Handle instructions array
        $instructionsArray = $_POST['instructions'] ?? [];
        $instructions = [];
        foreach ($instructionsArray as $inst) {
            $inst = trim($inst);
            if (!empty($inst)) {
                $instructions[] = htmlspecialchars($inst);
            }
        }
        $instructions = implode("\n", $instructions);
        
        $preparation_time = !empty($_POST['preparation_time']) ? (int)$_POST['preparation_time'] : null;
        $cooking_time = !empty($_POST['cooking_time']) ? (int)$_POST['cooking_time'] : null;
        $difficulty = isset($_POST['difficulty']) ? $_POST['difficulty'] : 'medium';
        $category_id = !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null;
        
        $data = [
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'category_id' => $category_id,
            'ingredients' => $ingredients,
            'instructions' => $instructions,
            'preparation_time' => $preparation_time,
            'cooking_time' => $cooking_time,
            'difficulty' => $difficulty
        ];
        $this->recipeModel->updateRecipe($data);
        return ['success' => true];
    }

    public function delete(int $id) {
        $this->recipeModel->deleteRecipe($id);
        return ['success' => true];
    }
}