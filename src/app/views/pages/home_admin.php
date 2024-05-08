<div class="container-fluid px-4 pt-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Today Sale</p>
                    <h6 class="mb-0">$1234</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Sale</p>
                    <h6 class="mb-0">$1234</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Today Revenue</p>
                    <h6 class="mb-0">$1234</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Revenue</p>
                    <h6 class="mb-0">$1234</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Selling Products</h6>
                    <a href="">show</a>
                </div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light text-center rounded business-situation-wrap">
                <div class="d-flex align-items-center justify-content-end mb-4">
                    <h6 class="mb-0 ">Business situation</h6>
                    <div class="d-flex justify-content-between business-situation">
                        <div class="d-flex">
                            <span class="w-50">Since: </span>
                            <input type="date" id="since-business" class="since">
                        </div>
                        <div class="d-flex">
                            <span class="w-50">To date:</span>
                            <input type="date" id="to-date-business" class="to-date">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0 ">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Category</th>
                                <th scope="col">Total quantity</th>
                                <th scope="col">Total price</th>
                            </tr>
                        </thead>
                        <tbody class="body-business-situation">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Selling Products</h6>
            <div class="d-flex w-50 justify-content-between">
                <div class="d-flex">
                    <span class="w-50 mr-10">Since: </span>
                    <input type="date" id="since" class="since">
                </div>
                <div class="d-flex">
                    <span class="w-50 mr-10">To date:</span>
                    <input type="date" id="to-date" class="to-date">
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0 ">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">Image</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total sold</th>
                    </tr>
                </thead>
                <tbody class="selling-product">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>