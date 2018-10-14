<?php
namespace Controller;

use Model\Item;
use Model\ItemManager;

class ItemController extends AbstractController
{
    protected $twig;

    public function index()
    {
        $itemManager = new ItemManager($this->pdo);
        $items = $itemManager->selectAll();
        return $this->twig->render('item.html.twig', ['items' => $items]);
    }
    public function show(int $id)
    {
        $itemManager = new ItemManager($this->pdo);
        $item = $itemManager->selectOneById($id);
        return $this->twig->render('showItem.html.twig', ['item' => $item]);
    }
}