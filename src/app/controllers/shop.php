<?php
require './app/core/Controller.php';

class shop extends Controller
{
    private $product_model;
    private $query_sort_option = [
        "default" => "",
        "name_asc" => "ORDER BY p.name ASC",
        "name_desc" => "ORDER BY p.name DESC",
        "price_asc" => "ORDER BY v.price ASC",
        "price_desc" => "ORDER BY v.price DESC",
    ];
    private $query_weight_option = [
        "default" => "",
        "tu_duoi_170g" => "WHERE s.`bodyWeight` <= '170'",
        "tu_170g_den_200g" => "WHERE s.`bodyWeight` BETWEEN '170' AND '200'",
        "tu_200g_tro_len" => "WHERE s.`bodyWeight` >= '200'",
    ];
    public function __construct()
    {
        $this->loadModel('ProductModel');
        $this->product_model = new ProductModel();
    }
    public function index()
    {
        $result_all_categories = $this->product_model->getAllCategoriesAndCountByPhoneID();

        $count_tu_duoi_170g =$this->product_model->getPhoneWeightByWeightAndCountByPhoneID($this->query_weight_option["tu_duoi_170g"]);
        $count_tu_170g_den_200g =$this->product_model->getPhoneWeightByWeightAndCountByPhoneID($this->query_weight_option["tu_170g_den_200g"]);
        $count_tu_200g_tro_len =$this->product_model->getPhoneWeightByWeightAndCountByPhoneID($this->query_weight_option["tu_200g_tro_len"]);

        $productsPerPage = 6;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $sort = isset($_GET['sort']) ? $_GET['sort'] : "default";
        $brand = isset($_GET['brand']) ? $_GET['brand'] : "";
        $weight = isset($_GET['weight']) ? $_GET['weight'] : "default";

        $product_model = new ProductModel();
        $result_6_phones = $product_model->getPhonesByPageNumber($productsPerPage, $page, $this->query_sort_option[$sort], $brand, $this->query_weight_option[$weight]);

        if($page != 1 || $sort != "default" || $brand != "" || $weight != "default") {
            // lấy hết để hiển thị, phân trang
            $result_all_phone = $product_model->getAllPhoneAndDetails($brand, $this->query_weight_option[$weight]);
            $num_all_rows = count($result_all_phone);
        } else {
            // lấy hết để hiển thị, phân trang
            $result_all_phone = $product_model->getAllPhoneAndDetails();
            $num_all_rows = count($result_all_phone);
        }

        // $products = $this->product_model->getAll();
        return $this->view('main_layout', ['page' => 'shop', 
            'result_all_categories' => $result_all_categories,
            'count_tu_duoi_170g' => $count_tu_duoi_170g,
            'count_tu_170g_den_200g' => $count_tu_170g_den_200g,
            'count_tu_200g_tro_len' => $count_tu_200g_tro_len,
            'result_6_phones' => $result_6_phones,
            'num_all_rows' => $num_all_rows,
            'brand' => $brand,
            'weight' => $weight,
            'sort' => $sort,
            'productsPerPage' => $productsPerPage
        ]);
    }
    public function show()
    {
    }
}
