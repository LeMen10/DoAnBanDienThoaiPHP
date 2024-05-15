<?php
require './app/core/Controller.php';

class admin extends Controller
{
    private $product_model, $user_model, $order_model;
    public function __construct(){
        $this->loadModel('ProductModel');
        $this->product_model = new ProductModel();
        $this->loadModel('UserModel');
        $this->user_model = new UserModel();
        $this->loadModel('OrderModel');
        $this->order_model = new OrderModel();
        require_once './app/middlewares/jwt.php';
    }
    public function index(){
        if (!isset($_COOKIE['token'])) header('Location: index.php?ctrl=login');
        $jwt = new jwt();
        $data = $jwt->decodeToken($_COOKIE['token']);
        $checkRole = $this->user_model->checkPermission($data['authorID'], 1);
        if($checkRole['show'] == 0) header("Location: index.php?ctrl=myerror&act=forbidden");
        return $this->view('main_admin_layout', ['page' => 'home_admin']);
        
    }

    public function getSellingProducts(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            $checkRole = $this->user_model->checkPermission($data['authorID'], 1);
            if($checkRole['show'] == 0 || $checkRole['edit'] == 0) exit(json_encode(['status' => 403]));
            $since = $_GET['since'];
            $toDate = $_GET['toDate'];
            $data = $this->product_model->getSellingProducts($since, $toDate);
            echo json_encode(['success' => true, 'data' => $data]);
        }
    }

    public function getBusinessSituation(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            $checkRole = $this->user_model->checkPermission($data['authorID'], 1);
            if($checkRole['show'] == 0 || $checkRole['edit'] == 0) exit(json_encode(['status' => 403]));
            $since = $_GET['sinceBusiness'];
            $toDate = $_GET['toDateBusiness'];
            $data = $this->product_model->getBusinessSituation($since, $toDate);
            echo json_encode(['success' => true, 'data' => $data]);
        }
    }

    public function getStatisticOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            $checkRole = $this->user_model->checkPermission($data['authorID'], 1);
            if($checkRole['show'] == 0) exit(json_encode(['status' => 403]));
            $data = $this->order_model->getStatisticOrder();
            $QuantityDay = $this->order_model->GetStatisticQuantityByDay();
            $QuantityYear = $this->order_model->GetStatisticQuantityByYear();
            $PaymentDay = $this->order_model->GetStatisticPaymentByDay();
            $PaymentYear = $this->order_model->GetStatisticPaymentByYear();
            echo json_encode(['success' => true, 'data' => $data,
             "quantityDay" =>  $QuantityDay["soLuong"], "quantityYear" => $QuantityYear["soLuong"], 
             "paymentDay" => $PaymentDay["tongTien"], "paymentYear" => $PaymentYear["tongTien"]]);
        }
    }
}
