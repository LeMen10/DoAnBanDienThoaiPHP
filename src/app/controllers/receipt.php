<?php
require './app/core/Controller.php';

class receipt extends Controller
{
    private $receipt_model, $user_model;
    public function __construct()
    {
        $this->loadModel('ReceiptModel');
        $this->receipt_model = new ReceiptModel();
        
        $this->loadModel('UserModel');
        $this->user_model = new UserModel();
        require_once './app/middlewares/jwt.php';
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
            $suppliers = $this->receipt_model->getAllSupplier();
            return $this->view('main_admin_layout', ['page' => 'receipt', 'suppliers'=> $suppliers]);
        }
    }
    public function GetPhoneNameByCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $categoryid = $_POST['categoryid'];
            $phonename = $this->receipt_model->getPhoneNameByCategory($categoryid);
            echo json_encode(["success" => true, 'phonename'=>$phonename]); 
        } 
        
    }
    public function GetSizeByPhoneID()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $phoneid = $_POST['phoneid'];
            $sizes = $this->receipt_model->getSizeByPhoneID($phoneid);
            echo json_encode(["success" => true, 'sizes'=>$sizes]); 
        } 
        
    }
    public function GetColorByColorID()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sizeid = $_POST['sizeid'];
            $phoneid = $_POST['phoneid'];
            $colors = $this->receipt_model->getColorByColorID($sizeid, $phoneid);
            echo json_encode(["success" => true, 'colors'=>$colors]); 
        } 
        
    }
    public function GetAllSupplier()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $suppliers = $this->receipt_model->getAllSupplier();
            echo json_encode(["success" => true, 'suppliers'=>$suppliers]); 
        } 
        
    }
    public function InsertReceipt()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_COOKIE['token'])) header("Location: index.php?ctrl=login");
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            $checkShow = $this->user_model->checkPermission($data['authorID'], 3);
            if($checkShow['show'] == 0) header("Location: index.php?ctrl=myerror&act=forbidden");
            $employeeID =  $data["id"];
            $supplierID = $_POST['supplierID'];
            $receiptsID = $this->receipt_model->insertReceipt($supplierID, $employeeID);
            echo json_encode(["success" => true, "receiptsID" => $receiptsID]); 
        } 
        
    }
    public function InsertReceiptDetail()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $sizeID = $_POST['sizeID'];
            $phoneID = $_POST['phoneID'];
            $colorID = $_POST['colorID'];
            $receiptID = $_POST['receiptID'];
            $variantID = $this->receipt_model->getVariant($phoneID, $sizeID, $colorID);
            $checksucsess = $this->receipt_model->InsertorUpdateReceiptDetail($receiptID,$variantID, $quantity, $price);
            echo json_encode(["success" => true, "checksucsess" => $checksucsess]); 
        } 
        
    }
    public function GetAllProductInReceipt()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $receiptID = $_POST['receiptID'];
            $receiptDetail = $this->receipt_model->GetAllProductInReceipt($receiptID);
            echo json_encode(["success" => true, 'receiptDetail'=>$receiptDetail]); 
        } 
        
    }
    public function DeleteProductInReceipt()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $receiptID = $_POST['receiptID'];
            $variantID = $_POST['variantID'];
            $check = $this->receipt_model->DeleteProductInReceipt($variantID,$receiptID);
            echo json_encode(["success" => true, 'check'=>$check]); 
        } 
        
    }
    public function UpdateVariantByReceiptDetail()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $receiptID = $_POST['receiptID'];
            $receiptDetail = $this->receipt_model->GetAllProductInReceipt($receiptID);
            $check = $this->receipt_model->checkReceiptDetail($receiptID);
            if($check == true){
                foreach ($receiptDetail as $item) {
                    $variant = $this->receipt_model->GetOneVariant($item["id"]);
                    if($variant[0]["price"] > $item["price"]){
                        $check = $this->receipt_model->UpdateVariantByReceiptDetail($item["id"], $variant[0]["price"], $item["quantity"]+$variant[0]["quantity"]);
                    }else{
                        $check = $this->receipt_model->UpdateVariantByReceiptDetail($item["id"], $item["price"]*1.1, $item["quantity"]+$variant[0]["quantity"]);
                    }
                }
            }else{
                $check = 3;
            }
            echo json_encode(["success" => true, 'check'=>$check]); 
        } 
        
    }
}
