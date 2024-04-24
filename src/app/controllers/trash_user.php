<?php
require './app/core/Controller.php';

class trash_user extends Controller
{
    private $user_model;
    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->user_model = new UserModel();
    }
    public function index()
    {
        $customers = $this->user_model->getAllCustomerDeleted();
        return $this->view('main_admin_layout', ['page' => 'trash_user', 'customers' => $customers]);
    }
    public function restore_customer()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $this->user_model->restore_customer($id);
            echo json_encode(['success' => true, 'id' => $id]);
        }
    }
    public function restore_multiple_customer()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $arrID = $_POST['arrID'];
            $this->user_model->restore_multiple_customer($arrID);
            echo json_encode(['success' => true, 'arrID' => $arrID]);
        }
    }
}
