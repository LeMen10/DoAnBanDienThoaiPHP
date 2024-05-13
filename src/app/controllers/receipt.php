<?php
require './app/core/Controller.php';

class receipt extends Controller
{
    private $product_model, $user_model;
    public function __construct()
    {
        $this->loadModel('ProductModel');
        $this->product_model = new ProductModel();
        $this->loadModel('UserModel');
        $this->user_model = new UserModel();
    }
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) header("Location: index.php?ctrl=login");
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            $checkShow = $this->user_model->checkPermission($data['authorID'], 3);
            if($checkShow['show'] == 0) header("Location: index.php?ctrl=myerror&act=forbidden");
            return $this->view('main_admin_layout', ['page' => 'receipt']);
        }
    }
}
