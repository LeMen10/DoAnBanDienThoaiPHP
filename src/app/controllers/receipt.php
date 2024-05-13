<?php
require './app/core/Controller.php';

class receipt extends Controller
{
    private $product_model;
    public function __construct()
    {
        $this->loadModel('ProductModel');
        $this->product_model = new ProductModel();
    }
    public function index()
    {
        return $this->view('main_admin_layout', ['page' => 'receipt']);
    }
}
