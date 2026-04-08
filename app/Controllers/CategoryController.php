<?php
namespace App\Controllers;

use App\Services\CategoryServices;

class CategoryController extends Controller {
    private $categoryServices;

    public function __construct() {
        parent::__construct();
        $this->categoryServices = new CategoryServices();
    }  

    public function index() {
        $result = $this->categoryServices->index();
        if ($result['success']) {
            $this->render('Categories', 'index', $result['data'] + ['page_css' => ['categories-index'], 'page_js' => ['categories-index']]);
        } else {
            $this->backWithError($result['error']);
        }

    }

    public function show(int $id) {
        $result = $this->categoryServices->show($id);
        if ($result['success']) {
            $this->render("Categories", 'show', $result['data'] + ['page_css' => ['categories-show'], 'page_js' => ['categories-show']]);
        } else {
            $this->backWithError($result['error']);
        }
    }

    public function create() {
        $result = $this->categoryServices->create();
        if ($result['success']) {
            $this->render("Categories", 'create',  ['page_css' => ['categories-create'], 'page_js' => ['categories-create']]);
        } else {
            $this->backWithError($result['error']);
        } 
    }    
    
    public function store() {
        $result = $this->categoryServices->store();
        if ($result['success']) {
            $this->redirect("categories");
        } else {
            $data = [
                'errors' => $result['errors'] ?? [],
                'post' => $result['post'] ?? [],
                'page_css' => ['categories-create'],
                'page_js' => ['categories-create']
            ];
            $this->render("Categories", 'create', $data);
        }
    }


    public function edit(int $id) {
        $result = $this->categoryServices->edit($id);
        if ($result['success']) {
            $this->render("Categories/$id", 'edit', $result['data'] + ['page_css' => ['categories-edit'], 'page_js' => ['categories-edit']]);
        } else {
            $this->backWithError($result['error']);
        }
    }    
    
    public function update(int $id) {
        $result = $this->categoryServices->update($id);
        if ($result['success']) {
            $this->redirect("Categories/$id");
        } else {
            $editResult = $this->categoryServices->edit($id);
            $data = $editResult['data'] ?? [];
            $data['errors'] = $result['errors'] ?? [];
            $data['post'] = $result['post'] ?? [];
            $data['page_css'] = ['categories-edit'];
            $data['page_js'] = ['categories-edit'];
            $this->render("Categories/$id", 'edit', $data);
        }
    }

    public function delete(int $id) {
        $result = $this->categoryServices->delete($id);
        if ($result['success']) {
            $this->redirect("Categories");
        } else {
            $this->backWithError($result['error']);
        }
    }
}