<?php
require './app/core/Controller.php';

class user_manage extends Controller
{
    private $user_model;
    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->user_model = new UserModel();
    }
    public function index()
    {
        // $products = $this->product_model->getAll();
        return $this->view('main_admin_layout', ['page' => 'user_admin']);
    }
}
