<?php
require './app/core/Controller.php';
class register extends Controller
{
    private $acc_model;
    public function __construct()
    {
        $this->loadModel('AccountModel');
        $this->acc_model = new AccountModel();
    }
    public function index()
    {
        return $this->view('null_layout', ['page' => 'register']);
    }
    public function register(){
        return $this->view('null_layout', ['page' => 'register']);
    }
    public function CheckRegister(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {           
            $email = $_POST['email'];
            $check = $this->acc_model->CheckRegister($email);
            // $acc = $this->acc_model->LoadAllCustomer($email,$password);
            // echo json_encode(['success'=>true, 'acc'=> $acc]);
            echo json_encode(['success'=>true, 'check' => $check]);
        }
    }

    public function InsertAccount () {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {      
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $check = $this->acc_model->Register($firstName,$lastName,$email,$password);
            echo json_encode(['success'=>true, 'check' => $check]);
        }
    }
}