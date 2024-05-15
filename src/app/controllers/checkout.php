<?php
require './app/core/Controller.php';

class checkout extends Controller
{
    private $checkout_model;
    public function __construct()
    {
        $this->loadModel('CheckoutModel');
        $this->checkout_model = new CheckoutModel();
        require_once './app/middlewares/jwt.php';
    }
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) header("Location: index.php?ctrl=login");
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) header("Location: index.php?ctrl=login");
            if ($data['authorName'] != 'customer') header("Location: index.php?ctrl=myerror&act=forbidden");
            $rs = [];
            if(isset($_GET['data_id'])){
                $dataID = $_GET['data_id'];
                $rs = $this->checkout_model->getCheckout($dataID, $data['id']);
            }
            else if(isset($_GET['order_id'])){
                $orderID = $_GET['order_id'];
                $rs = $this->checkout_model->getCheckout("", $data['id'], $orderID);
            }
            $address = $this->checkout_model->getActiveAddress($data['id']);
            return $this->view('main_layout', ['page' => 'checkout', 'checkout' => $rs, 'address' => $address]);
        }
    }
    public function get_address()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) exit(json_encode(['status' => 401]));
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 403]));
            $address = $this->checkout_model->getAddress($data['id']);
            echo json_encode(['success' => true, 'address' => $address]);
        }
    }

    public function save_address()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) exit(json_encode(['status' => 401]));
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 403]));
            $provinceID = $_POST['provinceID'];
            $districtID = $_POST['districtID'];
            $wardsID = $_POST['wardsID'];
            $recipientName = $_POST['name'];
            $recipientPhone = $_POST['phone'];
            $detail = $_POST['detail'];
            $active = $_POST['active'];
            $this->checkout_model->saveAddress(
                $data['id'],
                $provinceID,
                $districtID,
                $wardsID,
                $recipientName,
                $recipientPhone,
                $detail,
                $active
            );
            echo json_encode(['success' => true]);
        }
    }

    public function update_address()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) exit(json_encode(['status' => 401]));
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 403]));
            $id = $_POST['addressID'];
            $provinceID = $_POST['provinceID'];
            $districtID = $_POST['districtID'];
            $wardsID = $_POST['wardsID'];
            $recipientName = $_POST['name'];
            $recipientPhone = $_POST['phone'];
            $detail = $_POST['detail'];
            $this->checkout_model->updateAddress(
                $id,
                $provinceID,
                $districtID,
                $wardsID,
                $recipientName,
                $recipientPhone,
                $detail
            );
            echo json_encode(['success' => true, '1' => $recipientName]);
        }
    }

    public function get_address_editing()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) exit(json_encode(['status' => 401]));
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 403]));
            $id = $_GET['id'];
            $address = $this->checkout_model->getAddressEditing($id);
            echo json_encode(['success' => true, 'address' => $address]);
        }
    }

    public function get_active_address()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) exit(json_encode(['status' => 401]));
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 403]));
            $address = $this->checkout_model->getActiveAddress($data['id']);
            echo json_encode(['success' => true, 'address' => $address]);
        }
    }

    public function get_province()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) exit(json_encode(['status' => 401]));
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 403]));
            $province = $this->checkout_model->getProvince();
            echo json_encode(['success' => true, 'province' => $province]);
        }
    }

    public function get_district()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) exit(json_encode(['status' => 401]));
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 403]));
            $id = $_GET['id'];
            $district = $this->checkout_model->getDistrict($id);
            echo json_encode(['success' => true, 'district' => $district]);
        }
    }

    public function get_wards()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) exit(json_encode(['status' => 401]));
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 403]));
            $id = $_GET['id'];
            $wards = $this->checkout_model->getWards($id);
            echo json_encode(['success' => true, 'wards' => $wards]);
        }
    }

    public function change_active_address()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) exit(json_encode(['status' => 401]));
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 403]));
            $addressID = $_GET['addressIdActive'];
            $wards = $this->checkout_model->changeActiveAddress($addressID, $data['id']);
            echo json_encode(['success' => true, 'wards' => $wards]);
        }
    }

    public function save_order()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) exit(json_encode(['status' => 401]));
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 403]));
            $addressID = $_POST['addressId'];
            $dataID = $_POST['dataID'];
            $totalPayment = $_POST['totalPayment'];
            $orderStatus = $_POST['orderStatus'];
            $orderID = $this->checkout_model->saveOrder($addressID, $totalPayment, $orderStatus, $data['id']);
            $this->checkout_model->saveOrderDetail($dataID, $orderID);
            echo json_encode(['success' => true]);
        }
    }

    public function get_checkout_data()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) exit(json_encode(['status' => 401]));
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 403]));
            $dataID = $_GET['dataID'];
            $rs = $this->checkout_model->getCheckout($dataID, $data['id']);
            echo json_encode(['success' => true, 'data' => $rs]);
        }
    }

    public function update_stock_variant()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_COOKIE['token'])) exit(json_encode(['status' => 401]));
            $jwt = new jwt();
            $data = $jwt->decodeToken($_COOKIE['token']);
            if (!$data) exit(json_encode(['status' => 401]));
            if ($data['authorName'] != 'customer') exit(json_encode(['status' => 403]));
            $checkoutData = $_POST['checkoutData'];
            $this->checkout_model->updateStockVariant($checkoutData);
            echo json_encode(['success' => true]);
        }
    }
}
