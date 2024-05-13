<?php
require './app/core/Controller.php';

class reset extends Controller
{
    private $forgot_model;
    public function __construct()
    {
        $this->loadModel('ForgotPasswordModel');
        $this->forgot_model = new ForgotPasswordModel();
    }
    public function index()
    {   
        $email = "";
        if(isset($_GET['email'])) $email = $_GET['email'];
        return $this->view('null_layout', ['page' => 'reset', 'email'=> $email]);
    }

    public function CheckExistEmail(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {        
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'customer' || $data['authorName'] != 'admin') 
                exit(json_encode(['status' => 401]));
            $email = $_POST['email'];
            $check = $this->forgot_model->CheckExistEmail($email);
            echo json_encode(['success'=>true, 'check' => $check]);
        }
    }
    public function UpdatePassword(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'customer' || $data['authorName'] != 'admin') 
                exit(json_encode(['status' => 401]));
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $isSuccess = $this->forgot_model->UpdatePassword($email,$pass);
            
            echo json_encode(['success'=>true, 'isSuccess'=> $isSuccess]);
        }
    }
}