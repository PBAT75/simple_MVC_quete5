<?php

namespace Controller;
use Model\CategoryManager;
use Twig_Environment;
use Twig_Loader_Filesystem;

class CategoryController
{
    private $twig;

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(__DIR__.'/../View');
        $this->twig = new Twig_Environment($loader);
    }
    public function index()
    {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->selectAllCategory();
        return $this->twig->render('/category.html.twig', ['categories' => $categories]);    }
    public function show(int $id)
    {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->selectOneCategory($id);
        return $this->twig->render('/showCategory.html.twig', ['category' => $category]);    }
}