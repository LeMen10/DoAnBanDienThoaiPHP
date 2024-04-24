$(document).ready(() => {
    addEventPhoneInput();
    var currentURL = new URL(window.location.href);
    if (currentURL.searchParams.get("orderID") == null) {
        var select = currentURL.searchParams.get("sl");
        currentSelect = document.getElementById((select == null ? "status-All" : "status-" + select));
        currentSelect.classList.add('status-active');
    }

})
function addEventPhoneInput() {
    var phoneInput = document.getElementById("customer-phone-input");
    phoneInput.addEventListener('keydown', function (event) {
        if(event.key === 'Enter')
        {
            event.preventDefault();
            if(!/^0\d{8,9}$/.test(phoneInput.value))
            {
                var errPhone = document.getElementById("err-phone-span");
                errPhone.innerHTML = "Số điện thoại khum hợp lệ!";
                phoneInput.focus();
            }
            else 
            {
                errPhone.innerHTML = "";
                document.getElementById("province-select").focus();
            }
        }
    });
}
function handleChangeStatusList(selectName) {
    var currentURL = new URL(window.location.href);
    if (currentURL.searchParams.get("page") != null) {
        currentURL.searchParams.delete("page");
    }
    if (selectName == "All") {
        if (currentURL.searchParams.get("sl") != null) {
            currentURL.searchParams.delete("sl");
        }

    }
    else currentURL.searchParams.set("sl", selectName);
    window.location.href = currentURL.href;
}
function closeCancelForm(event) {
    event.preventDefault();
    var cancelForm = document.querySelector(".cancel-form");
    var overlay = document.querySelector(".cancel-overlay");
    cancelForm.classList.remove("cancel-form-active");
    overlay.classList.remove("cancel-form-active");
}
function openCancelForm(id) {
    var cancelForm = document.querySelector(".cancel-form");
    var overlay = document.querySelector(".cancel-overlay");
    cancelForm.classList.add("cancel-form-active");
    overlay.classList.add("cancel-form-active");
    cancelForm.setAttribute("order-id", id);
}
function handleDeleteOrder() {
    var cancelForm = document.querySelector(".cancel-form");
    cancelOrder(cancelForm.getAttribute("order-id"));
}

function CreateOrderStatus(orderStatus) {
    if (orderStatus == "Completed") return "The order has been delivered successfully.";
    else if (orderStatus == "Canceled") return "The order has been cancelled.";
    else if (orderStatus == "Delivering") return "Your order is being delivered to you.";
    else return "Your order is being processed and will be delivered to you soon.";
}
function handleChangeInfo(event) {
    event.preventDefault();
    var changeForm = document.querySelector(".change-form");
    var orderID = changeForm.getAttribute("order-id");
    var customerName = document.getElementById("customer-name-input").value;
    var customerPhone = document.getElementById("customer-phone-input").value;
    var detailAddress = document.getElementById("detail-address-input").value;
    var Province = document.getElementById("province-select").value;
    var District = document.getElementById("district-select").value;
    var Wards = document.getElementById("wards-select").value;
    loadCustomerInfoByOrderID(orderID)
        .then(info => {
            if (customerName == info["recipientName"] && customerPhone == info["recipientPhone"]) {
                if (Province == info["provinceID"] && District == info["districtID"] && Wards == info["wardsID"] && detailAddress == info["detail"]) {
                    return;
                }
            }
            saveChange(info["orderID"], info["customerID"], customerName, customerPhone, Province, District, Wards, detailAddress);
        })
        .catch(error => {
            console.log(error);
        });
}
function openChangeAddressForm(orderID) {
    var changeForm = document.querySelector(".change-form");
    var overlay = document.querySelector(".cancel-overlay");
    changeForm.classList.add("change-form-active");
    overlay.classList.add("cancel-form-active");
    changeForm.setAttribute("order-id", orderID);
    loadCustomerInfoByOrderID(orderID)
        .then(info => {
            var customerName = document.getElementById("customer-name-input");
            var customerPhone = document.getElementById("customer-phone-input");
            var detailAddress = document.getElementById("detail-address-input");
            customerName.value = info["recipientName"];
            customerPhone.value = info["recipientPhone"];
            detailAddress.value = info["detail"];
            loadAllProvince(info["provinceID"]);
            loadAllDistrict(info["provinceID"]);
            loadAllWards(info["districtID"]);
        })
        .catch(error => {
            console.log(error);
        });
}
function closeChangeAddressForm(event) {
    event.preventDefault();
    var cancelForm = document.querySelector(".change-form");
    var overlay = document.querySelector(".cancel-overlay");
    cancelForm.classList.remove("change-form-active");
    overlay.classList.remove("cancel-form-active");
}
function handleOnClickItemOrderList(orderID) {
    window.location.href += '&orderID=' + orderID;
}
function showEmpty() {
    document.querySelector(".purchase-order-container").innerHTML = `<div class="empty-list">No orders</div>`;
}

