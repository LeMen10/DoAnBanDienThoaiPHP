<?php
require './app/core/Controller.php';

class home extends Controller
{
    private $home_model;

    public function __construct()
    {
        $this->loadModel('HomeModel');
        $this->home_model = new HomeModel();
    }
    public function index()
    {
        $productsPerPage = 8;
        $page = 1;
        $products = $this->home_model->getPhones($productsPerPage, $page);
        
        return $this->view('main_layout', ['page' => 'home', 'products' => $products]);

    }
    public function show()
    {
    }
    function getUserName(){
        $id = $_POST['id'];
        $user  = $this->home_model->GetUser($id);
        echo json_encode(['success'=>true, 'user'=> $user]);
    }
    function GetSuggestion(){
        $stringFind = $_POST['stringFind'];
        $suggestions  = $this->home_model->GetSuggestion($stringFind);
        echo json_encode(['success'=>true, 'suggest'=> $suggestions]);
    }
}
