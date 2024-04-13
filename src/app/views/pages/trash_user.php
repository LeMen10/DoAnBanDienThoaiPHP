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
                            <th scope="col">Phone</th>
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
                                        <td> ".$item['phoneNumber']." </td>
                                        <td class='button-restore' data-id=".$item['id'].">Restore</td>
                                    </tr>";
                            } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>