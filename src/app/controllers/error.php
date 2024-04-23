<?php
require './app/core/Controller.php';

class detail extends Controller
{
    private $product_model;
    public function __construct()
    {
        $this->loadModel('DetailProductModel');
        $this->product_model = new DetailProductModel();
        require_once './app/middlewares/jwt.php';
    }

    public function notFound()
    {
        
    }


}