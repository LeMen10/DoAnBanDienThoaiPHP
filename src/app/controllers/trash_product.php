<?php
require './app/core/Controller.php';

class trash_product extends Controller
{
    private $product_model;
    public function __construct()
    {
        $this->loadModel('ProductModel');
        $this->product_model = new ProductModel();
    }
    public function index()
    {
        return $this->view('main_admin_layout', ['page' => 'trash_product']);
    }
    public function restore_product()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $product_id = isset($_POST['id']) ? $_POST['id'] : null;

                if ($product_id) {
                    $valid = $this->product_model->getTrashProductByID($product_id);
                    if(count($valid) > 0) {
                        $isSuccess = $this->product_model->restoreProduct($product_id);
                        if($isSuccess) {
                            echo json_encode(array('success' => true));
                            return;
                        } else {
                            echo json_encode(array('success' => false, 'message' => 'Lỗi khi khôi phục sản phẩm'));
                            return;
                        }
                    } else {
                        echo json_encode(array('success' => false, 'message' => 'Không tìm thấy ID sản phẩm'));
                        return;
                    }
                } 
            }
        }
    }
    public function show()
    {
    }
}
