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
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $trash_products_per_page = $this->product_model->getTrashProductPerPage($page, $query);

        $all_trash_products = $this->product_model->getAllTrashProduct($query);
        $quantity = count($all_trash_products);
        return $this->view('main_admin_layout', ['page' => 'trash_product', 'quantity' => $quantity, 'trash_products_per_page' => $trash_products_per_page]);
    }
    public function restore_product()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $variant_id = isset($_POST['variantID']) ? $_POST['variantID'] : null;

                if ($variant_id) {
                    $valid = $this->product_model->getVariantOfTrashProductByIdVariant($variant_id);
                    if(count($valid) > 0) {
                        $isSuccess = $this->product_model->restoreVariantOfTrashProduct($variant_id);
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
