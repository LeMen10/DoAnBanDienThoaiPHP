<?php
require './app/core/Controller.php';

class detail extends Controller
{
    private $product_model;
    public function __construct()
    {
        $this->loadModel('DetailProductModel');
        $this->product_model = new DetailProductModel();
    }
    public function index()
    {
        $phoneID = 0;
        if(isset($_GET['phoneID']))
        {
            $phoneID = $_GET['phoneID'];
        }
        $productDetail = $this->product_model-> getProductDetail($phoneID);
        $Variants = $this->product_model->getAllProductVariants($productDetail["phoneID"]);
        $Colors = $this->product_model->getAllColorSize($phoneID, $Variants[0]["sizeID"]);
        $Images = $this->product_model->getAllImage($phoneID);
        return $this->view('main_layout', 
        ['page' => 'detail', 'productDetail' => $productDetail, 'Variants' => $Variants,
         'Colors' => $Colors, 'Images' => $Images]);
    }
    public function getAllColor()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $phoneID = $_POST['phoneID'];
            $sizeID = $_POST['sizeID'];
            $Colors =  $this->product_model->getAllColorSize($phoneID, $sizeID);
            $Variant = $this->product_model -> getVariant($phoneID, $sizeID, $Colors[0]["colorID"]);
            echo json_encode(['success'=>true, 'colors'=> $Colors, 'variant' => $Variant]);
        }
    }
    public function getVariant()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $phoneID = $_POST['phoneID'];
            $sizeID = $_POST['sizeID'];
            $colorID = $_POST['colorID'];
            $Variant = $this->product_model -> getVariant($phoneID, $sizeID, $colorID);
            echo json_encode(['success'=>true,'variant' => $Variant]);
        }
    }

    public function addToCart()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $phoneID = $_POST['phoneID'];
            $sizeID = $_POST['sizeID'];
            $colorID = $_POST['colorID'];
            $userID = $_POST['userID'];
            $quantity = $_POST['quantity'];
            $Variant = $this->product_model -> getVariant($phoneID, $sizeID, $colorID);
            $Cart = null;
            if($this->product_model -> addToCart($Variant['id'], $quantity, $userID))
            {
                $Cart = $this->product_model -> getTotalCart($userID);
            }
            echo json_encode(['success'=>true,'cart' => $Cart]);
        }
    }
    public function show()
    {
    }
}
