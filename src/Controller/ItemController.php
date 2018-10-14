<?php
namespace Controller;

use Model\ItemManager;
use Twig_Environment;
use Twig_Loader_Filesystem;

class ItemController extends AbstractController
{
    protected $twig;

    public function index()
    {
        $itemManager = new ItemManager($this->pdo);
        $items = $itemManager->selectAllItems();
        return $this->twig->render('item.html.twig', ['items' => $items]);
    }
    public function show(int $id)
    {
        $itemManager = new ItemManager();
        $item = $itemManager->selectOneItem($id);
        return $this->twig->render('showItem.html.twig', ['item' => $item]);
    }
}