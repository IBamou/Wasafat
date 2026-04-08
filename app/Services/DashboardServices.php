<?php
namespace App\Services;

use App\Models\RecipeModel;
use App\Models\CategoryModel;

class DashboardServices {
    private $recipeModel;
    private $categoryModel;

    public function __construct() {
        $this->recipeModel = new RecipeModel();
        $this->categoryModel = new CategoryModel();
    }
    
    public function index() {
        $userId = $_SESSION['user']['id'];
        $recipeCount = $this->recipeModel->countByUser($userId);
        $categoryCount = $this->categoryModel->countByUser($userId);
        
        $data = [
            'recipeCount' => $recipeCount,
            'categoryCount' => $categoryCount
        ];
        return ['success' => true, 'data' => $data];
    }

}