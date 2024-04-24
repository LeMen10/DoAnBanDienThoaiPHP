<?php
require './app/core/Controller.php';

class purchase_order extends Controller
{
    private $purchaseOrder_model;
    public function __construct()
    {
        $this->loadModel('purchaseOrderModel');
        $this->purchaseOrder_model = new purchaseOrderModel();
        require_once './app/middlewares/jwt.php';
    }
    public function index()
    {
        $orderID = 0;
        if(isset($_GET['orderID']))
        {
            $orderID = $_GET['orderID'];
            $orderDetail = $this->purchaseOrder_model -> getOrderDetailByID($orderID);
            $listProduct = $this->purchaseOrder_model ->  getListOrderProduct($orderID);
            $customerInfo = $this->purchaseOrder_model -> getCustomerInfoByOrderID($orderID);
            return $this->view('main_layout', ['page' => 'purchase_order', 'orderDetail' => $orderDetail,
            'customerInfo' => $customerInfo , 'listProduct' => $listProduct]);
        }
        else
        {
            $itemsPerPage = 5;
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
            $sortDate = isset($_GET['sort']) ? $_GET['sort'] : "";
            $Status =  isset($_GET['sl']) ? $_GET['sl'] : "All";

            if (!isset($_COOKIE['token'])) {
                return $this->view('null_layout', ['page' => 'error/400']);
            }

            $token = $_COOKIE['token'];
            $jwt = new jwt();
            $data = $jwt->decodeToken($token);
            if (!$data) {
                return $this->view('null_layout', ['page' => 'error/400']);
            }
            $listOrder = $this->purchaseOrder_model -> getOrdersByUserID($data["id"], $Status, $sortDate);
            $listOrderPerPage = $this->purchaseOrder_model -> getOrdersByUserIDAndPage($data["id"], $Status, $currentPage, $itemsPerPage, $sortDate);
            foreach ($listOrderPerPage as &$Order) {
                $Order['listProduct'] = $this->purchaseOrder_model ->  getListOrderProduct($Order["id"]);
            }
            unset($Order);
            return $this->view('main_layout', ['page' => 'purchase_order','listOrder' => $listOrder, 'listOrderPerPage' => $listOrderPerPage]);
        }     
    }
    public function getCustomerInfoByOrderID()
    {
        $result = false;
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $orderID = $_POST['orderID'];
            $result = $this->purchaseOrder_model-> getCustomerInfoByOrderID($orderID);  
        }
        echo json_encode(['success'=>true,'result' => $result]);
    }
    public function cancelOrder()
    {
        $result = false;
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $orderID = $_POST['orderID'];
            $result = $this->purchaseOrder_model-> cancelOrder($orderID);  
        }
        echo json_encode(['success'=>true,'result' => $result]);
    }
    public function getAllProvince()
    {
        $result = null;
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $result = $this->purchaseOrder_model-> getAllProvince();  
        }
        echo json_encode(['success'=>true,'listProvince' => $result]);
    }
    public function getAllDistrict()
    {
        $result = null;
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $provinceID = $_POST['provinceID'];
            $result = $this->purchaseOrder_model-> getAllDistrict($provinceID);  
        }
        echo json_encode(['success'=>true,'listDistrict' => $result]);
    }
    public function getAllWards()
    {
        $result = null;
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $districtID = $_POST['districtID'];
            $result = $this->purchaseOrder_model-> getAllWards($districtID);  
        }
        echo json_encode(['success'=>true,'listWards' => $result]);
    }
    public function saveAddress()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $orderID = $_POST['orderID'];
            $userID = $_POST['userID'];
            $Name = $_POST['Name'];
            $Phone = $_POST['Phone'];
            $P = $_POST['P'];
            $D = $_POST['D'];
            $W = $_POST['W'];
            $Detail = $_POST['Detail'];
            $result = $this->purchaseOrder_model-> saveAddress($userID,$Name, $Phone, $P, $D, $W, $Detail);
            $this->purchaseOrder_model-> changeAddressOrder($orderID, $result);
        }
        echo json_encode(['success'=>true]);
    }
    public function show()
    {
    }
}
