<div class="container-fluid px-4 pt-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 pt-3 pb-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-success btn-multiple-restore">Restore</button>
                </div>
            </div>
        </div>
        <div class="col-12 pt-4">
            <div class="bg-light rounded h-100 p-4">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input type="checkbox" name="" class="checkall">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $temp = 1;
                                foreach ($data['customers'] as $item) {
                                    echo "
                                        <tr class='product-item'>
                                            <th scope='row'>
                                                <input type='checkbox' class='checkItem' value='".$item['id']."'>
                                            </th>
                                            <td> ". $temp++ ."</td>
                                            <td> ".$item['name']." </td>
                                            <td> ".$item['email']." </td>
                                            <td class='button-restore' data-id=".$item['id'].">Restore</td>
                                        </tr>";
                                } 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
            $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if (strpos($currentUrl, '&page') !== false) {
                $currentUrl = strstr($currentUrl, '&page', true);
            }
            
            if(isset($customers) && isset($CountCustomer)){
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                if (strpos($currentUrl, '&page') !== false) {
                    $currentUrl = strstr($currentUrl, '&page', true);
                }
                echo "<div class='purchase-order-pagination'>";
                    $totalPages = ceil($CountCustomer / 6);
                    if($totalPages > 1){
                        $maxPageShow = ($currentPage + 2) < $totalPages? ($currentPage + 2): $totalPages;
                        $i = $currentPage < 3? 1: $currentPage - 2;
                        if ($currentPage > 1) {
                            echo "<a class='page-Index button-action' href='$currentUrl&page=".($currentPage - 1)."'><i class='fa-solid fa-chevron-left'></i></a>";
                        }
                        for (; $i <= $maxPageShow; $i++) {
                            if ($i == $currentPage) {
                                echo "<span class='page-Index current'>$i</span>";
                            } else {
                                echo "<a class='page-Index' href='$currentUrl&page=$i'>$i</a>";
                            }
                        }
                        if ($currentPage < $totalPages) {
                            echo "<a class='page-Index button-action' href='$currentUrl&page=".($currentPage + 1)."'><i class='fa-solid fa-chevron-right'></i></a>";
                        }
                    }
                echo "</div>";
            }
        ?>
    </div>
</div>