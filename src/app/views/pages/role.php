
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">   
        <div class="col-12 pt-4">
            <div class="bg-light rounded h-100 p-4">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class='tr-title-table'>
                                <th scope="col">STT</th>
                                <th scope="col">ID</th>
                                <th scope="col">Role name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class='body_product'>
                            <?php
                                $temp = 1;
                                foreach ($data['author'] as $item) {
                                    echo "
                                        <tr class='product-item'>
                                            <td> ". $temp++ ."</td>
                                            <td> ". $item['ID'].  " </td>
                                            <td> ". $item['name'].  " </td>
                                            <td class='button-restore' onclick='editRole(". $item['ID'] .")'>Edit</td>
                                        </tr>
                                    ";
                                }
                            ?>
                        </tbody>
                    </table>
                    <div class="paginatoin-area">
                        <div class="d-flex justify-content-center">
                            <div class="">
                                <ul class="pagination-box pt-xs-20 pb-xs-15">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class='modal check-edit'>
    <div class='modal__overlay'></div>
    <div class='modal__body'>
        <div class='auth-form'>
            <div class='auth-form__container'>
                <div class='auth-form__header'>
                    <h3 class='auth-form__heading heading-title'>Role</h3>
                </div>

                <div class="table-responsive pt-4">
                    <table class="table">
                        <thead>
                            <tr class='tr-title-table'>
                                <th scope="col">STT</th>
                                <th scope="col">Role name</th>
                                <th scope="col">Show</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody class='features'>
                            
                        </tbody>
                    </table>
                </div>
                
                <div class='auth-form__control'>
                    <button
                        class='btn, auth-form__control-back, btn--normal' onclick="backModal()"
                    >
                        Trở lại
                    </button>
                    <button class='btn, btn--primary, btn-success, ml-20' onclick="saveRole()">
                        Hoàn thành
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>