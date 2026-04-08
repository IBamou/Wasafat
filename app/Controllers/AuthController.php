<?php
namespace App\Controllers;

use App\Services\AuthServices;
use App\Helpers\ValidationHelper;

class AuthController extends Controller {
    private AuthServices $authService;
    private ValidationHelper $validationHelper;

    public function __construct() {
        parent::__construct();
        $this->authService = new AuthServices();
        $this->validationHelper = new ValidationHelper();
    }

    public function login(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->authService->login();
            if (!empty($result['success'])) {
                $this->redirectWithSuccess('dashboard', 'Welcome back!');
            } else {
                $csrfToken = $this->validationHelper->generateCSRFToken();
                $this->renderAuth('login', [
                    'csrfToken' => $csrfToken,
                    'errors' => $result['errors'] ?? [],
                    'post' => $result['post'] ?? [],
                    'page_css' => ['login'],
                    'page_js' => ['login']
                ]);
            } 
        } else {
            $csrfToken = $this->validationHelper->generateCSRFToken();
            $this->renderAuth('login', ['csrfToken' => $csrfToken, 'page_css' => ['login'], 'page_js' => ['login']]); 
        }
    }

    public function signup(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->authService->signup();
            
            if ($result['success']) {
                $this->redirect($result['redirect']);
            } else {
                $csrfToken = $this->validationHelper->generateCSRFToken();
                $this->renderAuth('signup', [
                    'csrfToken' => $csrfToken,
                    'errors' => $result['errors'] ?? [],
                    'post' => $_POST,
                    'page_css' => ['signup'],
                    'page_js' => ['signup']
                ]);
            }
        } else {
            $csrfToken = $this->validationHelper->generateCSRFToken();
            $this->renderAuth('signup', [
                'csrfToken' => $csrfToken,
                'page_css' => ['signup'],
                'page_js' => ['signup']
            ]);
        }
    }


    public function logout(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->authService->logout();
            $this->redirect($result['redirect']);
        }
    }
}
