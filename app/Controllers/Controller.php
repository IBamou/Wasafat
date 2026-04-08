<?php
namespace App\Controllers;

abstract class Controller {
    protected string $baseUrl;

    public function __construct() {
        $this->baseUrl = $this->getBaseUrl();
    }

    /**
     * Generate base URL for the application
     * Detects HTTPS and constructs proper URL
     */
    protected function getBaseUrl(): string {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
        return $protocol . $_SERVER['HTTP_HOST'] . '/Wasafat/';
    }

    /**
     * Render any view template
     */
    protected function render(string $viewPath, string $template, array $data = []): void {
        // Always include baseUrl for views
        $data['baseUrl'] = $this->baseUrl;
        extract($data);
        
        // Handle cases like "Categories/$id" or "Recipes/$id" - extract just the folder name
        $folder = explode('/', $viewPath)[0];
        include '../app/Views/' . $folder . '/' . $template . '.php';
        exit;
    }

    /**
     * Render authentication views
     */
    protected function renderAuth(string $template, array $data = []): void {
        $data['baseUrl'] = $this->baseUrl;
        extract($data);
        include '../app/Views/Auth/' . $template . '.php';
        exit;
    }

    /**
     * Redirect to URL (relative to base or absolute)
     */
    protected function redirect(string $url): void {
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            header('Location: ' . $url);
        } else {
            header('Location: ' . $this->baseUrl . $url);
        }
        exit;
    }

    /**
     * Redirect with success flash message
     */
    protected function redirectWithSuccess(string $url, string $message): void {
        $_SESSION['success'] = $message;
        header('Location: ' . $this->baseUrl . $url);
        exit;
    }

    /**
     * Redirect with error flash message
     */
    protected function redirectWithError(string $url, string $message): void {
        $_SESSION['error'] = $message;
        header('Location: ' . $this->baseUrl . $url);
        exit;
    }

    /**
     * Go back to previous page with error message
     */
    protected function backWithError(string $message): void {
        $_SESSION['error'] = $message;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /**
     * Render 404 error page
     */
    protected function render404(string $message = 'Page not found'): void {
        include 'app/Views/404.php';
        exit;
    }

    /**
     * Render 403 error page
     */
    protected function render403(string $message = 'Access denied'): void {
        include 'app/Views/errors/403.php';
        exit;
    }

    /**
     * Check if current request is AJAX
     */
    protected function isAjax(): bool {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
    }

    /**
     * Return JSON response (for AJAX requests)
     */
    protected function json(array $data, int $statusCode = 200): void {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

}
