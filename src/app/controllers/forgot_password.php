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
        return $this->view('null_layout', ['page' => 'forgot_password']);
    }
    public function CheckExistEmail(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $check = $this->forgotPassword_model->CheckExistEmail($email);
            echo json_encode(['success'=>true, 'check' => $check]);
        }
    }
    
}