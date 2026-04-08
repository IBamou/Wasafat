<?php
namespace App\Controllers;

use App\Services\RecipeServices;

class RecipeController extends Controller {
    private $recipeServices;

    public function __construct() {
        parent::__construct();
        $this->recipeServices = new RecipeServices();
    }  

    public function index() {
        $result = $this->recipeServices->index();
        if ($result['success']) {
            $this->render('Recipes', 'index', $result['data'] + ['page_css' => ['recipes-index'], 'page_js' => ['recipes-index']]);
        } else {
            $this->backWithError($result['error']);
        }

    }

    public function show(int $id) {
        $result = $this->recipeServices->show($id);
        if ($result['success']) {
            $this->render("Recipes", 'show', $result['data'] + ['page_css' => ['recipes-show'], 'page_js' => ['recipes-show']]);
        } else {
            $this->backWithError($result['error']);
        }
    }

    public function create() {
        $result = $this->recipeServices->create();
        if ($result['success']) {
            $data = ['page_css' => ['recipes-create'], 'page_js' => ['recipes-create']];
            if (isset($result['data']['categories'])) {
                $data['categories'] = $result['data']['categories'];
                // $data['csrf_token'] = $result['data']['csrf_token'];
            }
            $this->render("Recipes", 'create', $data);
        } else {
            $this->backWithError($result['error']);
        } 
    }    
    
    public function store() {
        $result = $this->recipeServices->store();
        if ($result['success']) {
            $this->redirect("recipes");
        } else {
            // Show create form again with errors
            $categoriesResult = $this->recipeServices->create();
            $data = [
                'errors' => $result['errors'] ?? [],
                'post' => $result['post'] ?? [],
                'categories' => $categoriesResult['data']['categories'] ?? [],
                'page_css' => ['recipes-create'],
                'page_js' => ['recipes-create']
            ];
            $this->render("Recipes", 'create', $data);
        }
    }


    public function edit(int $id) {
        $result = $this->recipeServices->edit($id);
        if ($result['success']) {
            $this->render("Recipes", 'edit', $result['data'] + ['page_css' => ['recipes-edit'], 'page_js' => ['recipes-edit']]);
        } else {
            $this->backWithError($result['error']);
        }
    }    
    
    public function update(int $id) {
        $result = $this->recipeServices->update($id);
        if ($result['success']) {
            $this->redirect("Recipes/$id");
        } else {
            // Show edit form again with errors
            $editResult = $this->recipeServices->edit($id);
            $data = $editResult['data'] ?? [];
            $data['errors'] = $result['errors'] ?? [];
            $data['post'] = $result['post'] ?? [];
            $data['page_css'] = ['recipes-edit'];
            $data['page_js'] = ['recipes-edit'];
            $this->render("Recipes", 'edit', $data);
        }
    }

    public function delete(int $id) {
        $result = $this->recipeServices->delete($id);
        if ($result['success']) {
            $this->redirect("Recipes");
        } else {
            $this->backWithError($result['error']);
        }
    }
}