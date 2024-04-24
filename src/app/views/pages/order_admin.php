<?php
require './app/includes/formatMoney.php';
require './app/includes/addOrUpdateQueryParam.php';
?>
<div class="row g-4">
    <div class="col-12">
        
        <div class="bg-light rounded h-100 pt-3 pb-3 px-4">
            <div class="time d-flex align-items-center h-100">
                <input type="text" id="searchInput" class="search-order-admin h-100" placeholder="Search...">
                <button onclick="search()" class="btn-search-order-admin">Search</button>
                <!-- <?php
                if (isset ($result)) {
                    
                    foreach ($result as $item) {
                        
                        $check = $item["orderStatus"] == "Completed" ? "disabled" : '';
                        echo "<tr id='product-item'>";
                        echo "<th scope='row'>";
                        echo "<input type='checkbox' name=' id='></th>";
                        echo "<td onClick = 'handle(" . $item["id"] . ", event)' class='id_product'> " . $item["id"] . "</td>";
                        echo "<td onClick = 'handle(" . $item["id"] . ", event)'>" . $item["name"] . "</td>";
                        echo "<td onClick = 'handle(" . $item["id"] . ", event)'>" . format_money($item["totalPayment"]) . " VNĐ</td>";
                        echo "<td onClick = 'handle(" . $item["id"] . ", event)'  class='date'>" . $item["date"] . "</td>";
                        echo "<td onClick = 'handle(" . $item["id"] . ", event)' class='status-" . $item["id"] . "'>" . $item["orderStatus"] . "</td>";

                        echo "<td> <select " . $check . "  onchange='update(" . $item["id"] . ",this )'  class='mySelect-" . $item["id"] . "'>
                                                <option  value='Processing'>Processing</option>
                                                <option  value='Delivering'>Delivering</option>
                                                <option  value='Canceled'>Canceled</option>
                                                <option  value='Completed' >Completed</option>
                                            </select>";
                        echo "</td></tr>";
                        echo "<span></span></div></div></td></tr>";
                        echo "<tr >";
                        echo "<td class='empty-" . $item["id"] . "' colspan = '7'></td>";
                        echo "</tr>";
                    }
                }

                ?> -->

                </select>
            </div>
        </div>
    </div>
    <div class="col-12 pt-4">
        <div class="bg-light rounded h-100 p-4">
            <div class="table-responsive">
                <table onchange="SortByDate()" class="table">
                    <thead>
                        <tr class="product_info">
                            <th scope="col">
                                <input type="checkbox" name="" id="">
                            </th>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Ngày đặt</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="body">
                    
                        <?php
                        
                        // phân trang
                        if (isset ($quantity)) {

                            foreach ($orders as $item) {
                                $check = $item["orderStatus"] == "Completed" ? "disabled" : '';
                                echo "<tr id='product-item'>";
                                echo "<th scope='row'>";
                                echo "<input type='checkbox' name=' id='></th>";
                                echo "<td onClick = 'handle(" . $item["id"] . ", event)' class='id_product'> " . $item["id"] . "</td>";
                                echo "<td onClick = 'handle(" . $item["id"] . ", event)'>" . $item["name"] . "</td>";
                                echo "<td onClick = 'handle(" . $item["id"] . ", event)'>" . format_money($item["totalPayment"]) . " VNĐ</td>";
                                echo "<td onClick = 'handle(" . $item["id"] . ", event)'  class='date'>" . $item["date"] . "</td>";
                                echo "<td onClick = 'handle(" . $item["id"] . ", event)' class='status-" . $item["id"] . "'>" . $item["orderStatus"] . "</td>";

                                echo "<td> <select " . $check . "  onchange='update(" . $item["id"] . ",this )'  class='mySelect-" . $item["id"] . "'>
                                            <option  value='Processing'>Processing</option>
                                            <option  value='Delivering'>Delivering</option>
                                            <option  value='Canceled'>Canceled</option>
                                            <option  value='Completed' >Completed</option>
                                        </select>";
                                echo "</td></tr>";
                                echo "<span></span></div></div></td></tr>";
                                echo "<tr >";
                                echo "<td class='empty-" . $item["id"] . "' colspan = '7'></td>";
                                echo "</tr>";
                            }
                        }
                        echo '<script>
                        $(document).ready(function () {
                            SortByDate();
                        });
                    </script>';
                        ?>
                        

                    </tbody>
                    
                </table>
                <div class="paginatoin-area">
                    <div class="d-flex justify-content-center">
                        <div class="">
                            <ul class="pagination-box pt-xs-20 pb-xs-15">
                                <?php
                                if (isset ($quantity)) {

                                    $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                    $page = isset ($_GET["page"]) ? $_GET["page"] : 1;

                                    $ordersPerPage = 3;
                                    $num_all_rows = isset ($quantity) ? $quantity : 0;
                                    $totalPages = ceil($num_all_rows / $ordersPerPage);

                                    if ($page > 1) {
                                        echo '<li><a href="index.php?ctrl=order_manage&page=' . ($page - 1) . '" class="Previous"><i class="fa fa-chevron-left"></i> Previous</a></li>';

                                    }
                                    if ($totalPages > 5) {

                                        if ($page > $totalPages - 2) {
                                            for ($i = $totalPages - 4; $i <= $totalPages; $i++) {
                                                if ($i > 0) {
                                                    echo '<li class="' . ($page == $i ? 'active' : '') . '"><a href="index.php?ctrl=order_manage&page=' . addOrUpdateQueryParam($currentUrl, "page", $i) . '">' . $i . '</a></li>';

                                                }
                                            }
                                        } else if ($page > 3) {
                                            for ($i = $page - 2; $i <= $page + 2; $i++) {
                                                if ($i > 0 && $i <= $totalPages) {
                                                    echo '<li class="' . ($page == $i ? 'active' : '') . '"><a href="index.php?ctrl=order_manage&page=' . addOrUpdateQueryParam($currentUrl, "page", $i) . '">' . $i . '</a></li>';
                                                }
                                            }
                                        } else {
                                            for ($i = 1; $i <= 5; $i++) {
                                                echo '<li class="' . ($page == $i ? 'active' : '') . '"><a href="index.php?ctrl=order_manage&page=' . addOrUpdateQueryParam($currentUrl, "page", $i) . '">' . $i . '</a></li>';
                                            }
                                        }
                                    } else {
                                        for ($i = 1; $i <= $totalPages; $i++) {
                                            echo '<li class="' . ($page == $i ? 'active' : '') . '"><a href="index.php?ctrl=order_manage&page=' . addOrUpdateQueryParam($currentUrl, "page", $i) . '">' . $i . '</a></li>';
                                        }
                                    }

                                    if ($page < $totalPages) {
                                        echo '<li> <a href="index.php?ctrl=order_manage&page=' . addOrUpdateQueryParam($currentUrl, "page", $page + 1) . ' " class="Next"> Next <i class="fa fa-chevron-right"></i></a> </li>';
                                    }

                                }


                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>