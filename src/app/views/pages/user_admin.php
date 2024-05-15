<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 pt-3 pb-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-success" onclick = "handleOpen(0,1)">Add</button>
                    <button type="button" class="btn btn-success ml-10" onclick="checkDeleteUser()">Delete</button>
                    <div class="wappper-search">
                        <input type="text" class="searchUser">
                        <button type="button" class="btn btn-success ml-10" id = "btn-search" onclick="searchUser()">Search</button>
                    </div>
                    <a href="index.php?ctrl=trash_user">
                        <i class="fa-regular fa-trash-can icon-trash"></i>
                    </a>
                </div> 
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
                                <input class="parent_checkbox_user" type="checkbox" onclick ="showAllCheckboxUser()">
                            </th>
                            <th scope="col">ID</th>
                            <th scope="col" class = "col-name">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col" class = "col-author" >Author</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class='body_user'>
                    <?php
                    
                            if (isset($users)) {
                                foreach ($users as $user) {
                                    echo "<tr class='user-item'>
                                    <th scope='row'>
                                        <input type='checkbox' name='' class='child_checkbox_user' dataid='".$user["id"]."'>
                                    </th>
                                    <td>".$user["id"]."</td>
                                    <td>".$user["name"]."</td>
                                    <td>".$user["email"]."</td>
                                    <td>".$user["Author"]."</td>
                                    <td class='td-action'>
                                        <span class='edit-product' onclick='handleOpen(".$user["id"].",0)'>
                                            <i class='fa-solid fa-pen-to-square prdmng-icon-edit'></i>
                                        </span>
                                        <span class='delete-product' onclick='deleteUser(".$user["id"].")'>
                                            <i class='fa-regular fa-trash-can prdmng-icon-trash'></i>
                                        </span>
                                        </td>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php 
                            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                            $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            if (strpos($currentUrl, '&page') !== false) {
                                $currentUrl = strstr($currentUrl, '&page', true);
                            }
                            echo "</div>";
                            echo "<div class='user-pagination'>";
                            $totalPages = ceil(($quantity) / 5);
                            if($totalPages > 1)
                            {
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
                        ?>
                </div>
            </div>
        </div>
</div>

<div class="update-user-overlay">
    <div class="form-edit-user">
        <i class="fa-solid fa-xmark btn-update-close" onClick="handleClose(0)"></i>
        <div class="update-user-wapper">
                        
                <label class="lb-name lbuser" >Name:</label>
                <input class="iputuser name" type="text">
                                            
                <label class="lb-email lbuser" >Email:</label>
                <input class="iputuser email" type="text" >
            
                <label class="lb-author lbuser" >Author:</label>
                <select class="iputuser author">
                </select>
                </div>      
        <button class='btn-update-user complete' onclick="UpdateUser()">Complete</button>
       
    </div>
</div>
<div class="add-user-overlay">
    <div class="form-add-user">
        <i class="fa-solid fa-xmark btn-update-close" onClick="handleClose(1)"></i>
        <div class="add-user-wapper">
            
                <label class="lb-name lbuser" >Name:</label>
                <input class="iputuser name-add" type="text">
                                            
                <label class="lb-email lbuser" >Email:</label>
                <input class="iputuser email-add" type="text" >

                <label class="lb-password lbuser" >Phone Number:</label>
                <input class="iputuser password-add" type="number">

                <label class="lb-author lbuser" >Author:</label>
                <select class="iputuser author-add">
                </select>            
           
        <button class='btn-add-user complete' onclick="AddUser()">Add User</button>
    </div>
</div>