<?php
require './app/core/Controller.php';

class cart extends Controller
{
    private $cart_model;
    public function __construct()
    {
        $this->loadModel('CartModel');
        $this->cart_model = new CartModel();
        require_once './app/middlewares/jwt.php';
    }
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) header("Location: index.php?ctrl=login");
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'customer') header("Location: index.php?ctrl=login");
            $cart = $this->cart_model->getCart($data['id']);
            return $this->view('main_layout', ['page' => 'cart', 'cart' => $cart]);
        }
    }

    public function update_quantity()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 401]));
            $id = $_POST['id'];
            $quantity = $_POST['quantity'];
            $variantID = $this->cart_model->getVariantID($id);
            $rs = $this->cart_model->checkStock($variantID['variantID']);
            if (intval($quantity) > intval($rs['quantity'])) {
                echo json_encode(['message' => 'Exceed the scope']);
                return;
            }

            $this->cart_model->updateQuantity($id, $quantity);
            echo json_encode(['success' => true, 's' => $rs['quantity']]);
        }
    }
    public function remove_item()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 401]));
            $id = $_POST['id'];
            $this->cart_model->removeItem($id);
            echo json_encode(['success' => true, 'id' => $id]);
        }
    }

    public function getCountItemCart()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 401]));
            $count = $this->cart_model->getCountItemCart($data['id']);
            echo json_encode(['success' => true, 'count' => $count['count']]);
        }
    }
}
