<?php
require './app/core/Controller.php';
class login extends Controller
{
    private $acc_model;
    public function __construct()
    {
        $this->loadModel('AccountModel');
        $this->acc_model = new AccountModel();
    }
    public function index()
    {
        return $this->view('null_layout', ['page' => 'login']);
    }
    public function Login(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->acc_model->CheckLogin($email,$password);
            
            echo json_encode(['success'=>true, 'user'=> $user]);
        }
    }

}