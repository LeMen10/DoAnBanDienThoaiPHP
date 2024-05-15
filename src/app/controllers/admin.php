<?php
require './app/core/Controller.php';

class admin extends Controller
{
    private $product_model,$user_model;
    public function __construct()
    {
        $this->loadModel('ProductModel');
        $this->product_model = new ProductModel();
        $this->loadModel('UserModel');
        $this->user_model = new UserModel();    
        require_once './app/middlewares/jwt.php';
    }
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) header('Location: index.php?ctrl=login');
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            $checkShow = $this->user_model->checkPermission($data['authorID'], 1);
            if($checkShow['show'] != 1) header("Location: index.php?ctrl=myerror&act=forbidden");
            return $this->view('main_admin_layout', ['page' => 'home_admin']);
        }
    }
    public function show()
    {
    }
}
