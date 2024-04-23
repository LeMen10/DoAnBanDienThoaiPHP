<?php
require './app/core/Controller.php';

class home extends Controller
{

    private $user_model, $product_model;
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
        $productsPerPage = 8;
        $page = 1;
        $products = $this->product_model->getPhones($productsPerPage, $page);
        
        return $this->view('main_layout', ['page' => 'home', 'products' => $products]);
    }

    function getUserName()
    {
        if (!isset($_COOKIE['token'])) {
            header('Location: index.php?ctrl=login');
            exit();
        }
        $token = $_COOKIE['token'];
        $jwt = new jwt();
        $data = $jwt->decodeToken($token);
        $user = $this->user_model->getUserByID($data['id']);
        echo json_encode(['success' => true, 'user' => $user, 'data' => $data]);
    }
    function GetSuggestion()
    {
        $stringFind = $_POST['stringFind'];
        $suggestions = $this->product_model->GetSuggestion($stringFind);
        echo json_encode(['success' => true, 'suggest' => $suggestions]);
    }
    public function logout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            setcookie('token', '', time() - 1, '/');
            echo json_encode(['success' => true]);
        }
    }
}
