$(document).ready(() => {
    addEventPhoneInput();
    addEventNameInput();
    changeColorHover();
    var currentURL = new URL(window.location.href);
    if (currentURL.searchParams.get("orderID") == null) {
        var select = currentURL.searchParams.get("sl");
        currentSelect = document.getElementById((select == null ? "status-All" : "status-" + select));
        currentSelect.classList.add('status-active');
    }
    //tìm kiếm đơn hàng
    searchBox = document.getElementById('search-purchase');
    document.querySelector('.search-order-button').addEventListener('click', function (event) {
        searchHandle(event);
    });
    searchBox.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            searchHandle(event);
        }
    });

})
function searchHandle(event) {
    event.preventDefault()
    var searchBox = document.getElementById('search-purchase');
    var currentURL = new URL(window.location.href);
    currentURL.searchParams.set("search", searchBox.value);
    if(currentURL.searchParams.get("search") == "") currentURL.searchParams.delete("search");
    window.location.href = currentURL.href;
}
function addEventPhoneInput() {
    var phoneInput = document.getElementById("customer-phone-input");
    phoneInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            if (!/^0\d{8,9}$/.test(phoneInput.value)) {
                var errPhone = document.getElementById("err-phone-span");
                errPhone.innerHTML = "Số điện thoại khum hợp lệ!";
                phoneInput.focus();
            }
            else {
                var errPhone = document.getElementById("err-phone-span");
                errPhone.innerHTML = "";
                document.getElementById("province-select").focus();
            }
        }
    });
}
function handleChangeProvince() {
    var provinceID = document.getElementById("province-select").value;
    loadAllDistrict(provinceID).then(success => {
        handleChangeDistrict();
    })
        .catch(error => {
            console.log(error);
        });
}
function handleChangeDistrict() {
    var districtID = document.getElementById("district-select").value;
    loadAllWards(districtID);
}
function addEventNameInput() {
    var nameInput = document.getElementById("customer-name-input");
    nameInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            var regexName = /^[a-zA-Z\sàáảãạăắằẵặẳâấầẫẩậđèéẻẽẹêềếểễệìíỉĩịòóỏõọôồốổỗộơờớởỡợùúủũụưừứửữựỳỹỷỵÀÁẢÃẠĂẮẰẴẶẲÂẤẦẪẨẬĐÈÉẺẼẸÊỀẾỂỄỆÌÍỈĨỊÒÓỎÕỌÔỒỐỔỖỘƠỜỚỞỠỢÙÚỦŨỤƯỪỨỬỮỰỲỴỶỸỂ]{1, 50}$/;
            if (!regexName.test(nameInput.value)) {
                var errName = document.getElementById("err-name-span");
                errName.innerHTML = "Tên khum hợp lệ!";
                nameInput.focus();
            }
            else {
                var errName = document.getElementById("err-name-span");
                errName.innerHTML = "";
                document.getElementById("customer-phone-input").focus();
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
    document.getElementById('province-select').addEventListener('change', handleChangeProvince);
    document.getElementById('district-select').addEventListener('change', handleChangeDistrict);
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
            if(res.status == 401) return navigationLogin();
            if (res.result) location.reload();
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
            if(res.status == 401) return navigationLogin();
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
    return new Promise((resolve, reject) => {
        $.ajax({
            type: 'post',
            url: 'index.php?ctrl=purchase_order&act=getAllDistrict',
            data: { provinceID },
            dataType: 'json',
            success: res => {
                if(res.status == 401) return navigationLogin();
                if (res.listDistrict != null) {
                    var selectDistrict = document.getElementById("district-select");
                    selectDistrict.innerHTML = "";
                    res.listDistrict.forEach(District => {
                        selectDistrict.innerHTML += `<option value='${District["id"]}'>${District["name"]}</option></option>`;
                    });
                }
                resolve(res.success);
            },
            error: err => {
                reject(err);
            },
        });
    });
}
function loadAllWards(districtID) {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=purchase_order&act=getAllWards',
        data: { districtID },
        dataType: 'json',
        success: res => {
            if(res.status == 401) return navigationLogin();
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
                if(res.status == 401) return navigationLogin();
                resolve(res.result);
            },
            error: err => {
                reject(err);
            }
        });
    });
};
function isValid(Name, Phone) {
    var regexName = /^[a-zA-Z\sàáảãạăắằẵặẳâấầẫẩậđèéẻẽẹêềếểễệìíỉĩịòóỏõọôồốổỗộơờớởỡợùúủũụưừứửữựỳỹỷỵÀÁẢÃẠĂẮẰẴẶẲÂẤẦẪẨẬĐÈÉẺẼẸÊỀẾỂỄỆÌÍỈĨỊÒÓỎÕỌÔỒỐỔỖỘƠỜỚỞỠỢÙÚỦŨỤƯỪỨỬỮỰỲỴỶỸỂ]{1, 50}$/;
    if (/^0\d{8,9}$/.test(Phone) && regexName.test(Name.trim())) return true;
    return false;
}
const saveChange = (orderID, userID, Name, Phone, P, D, W, Detail) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=purchase_order&act=saveAddress',
        data: { orderID, userID, Name, Phone, P, D, W, Detail },
        dataType: 'json',
        success: res => {
            if(res.status == 401) return navigationLogin();
            toast({
                title: 'Thông báo!',
                message: 'Thay đổi địa chỉ thành công 😊',
                type: 'warning',
                duration: 2000,
            });
        },
        error: err => {
            console.log(err);
        }
    });
};
function changeColorHover() {
    var inputs = [document.getElementById('customer-name-input'),
    document.getElementById('customer-phone-input'), document.getElementById('detail-address-input')];
    var colors = ['black', 'blue', 'green', 'orange', 'purple'];

    var intervalId;
    inputs.forEach(input => {
        input.addEventListener('mouseover', function () {
            var i = 0;

            intervalId = setInterval(function () {
                input.style.backgroundColor = colors[i % colors.length];
                input.style.color = "white";
                i++;
            }, 2000);
        });

        input.addEventListener('mouseout', function () {
            clearInterval(intervalId);
            input.style.backgroundColor = '';
            input.style.color = "";
        });
    });
}