function cancelOrder(orderID) {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=purchase_order&act=cancelOrder',
        data: { orderID },
        dataType: 'json',
        success: res => {
            console.log(res)
            if (res.result) {
                console.log(1);
                location.reload();
            }
        },
        error: err => {
            console.log(err);
        }
    })
}
function loadAllProvince(provinceID) {
    return $.ajax({
        type: 'get',
        url: 'index.php?ctrl=purchase_order&act=getAllProvince',
        data: {},
        dataType: 'json',
        success: res => {
            if (res.listProvince != null) {
                var selectProvince = document.getElementById("province-select");
                selectProvince.innerHTML = "";
                res.listProvince.forEach(province => {
                    selectProvince.innerHTML += `<option value='${province["id"]}'>${province["name"]}</option>`;
                });
                selectProvince.value = provinceID;
            }
        },
        error: err => {
            console.log(err);
        }
    })
}
function loadAllDistrict(provinceID) {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=purchase_order&act=getAllDistrict',
        data: { provinceID },
        dataType: 'json',
        success: res => {
            if (res.listDistrict != null) {
                var selectDistrict = document.getElementById("district-select");
                selectDistrict.innerHTML = "";
                res.listDistrict.forEach(District => {
                    selectDistrict.innerHTML += `<option value='${District["id"]}'>${District["name"]}</option></option>`;
                });
            }
        },
        error: err => {
            console.log(err);
        }
    })
}
function loadAllWards(districtID) {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=purchase_order&act=getAllWards',
        data: { districtID },
        dataType: 'json',
        success: res => {
            if (res.listWards != null) {
                var selectWards = document.getElementById("wards-select");
                selectWards.innerHTML = "";
                res.listWards.forEach(Wards => {
                    selectWards.innerHTML += `<option value='${Wards["id"]}'>${Wards["name"]}</option></option>`;
                });

            }
        },
        error: err => {
            console.log(err);
        }
    })
}
const loadCustomerInfoByOrderID = (orderID) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: 'post',
            url: 'index.php?ctrl=purchase_order&act=getCustomerInfoByOrderID',
            data: { orderID },
            dataType: 'json',
            success: res => {
                resolve(res.result);
            },
            error: err => {
                reject(err);
            }
        });
    });
};
function isValid(Name, Phone)
{
    var regexName = /^[a-zA-Z\sàáảãạăắằẵặẳâấầẫẩậđèéẻẽẹêềếểễệìíỉĩịòóỏõọôồốổỗộơờớởỡợùúủũụưừứửữựỳỹỷỵÀÁẢÃẠĂẮẰẴẶẲÂẤẦẪẨẬĐÈÉẺẼẸÊỀẾỂỄỆÌÍỈĨỊÒÓỎÕỌÔỒỐỔỖỘƠỜỚỞỠỢÙÚỦŨỤƯỪỨỬỮỰỲỴỶỸỂ]{1, 50}$/;
    if(/^0\d{8,9}$/.test(Phone) && regexName.test(Name.trim())) return true;
    return false;
}
const saveChange = (orderID, userID, Name, Phone, P, D, W, Detail) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=purchase_order&act=saveAddress',
        data: { orderID, userID, Name, Phone, P, D, W, Detail },
        dataType: 'json',
        success: res => {
            alert("thay đổi thành công!");
        },
        error: err => {
            console.log(err);
        }
    });
};