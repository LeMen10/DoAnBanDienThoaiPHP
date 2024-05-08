<?php
include_once './app/database/connect.php';
class ProductModel extends connect {
    public function getAll(){
        $sql = "SELECT * FROM phone";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getVariantOfTrashProductByIdVariant($id){
        $sql = "SELECT * FROM variant WHERE `visible` = 0 and `id` = ".$id."";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function restoreVariantOfTrashProduct($id) {
        $sql = "UPDATE `variant` SET `visible`= 1 WHERE id = ".$id."";
        $result = mysqli_query($this->con, $sql);
        
        if ($result && mysqli_affected_rows($this->con) > 0) {
            return true; 
        } else {
            return false; 
        }
    }
    
    public function getTrashProductPerPage($page, $query){
        $begin = ($page * 5) - 5;
        $sql = "
            SELECT c.name as category, p.id as id, p.name, price, image, v.size as size, cl.color as color, v.id as variantID
            FROM phone p 
            LEFT JOIN category c ON p.category = c.id 
            LEFT JOIN variant v ON p.id = v.phoneID 
            LEFT JOIN color cl ON p.id = cl.phoneID 
            LEFT JOIN (SELECT * FROM image ig GROUP BY ig.phoneID, ig.colorID) AS img ON p.id = img.phoneID 
            WHERE p.visible = 1 AND cl.colorID = v.colorID AND img.colorID = v.colorID AND v.visible = 0 AND p.name LIKE '%".$query."%'
            LIMIT ".$begin.",5
        ";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getAllTrashProduct($query){
        $sql = "
            SELECT v.id AS variantid, v.quantity AS quantity, p.name AS phonename, c.name AS category, cl.color, v.price, v.size, img.image
            FROM phone p 
            LEFT JOIN category c ON p.category = c.id 
            LEFT JOIN variant v ON p.id = v.phoneID 
            LEFT JOIN color cl ON p.id = cl.phoneID 
            LEFT JOIN (SELECT * FROM image ig GROUP BY ig.phoneID, ig.colorID) AS img ON p.id = img.phoneID 
            WHERE p.visible = 1 AND cl.colorID = v.colorID AND img.colorID = v.colorID AND v.visible = 0 AND p.name LIKE '%".$query."%'
        ";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    //========================================================ProductManager==============================
    public function CheckColorOfPhone($phoneid,$color){
        $sql = "SELECT COUNT(*) AS COUNT FROM `color` WHERE phoneiD = $phoneid AND color like '$color'";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        if($row = mysqli_fetch_assoc($result)) {
            $rows = $row;
        }
        return $rows;
    }
    public function UpdateColorOfPhone($phoneid,$color,$colorid){
        $sql = "UPDATE color SET color = '$color' WHERE colorID = $colorid AND phoneID = $phoneid";
        $result = mysqli_query($this->con, $sql); 
        return $result;
    }
    // public function UpdateColorOfPhone($phoneid,$color){
    //     $sql = "SELECT COUNT(*) `color` WHERE phoneiD = $phoneid AND color = '$color'";
    //     $result = mysqli_query($this->con, $sql);
    //     while ($row = mysqli_fetch_assoc($result)) {
    //         $rows[] = $row;
    //     }
    //     return $rows;
    // }
    public function updateImagePhone($phoneid,$colorid,$image ){
        $sql = "UPDATE `image` SET `image` = '$image' WHERE colorID = $colorid AND phoneID = $phoneid
        ";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }
    public function getCategory(){
        $sql = "SELECT * FROM category
        ";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function getProductByVariantID($phoneid,$colorid,$color){
        $sql = "UPDATE color SET color = '$color' WHERE colorID = $colorid AND phoneID = $phoneid
        ";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }
    public function updateColor($phoneid,$colorid,$color){
        $sql = "UPDATE color SET color = '$color' WHERE colorID = $colorid AND phoneID = $phoneid";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }
    public function updateNamePhone($phoneid,$namephone,$category){
        $sql = "UPDATE phone SET ".($namephone == "" ? "" : ("`name` = '$namephone'")).
        ",".($category == "" ? "" : ("category = $category"))." WHERE id = $phoneid";
        
        $result = mysqli_query($this->con, $sql);
        return $sql;
    }
    public function updateVariant($variantid,$price, $quantity, $size){
        $sql = "UPDATE variant 
        SET ".($price == "" ? "" : ("price = $price")).", 
        ".($quantity == "" ? "" : ("quantity = $quantity")).",
        ".($size == "" ? "" : ("`size` = '$size'"))."
        WHERE id = $variantid";
        $result = mysqli_query($this->con, $sql);
    }
    public function updateDetailSpec($phoneID,$chipset, $cpuType, $bodySize, 
    $bodyWeight, $screenFeature, $screenResolution, $screenSize, $screenTech, 
    $os,$videoCapture,$cameraFront, $cameraBack,$cameraFeature, $battery, $sim, 
    $networkSupport, $wifi, $misc){
        $sql = "UPDATE spec 
        SET ".($chipset == "" ? "" : ("chipset = '$chipset',"))."
            ".($cpuType == "" ? "" : ("cpuType = '$cpuType',"))."
            ".($bodySize == "" ? "" : ("bodySize = '$bodySize',"))."
            ".($bodyWeight == "" ? "" : ("bodyWeight = '$bodyWeight',"))."
            ".($screenFeature == "" ? "" : ("screenFeature = '$screenFeature',"))."
            ".($screenResolution == "" ? "" : ("screenResolution = '$screenResolution',"))."
            ".($screenSize == "" ? "" : ("screenSize = '$screenSize',"))."
            ".($screenTech == "" ? "" : ("screenTech = '$screenTech',"))."
            ".($os == "" ? "" : ("os = '$os',"))."
            ".($videoCapture == "" ? "" : ("videoCapture = '$videoCapture',"))."
            ".($cameraFront == "" ? "" : ("cameraFront = '$cameraFront',"))."
            ".($cameraBack == "" ? "" : ("cameraBack = '$cameraBack',"))."
            ".($cameraFeature == "" ? "" : ("cameraFeature = '$cameraFeature',"))."
            ".($battery == "" ? "" : ("battery = '$battery',"))."
            ".($sim == "" ? "" : ("sim = '$sim',"))."
            ".($networkSupport == "" ? "" : ("networkSupport = '$networkSupport',"))."
            ".($wifi == "" ? "" : ("wifi = '$wifi',"))."
            ".($misc == "" ? "" : ("misc = '$misc' "))."
        WHERE phoneID = $phoneID";
        $result = mysqli_query($this->con, $sql);
        return $sql;
    }
    public function getAllPhoneForUpdate($id){
        $sql = "SELECT v.id AS variantid, img.image, v.phoneID, v.colorID, p.name AS phonename, p.category AS categoryid,  
        v.size, cl.color,
        v.price, v.quantity AS quantity,sp.chipset, sp.cpuType, sp.bodySize, sp.bodyWeight, sp.screenTech,
        sp.screenSize, sp.screenResolution, sp.screenFeature, sp.cameraBack, sp.cameraFront, 
        sp.cameraFeature, sp.videoCapture,sp.battery, sp.sim, sp.networkSupport, 
        sp.wifi, sp.os, sp.misc
        FROM phone p LEFT JOIN category c ON p.category = c.id LEFT JOIN variant v ON p.id = v.phoneID 
        LEFT JOIN color cl ON p.id = cl.phoneID LEFT JOIN spec sp ON p.id = sp.phoneID 
        LEFT JOIN (SELECT * FROM image ig GROUP BY ig.phoneID, ig.colorID) AS img ON p.id = img.phoneID 
        WHERE p.visible = 1 AND cl.colorID = v.colorID AND img.colorID = v.colorID AND v.visible = 1 
        AND v.id=$id;";
        $result = mysqli_query($this->con, $sql);
        $products = [];
        if ($row = mysqli_fetch_assoc($result)) {
            $products = $row;
        }
        return $products;
    }
    public function addPhone($phone){
        $sql = "INSERT INTO variant (`id`, `phoneID`, `sizeID`, `size`, `colorID`, `price`, `quantity`,
         `visible`) VALUES ($phone[0],$phone[1],$phone[2],$phone[3],$phone[4],$phone[5],$phone[6],$phone[7]);
        ";
        $result = mysqli_query($this->con, $sql);
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        return $products;
    }
    public function getAllPhone(){
        $sql = "SELECT p.name AS phonename, c.name AS category, cl.color, v.price, v.size, img.image
        FROM phone p JOIN category c ON p.category = c.id JOIN variant v ON p.id = v.phoneID JOIN color cl ON p.id = cl.phoneID JOIN (SELECT * FROM image ig GROUP BY ig.phoneID, ig.colorID) AS img ON p.id = img.phoneID 
        WHERE p.visible = 1 AND cl.colorID = v.colorID AND img.colorID = v.colorID;
        ";
        $result = mysqli_query($this->con, $sql);
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        return $products;
    }
    public function DeletePhone($id){
        $sql = "UPDATE variant SET visible = 0 WHERE id = $id;";
        $result = mysqli_query($this->con, $sql);
        
    }
    public function DeletePhoneByCheckbox($id)
    {
        $temp = explode(',', $id);
        $resultString = '(' . implode(', ', $temp) . ')'; // (12,32,13,32)
        $sql = "UPDATE variant SET visible = 0 WHERE id IN $resultString;";
        $result = mysqli_query($this->con, $sql);
        return $result;
    }
    public function getAllPhoneByPage($page){
        $begin = ($page * 5) - 5;
        $sql = "SELECT v.id AS variantid, v.quantity AS quantity, p.name AS phonename, c.name AS category, cl.color, v.price, v.size, img.image, v.phoneID, v.colorID
        FROM phone p LEFT JOIN category c ON p.category = c.id LEFT JOIN variant v ON p.id = v.phoneID LEFT JOIN color cl ON p.id = cl.phoneID LEFT JOIN (SELECT * FROM image ig GROUP BY ig.phoneID, ig.colorID) AS img ON p.id = img.phoneID 
        WHERE p.visible = 1 AND cl.colorID = v.colorID AND img.colorID = v.colorID AND v.visible = 1
        LIMIT $begin, 5;";
        $result = mysqli_query($this->con, $sql);   
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        return $products;
    }
    public function getQuantityPhone(){
        $sql = "SELECT COUNT(p.name) AS quantity
        FROM phone p JOIN category c ON p.category = c.id JOIN variant v ON p.id = v.phoneID JOIN color cl ON p.id = cl.phoneID JOIN (SELECT * FROM image ig GROUP BY ig.phoneID, ig.colorID) AS img ON p.id = img.phoneID 
        WHERE p.visible = 1 AND cl.colorID = v.colorID AND img.colorID = v.colorID;";
        $quantity = 0;
        $result = mysqli_query($this->con, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            $quantity = $row['quantity'];
        }      
        return $quantity;
    }

    public function getAllPhoneAndDetails($brand = "", $weight = "", $search = "") {
        // nếu có brand
        if($brand != "") {
            // nếu có hơn 1 value trong brand
            if(strstr($brand, " ")) {
                $arrayValueBrand = explode(" ", $brand);

                $query_brand = "LEFT JOIN category c ON p.`category` = c.`id` 
                                WHERE ( c.`name` = '".$arrayValueBrand[0] ."'" ;

                // thêm điều kiện để thấy giá trị theo từng value
                for($i = 1; $i < count($arrayValueBrand); $i++) {
                    $query_brand .= " OR c.`name` = '" . $arrayValueBrand[$i] ."'";
                }
                $query_brand .= ")";
            } else {
                $query_brand = $brand != "" ? "LEFT JOIN category c ON p.`category` = c.`id` WHERE c.`name` = '".$brand ."'" : "";
            }
            $query_weight = $weight != "" ? str_replace("WHERE", "AND", $weight) : "";
        } else {
            $query_brand = "";
            $query_weight = $weight;
        }

        $sql = "SELECT * FROM `phone` p 
                LEFT JOIN image i ON p.`id` = i.`phoneID` 
                LEFT JOIN variant v ON p.`id` = v.`phoneID` 
                LEFT JOIN spec s ON p.`id` = s.`phoneID`
                ". $query_brand ."
                ".$query_weight."
                ".($search != "" ? ("WHERE p.`name` LIKE N'%".$search."%'"): "")."
                GROUP BY p.`id`";

        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function getPhonesByPageNumber($productsPerPage, $page, $sort= "", $brand= "", $weight = "", $search = ""){
        // nếu có brand
        if($brand != "") {
            // nếu có hơn 1 value trong brand
            if(strstr($brand, " ")) {
                $arrayValueBrand = explode(" ", $brand);

                $query_brand = "LEFT JOIN category c ON p.`category` = c.`id` 
                                WHERE ( c.`name` = '".$arrayValueBrand[0] ."'" ;

                // thêm điều kiện để thấy giá trị theo từng value
                for($i = 1; $i < count($arrayValueBrand); $i++) {
                    $query_brand .= " OR c.`name` = '" . $arrayValueBrand[$i] ."'";
                }
                $query_brand .= ")";
            } else {
                $query_brand = $brand != "" ? "LEFT JOIN category c ON p.`category` = c.`id` WHERE c.`name` = '".$brand ."'" : "";
            }
            $query_weight = $weight != "" ? str_replace("WHERE", "AND", $weight) : " ";
        } else {
            $query_brand = "";
            $query_weight = $weight;
        }

        $begin = ($page * $productsPerPage) - $productsPerPage;

        $sql = "SELECT p.`id` as PhoneId, p.`name` as PhoneName, i.`image` as PhoneImage, v.`price` as PhonePrice FROM `phone` p 
                LEFT JOIN image i ON p.`id` = i.`phoneID` 
                LEFT JOIN variant v ON p.`id` = v.`phoneID` 
                LEFT JOIN spec s ON p.`id` = s.`phoneID`
                ". $query_brand ."
                ".$query_weight."
                ".($search != "" ? ("WHERE p.`name` LIKE N'%".$search."%'"): "")."
                GROUP BY p.`id` 
                ".$sort."
                LIMIT $begin, $productsPerPage";
                
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getAllCategoriesAndCountByPhoneID(){
        $sql = "SELECT c.name AS name, COUNT(p.id) as count FROM category c, phone p WHERE c.id = p.category GROUP BY c.id";
        
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getPhoneWeightByWeightAndCountByPhoneID($query_weight){
        $sql = "
            SELECT SUM(count) AS total_count
            FROM (
                SELECT s.bodyWeight AS bodyWeight, COUNT(p.id) AS count
                FROM spec s
                JOIN phone p ON s.phoneID = p.id
                ". $query_weight ."
                GROUP BY s.bodyWeight
            ) AS weight_counts;
        ";

        $result = mysqli_query($this->con, $sql);
        if (!$result) {
            die("Query error: " . mysqli_error($this->con));
        }
        $row = mysqli_fetch_assoc($result);
        return $row['total_count'] ?? 0; 
    }

    public function GetSuggestion($stringFind)
    {
        $query = "SELECT name FROM phone WHERE name LIKE N'%" . $stringFind . "%'";
        $result = mysqli_query($this->con, $query);
        $suggestions = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $suggestions[] = $row;
        }
        return $suggestions;
    }

    public function getPhones($productsPerPage, $page){
        $begin = ($page * $productsPerPage) - $productsPerPage;

        $sql = "SELECT p.`id` as PhoneId, p.`name` as PhoneName, i.`image` as PhoneImage, v.`price` as PhonePrice FROM `phone` p 
                LEFT JOIN image i ON p.`id` = i.`phoneID` 
                LEFT JOIN variant v ON p.`id` = v.`phoneID` 
                LEFT JOIN spec s ON p.`id` = s.`phoneID`
                GROUP BY p.`id` 
                LIMIT $begin, $productsPerPage";
                
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getSellingProducts($since, $toDate)
    {
        $sql = "SELECT od.variantID, SUM(od.quantity) AS total_sold, p.name, v.price, i.image
                FROM orderDetail od 
                JOIN `order` o ON od.orderID = o.id 
                JOIN variant v ON od.variantID = v.id 
            	JOIN image i ON v.phoneID = i.phoneID  
            	JOIN phone p ON v.phoneID = p.id    
                WHERE o.orderStatus = 'Completed' 
                AND o.date >= '$since' AND o.date <= '$toDate' 
                AND i.colorID = v.colorID
                GROUP BY od.variantID
                ORDER BY total_sold DESC";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getBusinessSituation($since, $toDate)
    {
        $sql = "SELECT phone.category, category.name, SUM(orderDetail.quantity) AS total_quantity, 
                    SUM(orderDetail.price) AS total_price FROM `order` o 
                JOIN orderDetail ON o.id = orderDetail.orderID 
                JOIN variant ON orderDetail.variantID = variant.id 
                JOIN phone ON variant.phoneID = phone.id 
                JOIN category ON category.id = phone.category 
                WHERE o.orderStatus = 'Completed' AND o.date >= '$since' AND o.date <= '$toDate' 
                GROUP BY phone.category";
        $result = mysqli_query($this->con, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}
