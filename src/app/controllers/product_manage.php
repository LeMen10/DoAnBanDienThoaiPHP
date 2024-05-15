<?php
require './app/core/Controller.php';

class product_manage extends Controller
{
    private $product_model;
    public function __construct()
    {
        $this->loadModel('ProductModel');
        $this->product_model = new ProductModel();
    }
    public function index()
    {
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $products = $this->product_model->getAllPhoneByPage($page);
        $quantity = $this->product_model->getQuantityPhone();
        // $quantity = $this->product_model->getQuantityPhone();
        return $this->view('main_admin_layout', ['page' => 'product_admin', 'products' => $products, 'quantity' => $quantity] ); 
        
    }
    public function load_data()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $page = isset($_GET["page"]) ? $_GET["page"] : 1;
            $quantity = $this->product_model->getQuantityPhone();
            $products = $this->product_model->getAllPhoneByPage($page);
            echo json_encode(["success" => true,'products'=>$products]); 
        }
        
    }
    public function delete_phone(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $products = $this->product_model->DeletePhone($id);
            echo json_encode(["success" => true]); 
        }
    }
    public function delete_phone_by_checkbox(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $result = $this->product_model->DeletePhoneByCheckbox($id);
            echo json_encode(["success" => true]); 
        }
    }
    public function show_update_phone(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $products = $this->product_model->getAllPhoneForUpdate($id);
            $category =$this->product_model->getCategory();
            echo json_encode(["success" => true, 'products'=>$products, 'categorys' => $category]); 
        } 
    }
    public function get_category(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $category =$this->product_model->getCategory();
            echo json_encode(["success" => true, 'categorys' => $category]); 
        } 
    }
    public function update_color(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $variantid = $_POST['variantID'];
            $color = $_POST['color'];
            $product = $this->product_model->getAllPhoneForUpdate($variantid);
            $this->product_model->updateColor($product["phoneID"],$product["colorID"], $color);
            echo json_encode(["success" => true]); 
        }
    }
    public function update_variant(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $variantid = $_POST['variantID'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $size = $_POST['size'];
            $this->product_model->updateVariant($variantid,$price, $quantity, $size);
            echo json_encode(["success" => true]); 
        }
    }
    public function update_namephone(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $variantid = $_POST['variantID'];
            $name = $_POST['name'];
            $category = $_POST['category'];
            $product = $this->product_model->getAllPhoneForUpdate($variantid);
            $sql = $this->product_model->updateNamePhone($product["phoneID"], $name, $category);
            echo json_encode(["success" => true, "sql" => $sql]); 
        }
    }
    public function update_spec(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $variantid = $_POST['variantID'];
            $chipset = $_POST['chipset']; 
            $cpuType = $_POST['cpuType']; 
            $bodySize = $_POST['bodySize']; 
            $bodyWeight = $_POST['bodyWeight']; 
            $screenFeature = $_POST['screenFeature']; 
            $screenResolution = $_POST['screenResolution']; 
            $screenSize = $_POST['screenSize']; 
            $screenTech = $_POST['screenTech']; 
            $os = $_POST['os'];
            $videoCapture = $_POST['videoCapture'];
            $cameraFront = $_POST['cameraFront']; 
            $cameraBack = $_POST['cameraBack'];
            $cameraFeature = $_POST['cameraFeature']; 
            $battery = $_POST['battery']; 
            $sim = $_POST['sim']; 
            $networkSupport = $_POST['networkSupport']; 
            $wifi = $_POST['wifi']; 
            $misc = $_POST['misc']; 

            
            $product = $this->product_model->getAllPhoneForUpdate($variantid);
            $this->product_model->updateDetailSpec($product["phoneID"], $chipset, $cpuType, $bodySize, 
            $bodyWeight, $screenFeature, $screenResolution, $screenSize, $screenTech, 
            $os,$videoCapture,$cameraFront, $cameraBack,$cameraFeature, $battery, $sim, 
            $networkSupport, $wifi, $misc);
            echo json_encode(["success" => true]); 
        }
    }
    public function update_imagephone(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $variantid = $_POST['variantID'];
            $image = $_POST['image'];
            $product = $this->product_model->getAllPhoneForUpdate($variantid);
            $this->product_model->updateImagePhone($product["phoneID"], $product["colorID"], $image);
            echo json_encode(["success" => true]); 
        }
    }
    public function update_colorphone(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $variantid = $_POST['variantID'];
            $color = $_POST['color'];
            $product = $this->product_model->getAllPhoneForUpdate($variantid);
            $check = $this->product_model->CheckColorOfPhone($product["phoneID"], $color);
            if($check != [] && $check["COUNT"] == 0){
                $this->product_model->UpdateColorOfPhone($product["phoneID"], $color, $product["colorID"]);
            }
            echo json_encode(["success" => true,  "check" => $check["COUNT"]]); 
        }
    }
    public function insert_phone(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $category = $_POST['categoryid'];
            $color = $_POST['color'];
            $size = $_POST['size'];
            $check = $this->product_model->CheckInsertPhone($name,$size,$category,$color);
            if($check != null && $check["COUNT"] != 0){
                echo json_encode(["success" => true,  "duplicate" => "Sản phẩm đã tồn tại!"]); 
            }else{
                $insertphone = $this->product_model->InsertPhone($name,$category);
                $insertcolor = $this->product_model->InsertColor($color,$insertphone);
                $this->product_model->InsertSize($size,$insertphone, $insertcolor);
                echo json_encode(["success" => true,"mess" => "Thêm sản phẩm thành công!"]);
            }
            
        }
    }
}
