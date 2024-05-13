<?php
require './app/core/Controller.php';

class role extends Controller
{
    private $user_model;
    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->user_model = new UserModel();
        require_once './app/middlewares/jwt.php';
    }
    public function index(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) header("Location: index.php?ctrl=login");
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'admin') header("Location: index.php?ctrl=login");
            
            $author = $this->user_model->getAuthor();
            return $this->view('main_admin_layout', ['page' => 'role', 'author' => $author]);
        }
    }
    public function getFeature(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'admin') exit(json_encode(['status' => 401]));
            $id = $_GET['id'];
            
            $feature = $this->user_model->getFeature($id);
            echo json_encode(['success' => true, 'feature' => $feature]);
        }
    }
    public function saveRole(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) return $this->view('null_layout', ['page' => 'error/400']);
            if ($data['authorName'] != 'admin') exit(json_encode(['status' => 401]));
            $arrID = $_POST['arrID'];
            $this->user_model->saveRole($arrID);
            echo json_encode(['success' => true]);
        }
    }
}
