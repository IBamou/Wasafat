<?php
namespace App\Controllers;

use App\Services\UserServices;

class UserController extends Controller {
    private $userServices;
    public function __construct() {
        parent::__construct();
        $this->userServices = new UserServices();
    }

    public function profile() {
        $result = $this->userServices->profile();
        if ($result['success']) {
            $this->render('Users', 'profile', $result['data'] + ['page_css' => ['profile'], 'page_js' => ['profile']]);
        }
    }

    public function updateProfile() {
        $result = $this->userServices->updateProfile();
        
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            $this->json($result);
            return;
        }
        
        if ($result['success']) {
            $this->redirectWithSuccess('profile', 'Profile updated successfully');
        } else {
            $this->redirectWithError('profile', $result['error'] ?? 'Update failed');
        }
    }

    public function changePassword() {
        $result = $this->userServices->changePassword();
        
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            $this->json($result);
            return;
        }
        
        if ($result['success']) {
            $this->redirectWithSuccess('profile', 'Password changed successfully');
        } else {
            $this->redirectWithError('profile', $result['error'] ?? 'Password change failed');
        }
    }
}