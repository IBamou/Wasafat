<?php
namespace App\Services;

use App\Models\UserModel;
use App\Models\RecipeModel;
use App\Models\CategoryModel;
use App\Helpers\ValidationHelper;

class UserServices {
    private $userModel;
    private $recipeModel;
    private $categoryModel;
    private $validationHelper;
    
    public function __construct() {
        $this->userModel = new UserModel();
        $this->recipeModel = new RecipeModel();
        $this->categoryModel = new CategoryModel();
        $this->validationHelper = new ValidationHelper();
    }
    
    public function profile() {
        $userId = $_SESSION['user']['id'];
        $user = $this->userModel->findbyId($userId);
        $recipeCount = $this->recipeModel->countByUser($userId);
        $categoryCount = $this->categoryModel->countByUser($userId);
        $data = [
            'user' => $user,
            'recipeCount' => $recipeCount,
            'categoryCount' => $categoryCount
        ];
        return ['success' => true, 'data' => $data];
    }

    public function updateProfile() {
        $userId = $_SESSION['user']['id'];
        
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!$data) {
                $data = $_POST;
            }
            
            if (!isset($data['csrf_token']) || !$this->validationHelper->verifyCSRFToken($data['csrf_token'])) {
                return ['success' => false, 'error' => 'Invalid token'];
            }
            
            $name = isset($data['name']) ? htmlspecialchars(trim($data['name'])) : '';
            $email = isset($data['email']) ? htmlspecialchars(trim($data['email'])) : '';
            
            if (empty($name)) {
                return ['success' => false, 'error' => 'Name is required'];
            }
            if (empty($email)) {
                return ['success' => false, 'error' => 'Email is required'];
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return ['success' => false, 'error' => 'Invalid email format'];
            }
            
            $this->userModel->updateUser($userId, ['name' => $name, 'email' => $email]);
            return ['success' => true];
        }
        
        return ['success' => false, 'error' => 'Invalid request'];
    }

    public function changePassword() {
        $userId = $_SESSION['user']['id'];
        
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!$data) {
                $data = $_POST;
            }
            
            if (!isset($data['csrf_token']) || !$this->validationHelper->verifyCSRFToken($data['csrf_token'])) {
                return ['success' => false, 'error' => 'Invalid token'];
            }
            
            $currentPassword = $data['current_password'] ?? '';
            $newPassword = $data['new_password'] ?? '';
            $confirmPassword = $data['confirm_password'] ?? '';
            
            if (empty($currentPassword)) {
                return ['success' => false, 'error' => 'Current password is required'];
            }
            if (empty($newPassword)) {
                return ['success' => false, 'error' => 'New password is required'];
            }
            if (strlen($newPassword) < 6) {
                return ['success' => false, 'error' => 'Password must be at least 6 characters'];
            }
            if ($newPassword !== $confirmPassword) {
                return ['success' => false, 'error' => 'Passwords do not match'];
            }
            
            $result = $this->userModel->changePassword([
                'id' => $userId,
                'currentPassword' => $currentPassword,
                'newPassword' => $newPassword
            ]);
            
            return $result ? ['success' => true] : ['success' => false, 'error' => 'Current password is incorrect'];
        }
        
        return ['success' => false, 'error' => 'Invalid request'];
    }
}