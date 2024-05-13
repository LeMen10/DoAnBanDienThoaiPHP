<?php
require './app/core/Controller.php';

class order_manage extends Controller
{
    private $order_model;
    public function __construct()
    {
        $this->loadModel('OrderModel');
        $this->order_model = new OrderModel();
        require_once './app/middlewares/jwt.php';
    }
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!isset($_COOKIE['token'])) header("Location: index.php?ctrl=login");
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'admin') header("Location: index.php?ctrl=login");
            $page = isset($_GET["page"]) ? $_GET["page"] : 1;
            $orders = $this->order_model->GetAllOrderByPage($page);
            $quantity = $this->order_model->GetQuantityOrder();
            
            // $id = $_POST['id_product'];
            $order = $this->order_model->GetAllOrder();
            // $order_detail = $this->order_model->GetDetailOrderProduct($id);

            //$sort = $this->order_model->SortByDate();
            return $this->view('main_admin_layout', ['page' => 'order_admin', 'order' => $order, 'orders'=> $orders, 'quantity'=> $quantity]);
        }
    }

    public function GetDetailProduct(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'admin') exit(json_encode(['status' => 401]));
            $id = $_POST['id'];
            $order_detail = $this->order_model->GetDetailOrderProduct($id);
            echo json_encode(['success'=>true, 'order_detail'=> $order_detail]);
        }
    }
    public function UpdateOrderStatus(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'admin') exit(json_encode(['status' => 401]));
            $id = $_POST['id'];
            $status = $_POST['value'];
            $isSuccess = $this->order_model->UpdateStatus($id,$status);
            echo json_encode(['success'=>true, 'isSuccess'=> $isSuccess]);
        }
    }
    public function Search_Admin(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'admin') exit(json_encode(['status' => 401]));
            $ten = $_POST['ten'];
            $result = $this->order_model->Search($ten);
            echo json_encode(['success'=>true, 'search'=> $result]);
        }
    }
    
}
