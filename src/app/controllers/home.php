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
        // $products = $this->product_model->getAll();
        
        return $this->view('main_layout', ['page' => 'home']);
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
