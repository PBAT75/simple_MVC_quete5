<?php

namespace Controller;

use Model\Category;
use Model\CategoryManager;


class CategoryController extends AbstractController
{
    protected $twig;

    public function index()
    {
        $categoryManager = new CategoryManager($this->pdo);
        $categories = $categoryManager->selectAll();
        return $this->twig->render('category.html.twig', ['categories' => $categories]);    }
    public function show(int $id)
    {
        $categoryManager = new CategoryManager($this->pdo);
        $category = $categoryManager->selectOneById($id);
        return $this->twig->render('showCategory.html.twig', ['category' => $category]);    }
}