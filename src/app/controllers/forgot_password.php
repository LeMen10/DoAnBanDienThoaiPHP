<?php
require './app/core/Controller.php';

class forgot_password extends Controller
{
    private $forgotPassword_model;
    public function __construct()
    {
        $this->loadModel('ForgotPasswordModel');
        $this->forgotPassword_model = new ForgotPasswordModel();
    }
    public function index()
    {
        return $this->view('main_layout', ['page' => 'forgot_password']);
    }
    public function CheckExistEmail(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {        
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 401]));
            $email = $_POST['email'];
            $check = $this->forgotPassword_model->CheckExistEmail($email);
            echo json_encode(['success'=>true, 'check' => $check]);
        }
    }
    
}