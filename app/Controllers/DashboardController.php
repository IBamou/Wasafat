<?php
namespace App\Controllers;
use App\Services\DashboardServices;

class DashboardController extends Controller {
    private $DashboardServices;

    public function __construct(){
        parent::__construct();
        $this->DashboardServices = new DashboardServices();
    }
    
    public function index() {
        $result = $this->DashboardServices->index();
        if ($result['success']) {
            $this->render('Dashboard', 'index', $result['data'] + ['page_css' => ['dashboard'], 'page_js' => ['dashboard']]);
        }
    }


}