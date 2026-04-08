<?php
namespace App\Middleware;

class Middleware {
    public $baseUrl;

    public function __construct() {
        $this->baseUrl = $this->getBaseUrl();
    }

    private function getBaseUrl(): string {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
        return $protocol . $_SERVER['HTTP_HOST'] . '/Wasafat/';
    }

    public function isGuest(): void {
        if (isset($_SESSION['user'])) {
            header('Location: ' . $this->baseUrl . 'dashboard');
            exit;
        }
    }

    public function isLoggedIn(): void {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . $this->baseUrl . 'login');
            exit;
        }
    }

}
