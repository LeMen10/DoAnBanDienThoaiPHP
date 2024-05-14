<?php
require './app/core/Controller.php';

class trash_user extends Controller
{
    private $user_model;
    private $product_model;
    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->user_model = new UserModel();
        $this->loadModel('ProductModel');
        $this->product_model = new ProductModel();
        require_once './app/middlewares/jwt.php';
    }
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) header("Location: index.php?ctrl=login");
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'admin') header("Location: index.php?ctrl=login");
            $query = isset($_GET['search']) ? $_GET['search'] : '';
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            // $trash_products_per_page = $this->product_model->getTrashProductPerPage($page, $query);
            // $all_trash_products = $this->product_model->getAllTrashProduct($query);
            // $quantity = count($all_trash_products);
            // return $this->view('main_admin_layout', ['page' => 'trash_product', 'quantity' => $quantity, 'trash_products_per_page' => $trash_products_per_page]);
            $CountCustomer = $this->user_model->getAllCustomerDeleted();
            $customers = $this->user_model->getAllCustomerDeletedPerPage($page);
            return $this->view('main_admin_layout', ['page' => 'trash_user', 'customers' => $customers , "CountCustomer" => $CountCustomer]);
        }
    }
    public function restore_customer()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'admin') exit(json_encode(['status' => 401]));
            $id = $_POST['id'];
            $this->user_model->restore_customer($id);
            echo json_encode(['success' => true, 'id' => $id]);
        }
    }
    public function restore_multiple_customer()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'admin') exit(json_encode(['status' => 401]));
            $arrID = $_POST['arrID'];
            $this->user_model->restore_multiple_customer($arrID);
            echo json_encode(['success' => true, 'arrID' => $arrID]);
        }
    }
}
