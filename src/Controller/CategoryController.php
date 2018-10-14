<?php

namespace Controller;
use Model\CategoryManager;
use Twig_Environment;
use Twig_Loader_Filesystem;

class CategoryController extends AbstractController
{
    protected $twig;

    public function index()
    {
        $categoryManager = new CategoryManager($this->pdo);
        $categories = $categoryManager->selectAllCategory();
        return $this->twig->render('/category.html.twig', ['categories' => $categories]);    }
    public function show(int $id)
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->selectOneCategory($id);
        return $this->twig->render('/showCategory.html.twig', ['category' => $category]);    }
}