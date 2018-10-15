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


    public function add()
    {
        $error='';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(isset($_POST['title']) && !empty($_POST['title'])){
                if(preg_match("/[a-zA-Z]+/",$_POST['title']))
                {
                    $itemManager = new ItemManager($this->pdo);
                    $item = new Item();
                    $item->setTitle($_POST['title']);
                    $id = $itemManager->insert($item);
                    header('Location:/item/' . $id);
                    exit();
                }else {
                    $error='caractères invalides';
                }
            } else {

                $error='le champ doit être renseigné';
            }
        }

        return $this->twig->render('addItem.html.twig',['error' => $error]);
    }



    public function edit(int $id): string
    {
        $itemManager = new ItemManager($this->pdo);
        $item = $itemManager->selectOneById($id);
        $error='';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['title']) && !empty($_POST['title'])){
                $item->setTitle($_POST['title']);
                $itemManager->update($item);
                header('Location:/item/' . $id);
                exit();
            } else {
                $error='champ à renseigner';
            }
        }

        return $this->twig->render('editItem.html.twig', ['item' => $item], ['error'=>$error]);
    }




    public function delete(int $id)
    {
        $itemManager = new ItemManager($this->pdo);
        $itemManager->delete($id);
        header('Location:/');
    }
}