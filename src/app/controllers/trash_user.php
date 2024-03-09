<?php
require './app/core/Controller.php';

class trash_user extends Controller
{
    private $product_model;
    public function __construct()
    {
        $this->loadModel('ProductModel');
        $this->product_model = new ProductModel();
    }
    public function index()
    {
        // $products = $this->product_model->getAll();
        return $this->view('main_admin_layout', ['page' => 'trash_user']);
    }
    public function show()
    {
    }
}
