<?php
require './app/core/Controller.php';

class cart extends Controller
{
    private $cart_model;
    public function __construct()
    {
        $this->loadModel('CartModel');
        $this->cart_model = new CartModel();
    }
    public function index()
    {
        $cart = $this->cart_model->getCart();
        return $this->view('main_layout', ['page' => 'cart', 'cart' => $cart]);
    }
    public function update_quantity()
    {
        // $_SESSION['user_id']
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $quantity = $_POST['quantity'];
            $rs = $this->cart_model->checkStock($id);
            $stock = 0;
            foreach ($rs as $item) {
                $stock = $item['quantity'];
            }
            // echo json_encode(["st" => $stock]);
            // $stock = json_decode($rs);
            if (intval($quantity) > intval($stock)) {
                echo json_encode(["message" => "Exceed the scope"]);
                return;
            }

            // echo json_encode(["error" => "Exceed the scope", "q" => intval($quantity), "id" => intval($stock)]); return;

            $this->cart_model->updateQuantity( $id, $quantity );
            echo json_encode(["success" => true]);
        }
    }
    public function remove_item()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->cart_model->removeItem($id);
            echo json_encode(["success" => true, "id" => $id]);
        }
    }
}
