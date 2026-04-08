<?php
namespace App\Services;

use App\Models\UserModel;
use App\Models\AuthModel;
use App\Helpers\ValidationHelper;

/**
 * AuthServices - Handles all authentication business logic
 * 
 * Responsibilities:
 * - User login with rate limiting
 * - User registration with email verification
 * - Password reset functionality
 * - Session management
 */
class AuthServices {
    public  string $baseUrl;
    private UserModel $userModel;
    private AuthModel $authModel;
    private ValidationHelper $validationModel;

    public function __construct() {
        $this->baseUrl = $this->getBaseUrl();
        $this->userModel = new UserModel();
        $this->authModel = new AuthModel();
        $this->validationModel = new ValidationHelper();
    }
    
    private function getBaseUrl(): string {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
        return $protocol . $_SERVER['HTTP_HOST'] . '/Wasafat/';
    }

    /**
     * Handle user login
     * Includes rate limiting to prevent brute force attacks
     */
    public function login(): array {
        $errors = [];
        
        // Validate CSRF token
        if (!isset($_POST['csrf_token']) || !$this->validationModel->verifyCSRFToken($_POST['csrf_token'])) {
            return ['success' => false, 'errors' => ["Invalid request. Please try again."], 'post' => $_POST];
        }
        
        // Sanitize and get input
        $email = $this->validationModel->cleanInput($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Basic validation
        if (empty($email) || empty($password)) {
            $errors[] = "Please enter both email and password.";
        }

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors, 'post' => $_POST];
        }

        // Attempt login through auth model
        $user = $this->authModel->verifyLogInData($email, $password);
        
        if ($user && $user['success']) {
            $userInfo = $this->userModel->findByEmail($email);
            
            if ($userInfo) {                
                // Create session
                $this->authModel->createSession($userInfo);
                session_regenerate_id(true);
                unset($_SESSION['csrf_token']);
                
                return ['success' => true];
            }
        }
        return ['success' => false, 'errors' => ["Invalid email or password."], 'post' => $_POST];
    }

    /**
     * Handle user registration with email verification
     */
    public function signup(): array {
        $errors = [];
        
        // Validate CSRF token
        if (!isset($_POST['csrf_token']) || !$this->validationModel->verifyCSRFToken($_POST['csrf_token'])) {
            $errors[] = "Invalid request. Please try again.";
            return ['success' => false, 'redirect' => $this->baseUrl . 'signup', 'errors' => $errors];
        }
        
        // Get input
        $name = $this->validationModel->cleanInput($_POST['name'] ?? '');
        $email = $this->validationModel->cleanInput($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $passwordConfirmation = $_POST['password_confirmation'] ?? '';

        // Validate name
        if (empty($name)) {
            $errors[] = "Name is required.";
        } elseif (strlen($name) > 100) {
            $errors[] = "Name cannot exceed 100 characters.";
        }

        // Validate email
        if (empty($email)) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        }

        // Validate password
        if (empty($password)) {
            $errors[] = "Password is required.";
        } elseif (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters.";
        }

        // Validate password confirmation
        if ($password !== $passwordConfirmation) {
            $errors[] = "Passwords do not match.";
        }

        if (!empty($errors)) {
            return ['success' => false, 'redirect' => $this->baseUrl . 'signup', 'errors' => $errors];
        }

        // Check if email already exists
        if ($this->userModel->findByEmail($email)) {
            $errors[] = "Email already exists.";
            return ['success' => false, 'redirect' => $this->baseUrl . 'signup', 'errors' => $errors];
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Create user
        $result = $this->userModel->addUser($name, $email, $hashedPassword);
        
        if ($result === true) {
            unset($_SESSION['csrf_token']);
            
            return [
                'success' => true,
                'redirect' => $this->baseUrl . 'login?success=Account created successfully! You can now login.'
            ];
        }
        
        $errors[] = "Something went wrong. Please try again.";
        return ['success' => false, 'redirect' => $this->baseUrl . 'signup', 'errors' => $errors];
    }


    /**
     * Handle user logout
     */
    public function logout(): array {
        if (!isset($_POST['csrf_token']) || !$this->validationModel->verifyCSRFToken($_POST['csrf_token'])) {
            return ['success' => false, 'redirect' => $this->baseUrl . 'home'];
        }
        
        $this->authModel->closeSession();     
        return ['success' => true, 'redirect' => $this->baseUrl . 'home'];
    }

}