//---Trang chi tiết đơn hàng---
function openBuyAgainForm(id) {
    var buyAgainForm = document.querySelector(".buy-again-form");
    var overlay = document.querySelector(".cancel-overlay");
    buyAgainForm.classList.add("buy-again-form-active");
    overlay.classList.add("cancel-form-active");
    buyAgainForm.setAttribute("order-id", id);
}
function returnHandle(event) {
    event.preventDefault()
    var currentURL = new URL(window.location.href);
    currentURL.searchParams.delete("orderID");
    window.location.href = currentURL.href;
}
function closeBuyAgainForm(event) {
    event.preventDefault();
    var buyAgainForm = document.querySelector(".buy-again-form");
    var overlay = document.querySelector(".cancel-overlay");
    buyAgainForm.classList.remove("buy-again-form-active");
    overlay.classList.remove("cancel-form-active");
}
function navigateCheckout (event) {
    event.preventDefault();
    var buyAgainForm = document.querySelector(".buy-again-form");
    window.location.href = 'index.php?ctrl=checkout&order_id=' + buyAgainForm.getAttribute("order-id");
};

const toast = ({ title = '', message = '', type = 'info', duration = 2000 }) => {
    const main = document.getElementById('toast');
    if (main) {
        const toast = document.createElement('div');
        const autoRemove = setTimeout(function () {
            main.removeChild(toast);
        }, duration + 1000);
        toast.onclick = function (e) {
            if (e.target.closest('.toast__close')) {
                main.removeChild(toast);
                clearTimeout(autoRemove);
            }
        };
        const icons = {
            success: 'fa-solid fa-circle-check',
            info: 'fa-solid fa-circle-info',
            warning: 'fa-solid fa-circle-exclamation',
        };
        const icon = icons[type];
        const delay = (duration / 1000).toFixed(2);
        toast.classList.add('toast', `toast--${type}`);
        toast.style.animation = `slideInleft ease .6s, fadeOut linear 1s ${delay}s forwards`;

        toast.innerHTML = `
                <div class="toast__icon">
                    <i class="${icon}"></i>
                </div>
                <div class="toast__body">
                    <h3 class="toast__title">${title}</h3>
                    <p class="toast__msg">${message}</p>
                </div>
                <div class="toast__close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            `;
        main.appendChild(toast);
    }
};

const navigationLogin = () => { window.location.href = 'index.php?ctrl=login' };