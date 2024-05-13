<?php
require './app/core/Controller.php';

class user_manage extends Controller
{
    private $user_model;
    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->user_model = new UserModel();
        require_once './app/middlewares/jwt.php';
    }
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) header("Location: index.php?ctrl=login");
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            $checkShow = $this->user_model->checkPermission($data['authorID'], 2);
            if($checkShow['show'] == 0) header("Location: index.php?ctrl=myerror&act=forbidden");

            $page = isset($_GET["page"]) ? $_GET["page"] : 1;
            $search = isset($_GET["search"]) ? $_GET["search"] : "";
            $users = $this->user_model->getAllUserByPage($page,$search);
            $quantity = $this->user_model->QuantityUser();
            // $quantity = $this->product_model->getQuantityPhone();
            return $this->view('main_admin_layout', ['page' => 'user_admin', 'users' => $users, 'quantity' => $quantity] ); 
        }
    }
    public function load_data(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $page = isset($_GET["page"]) ? $_GET["page"] : 1;
            $users = $this->user_model->getAllUserByPage($page);
            echo json_encode(["success" => true,'users'=>$users]); 
        }
    }
    public function delete_user(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $products = $this->user_model->DeleteUser($id);
            echo json_encode(["success" => true]); 
        }
    }
    public function get_user(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $users = $this->user_model->GetUser($id);
            $author = $this->user_model->GetAuthor();
            echo json_encode(["success" => true,'users'=> $users,'author'=> $author]); 
        }
    }
    public function get_author(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $author = $this->user_model->GetAuthor();
            echo json_encode(["success" => true,'author'=> $author]); 
        }
    }
    public function update_user(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $author = $_POST['author'];
            $this->user_model->updateUser($id,$name, $email, $author);
            echo json_encode(["success" => true]); 
        }
    }
    public function add_user(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $author = $_POST['author'];
            $this->user_model->insertUser($name, $email,$password, $author);
            echo json_encode(["success" => true]); 
        }
    }
    public function delete_user_by_checkbox(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $result = $this->user_model->DeleteUserByCheckbox($id);
            echo json_encode(["success" => true]); 
        }
    }
    public function search_user(){
        $name = $_POST['name'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $users = $this->user_model->SearchUser($name);
            echo json_encode(["success" => true,'users'=> $users]); 
        }
    }
}
