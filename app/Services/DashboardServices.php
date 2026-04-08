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
        $recentCount = $this->recipeModel->getRecentByUser($userId, 7);
        
        $data = [
            'recipeCount' => $recipeCount,
            'categoryCount' => $categoryCount,
            'recentCount' => $recentCount
        ];
        return ['success' => true, 'data' => $data];
    }

}