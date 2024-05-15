function update(id, select) {
    var value = select.value;
    updateStatus(id, value);
}
function search() {
    var input = document.getElementById("searchInput");
    var ten = input.value;
    SearchOrder(ten.trim());
}
function handle(id) {
    if (id) {
        if (document.querySelector(`.empty-${id}`).innerHTML != "") {
            document.querySelector(`.empty-${id}`).innerHTML = "";
        }
        else LoadOrderDetail(id);
    }
}
const SearchOrder = (ten) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=order_manage&act=Search_Admin',
        data: { ten },
        dataType: 'json',
        success: res => {
            if(res.status == 401) return navigationLogin();
            if(res.status == 403) return navigation403();
            if (res.search) {
                var a = "";
                document.getElementById("body").innerHTML = "";
                res.search.forEach(element => {
                    a = "<tr id='product-item'>"+
                    "<th scope='row'>" +
                        "<input type='checkbox' name='id'>" +
                        "</th>" +
                        "<td onClick='handle(" + element["id"] + ", event)' class='id_product'>" + element["id"] + "</td>" +
                        "                    <td onClick='handle(" + element["id"] + ", event)'>" + element["nameCustomer"] + "</td>" +
                        "<td onClick='handle(" + element["id"] + ", event)'>" + element["totalPayment"] + " VNĐ</td>" +
                        "<td onClick='handle(" + element["id"] + ", event)' class='date'>" + element["date"] + "</td>" +
                        "<td onClick='handle(" + element["id"] + ", event)' class='status-" + element["id"] + "'>" + element["orderStatus"] + "</td>" +
                        "<td>" +
                        "<select onchange='update(" + element["id"] + ", this)' class='mySelect-" + element["id"] + "'>" +
                        "<option value='Processing'>Processing</option>" +
                        "<option value='Delivering'>Delivering</option>" +
                        " <option value='Canceled'>Canceled</option>" +
                        "<option value='Completed'>Completed</option>" +
                        "</select>" +
                        "</td>" +
                        "</tr>" +
                        "<tr>" +
                        "<td class='empty-" + element["id"] + "' colspan='7'></td>" +
                        " </tr>";
                        
                    document.getElementById("body").innerHTML += a;
                })
            }
        },
        error: err => {
            console.log(err);
        }
    })
}



const updateStatus = (id, value) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=order_manage&act=UpdateOrderStatus',
        data: { id, value },
        dataType: 'json',
        success: res => {
            if(res.status == 401) return navigationLogin();
            if(res.status == 403) return navigation403();
            if (res.isSuccess) {
                var select = document.querySelector(`.mySelect-${id}`);
                var va = select.value;
                var sta = document.querySelector(`.status-${id}`);
                sta.textContent = va;
                if (select.value === "Completed") {
                    select.disabled = true;
                }
                else {
                    select.disabled = false;
                }
            }
            else {
                alert("chuyển thất bại");
            }
        },
        error: err => {
            console.log(err);
        }
    })
}
function LoadOrderDetail(id) {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=order_manage&act=GetDetailProduct',
        data: { id },
        dataType: 'json',
        success: res => {
            if(res.status == 401) return navigationLogin();
            if(res.status == 403) return navigation403();
            if (res.order_detail) {
                var a = "<div class='detail_product'>" +
                    "<div class='profile'>" +
                    "<label  class='title_profile'>THÔNG TIN KHÁCH HÀNG:</label>" +
                    "<div class='sub_profile'>" +
                    "<label class='sub_profile'>Họ tên: </label>" +
                    "<p>" + res.order_detail[0]["nameCustomer"] + "</p>" +
                    "</div>" +
                    "<div class='sub_profile'>" +
                    "<label >Địa chỉ: </label>" +
                    "<p>" + res.order_detail[0]["address"] + "</p>" +
                    "</div>" +
                    "<div class='sub_profile'>" +
                    "<label >SĐT: </label>" +
                    "<p>" + res.order_detail[0]["phoneNumber"] + "</p>" +
                    "</div>" +
                    "</div>" +
                    "<div class='order_product'>" +
                    "<h5 class='title_order_product'> SẢN PHẨM ĐÃ ĐẶT</h5>";

                res.order_detail.forEach(element => {
                    a += "<div class='detail'>" +
                        "<img class='img_pro' src='public/img/phone_image/" + element["image"] + "' >" +
                        "<div class='sub_detail'>" +
                        "<label >Sản phẩm</label>" +
                        "<p>" + element["namePhone"] + "</p>" +
                        "</div>" +
                        "<div class='sub_detail'>" +
                        "<label >Tổng tiền</label>" +
                        "<p>" + element["totalPayment"] + "</p>" +
                        "</div>" +
                        "<div class='sub_detail'>" +
                        "<label >Số lượng</label>" +
                        "<p>" + element["quantity"] + "</p>" +
                        "</div>" +
                        "</div>" +
                        "</div>";
                });
                a += "</div>";
                document.querySelector(`.empty-${id}`).innerHTML = a;
            }


        },
        error: err => {
            console.log(err);
        }
    })
}

const navigationLogin = () => { window.location.href = 'index.php?ctrl=login' };

const navigation403 = () => { window.location.href = 'index.php?ctrl=myerror&act=forbidden' }