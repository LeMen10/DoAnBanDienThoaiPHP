<?php
require './app/core/Controller.php';

class checkout extends Controller
{
    private $checkout_model;
    public function __construct()
    {
        $this->loadModel('CheckoutModel');
        $this->checkout_model = new CheckoutModel();
    }
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data = $_GET['data_id'];
            $customerID = 1;
            $rs = $this->checkout_model->getCheckout($data, $customerID);
            $address = $this->checkout_model->getActiveAddress();
            return $this->view('main_layout', ['page' => 'checkout', 'checkout' => $rs, 'address' => $address]);
        }
    }
    public function get_addresses()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $address = $this->checkout_model->getAddresses();
            echo json_encode(['success' => true, 'address' => $address]);
        }
    }

    public function save_address()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $provinceID = $_POST['provinceID'];
            $districtID = $_POST['districtID'];
            $wardsID = $_POST['wardsID'];
            $recipientName = $_POST['name'];
            $recipientPhone = $_POST['phone'];
            $detail = $_POST['detail'];
            $this->checkout_model->saveAddress(
                $provinceID,
                $districtID,
                $wardsID,
                $recipientName,
                $recipientPhone,
                $detail
            );
            echo json_encode(['success' => true]);
        }
    }

    public function update_address()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            echo json_encode(['success' => true, '1'=> $recipientName]);
        }
    }

    public function get_address_editing()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = $_GET['id'];
            $address = $this->checkout_model->getAddressEditing($id);
            echo json_encode(['success' => true, 'address' => $address]);
        }
    }

    public function get_active_address()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $address = $this->checkout_model->getActiveAddress();
            echo json_encode(['success' => true, 'address' => $address]);
        }
    }

    public function get_province()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $province = $this->checkout_model->getProvince();
            echo json_encode(['success' => true, 'province' => $province]);
        }
    }

    public function get_district()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = $_GET['id'];
            $district = $this->checkout_model->getDistrict($id);
            echo json_encode(['success' => true, 'district' => $district]);
        }
    }

    public function get_wards()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = $_GET['id'];
            $wards = $this->checkout_model->getWards($id);
            echo json_encode(['success' => true, 'wards' => $wards]);
        }
    }

    public function change_active_address()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $addressID = $_GET['addressIdActive'];
            $userID = 1;
            $wards = $this->checkout_model->changeActiveAddress($addressID, $userID);
            echo json_encode(['success' => true, 'wards' => $wards]);
        }
    }

    public function save_order()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $addressID = $_POST['addressId'];
            $dataID = $_POST['dataID'];
            $totalPayment = $_POST['totalPayment'];
            $orderStatus = $_POST['orderStatus'];
            $userID = 1;
            $orderID = $this->checkout_model->saveOrder($addressID, $totalPayment, $orderStatus, $userID);
            $this->checkout_model->saveOrderDetail($dataID, $orderID);
            echo json_encode(['success' => true]);
        }
    }

    public function get_checkout_data()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data = $_GET['dataID'];
            $customerID = 1;
            $rs = $this->checkout_model->getCheckout($data, $customerID);
            echo json_encode(['success' => true, 'data' => $rs]);
        }
    }
}
