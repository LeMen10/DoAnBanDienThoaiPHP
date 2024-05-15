$(document).ready(() => {

})
function handleClose(isAdd) {
    if (isAdd) {
        document.querySelector(".form-add-receipt").classList.remove("active")
        document.querySelector(".btn-add-receipt").classList.remove("active")
        document.querySelector(".btn-create-receipt").classList.remove("active")
    } else {
        document.querySelector(".add-user-overlay").classList.remove("active")
    }
}

function handleOpen(id, isAdd) {
    if (isAdd) {
        document.querySelector(".add-user-overlay").classList.add("active")
        $.ajax({
            url: 'index.php?ctrl=product_manage&act=show_update_phone',
            type: 'post',
            data: { id },
            dataType: 'json',
            success: function (response) {
                var categorys = response.categorys;
                var select = document.querySelector(".category-add");
                select.innerHTML = "";
                categorys.forEach(function (brand) {
                    var option = document.createElement("option");
                    option.text = brand["name"];
                    option.value = brand["id"]
                    select.appendChild(option);
                });
                handlePhoneNameChange();
            },
            error: function (xhr, status, error) {
                alert('Đã xảy ra lỗi khi khôi phục điện thoại.');
                console.error('Đã xảy ra lỗi:', error);
            }
        });
    } else {
        document.querySelector(".body_user").innerHTML = "";
        InsertReceipt();
        document.querySelector(".form-add-receipt").classList.add("active")
        document.querySelector(".btn-create-receipt").classList.add("active")
        document.querySelector(".btn-add-receipt").classList.add("active")
    }
}
const InsertReceipt = () => {
    supplierID = document.querySelector(".supplier").value;
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=receipt&act=InsertReceipt',
        data: { supplierID },
        dataType: 'json',
        success: res => {
            if (res.receiptsID != false) {
                document.querySelector(".add-user-overlay").setAttribute("receiptID", res.receiptsID);
                toast({
                    title: 'Thông báo!',
                    message: 'Đã thêm 1 chi tiết phiếu nhập 😊',
                    type: 'success',
                    duration: 2000,
                });
            }
        },
        error: err => {
            console.log(err);
        },
    });
};
const handleSizeChange = () => {
    phoneid = document.querySelector(".phonename-add").value;
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=receipt&act=GetSizeByPhoneID',
        data: { phoneid },
        dataType: 'json',
        success: res => {
            var sizes = res.sizes;
            var select = document.querySelector(".size-add");
            select.innerHTML = "";
            sizes.forEach(function (brand) {
                var option = document.createElement("option");
                option.text = brand["size"];
                option.value = brand["sizeID"]
                select.appendChild(option);
            });
            handleColorChange();
        },
        error: err => {
            console.log(err);
        },
    });
};
const handleColorChange = () => {
    phoneid = document.querySelector(".phonename-add").value;
    sizeid = document.querySelector(".size-add").value;
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=receipt&act=GetColorByColorID',
        data: { sizeid, phoneid },
        dataType: 'json',
        success: res => {
            var colors = res.colors;
            var select = document.querySelector(".color-add");
            select.innerHTML = "";
            colors.forEach(function (brand) {
                var option = document.createElement("option");
                option.text = brand["color"];
                option.value = brand["colorID"]
                select.appendChild(option);
            });
        },
        error: err => {
            console.log(err);
        },
    });
};

const handlePhoneNameChange = () => {
    categoryid = document.querySelector(".category-add").value;
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=receipt&act=GetPhoneNameByCategory',
        data: { categoryid },
        dataType: 'json',
        success: res => {
            var phonename = res.phonename;
            var select = document.querySelector(".phonename-add");
            select.innerHTML = "";
            phonename.forEach(function (brand) {
                var option = document.createElement("option");
                option.text = brand["name"];
                option.value = brand["id"]
                select.appendChild(option);
            });
            handleSizeChange();
        },
        error: err => {
            console.log(err);
        },
    });
};
const CreateReceipt = () => {
    price = document.querySelector(".price-add").value;
    quantity = document.querySelector(".quantity-add").value;
    if (price < 0 || price == null || price == 0 || quantity < 0 || quantity == 0 || quantity == null) {
        alert("Giá và số lượng phải lớn hơn không và không được để trống");
    } else {
        phoneID = document.querySelector(".phonename-add").value;
        sizeID = document.querySelector(".size-add").value;
        colorID = document.querySelector(".color-add").value;
        price = document.querySelector(".price-add").value;
        quantity = document.querySelector(".quantity-add").value;
        receiptID = document.querySelector(".add-user-overlay").getAttribute("receiptID");
        console.log(price, quantity, sizeID, phoneID, colorID, receiptID)
        return $.ajax({
            type: 'post',
            url: 'index.php?ctrl=receipt&act=InsertReceiptDetail',
            data: { price, quantity, sizeID, phoneID, colorID, receiptID },
            dataType: 'json',
            success: res => {
                if (res.checksucsess == true) {
                    alert("Đã tạo thành công 1 Receipt Detail")
                    document.querySelector(".price-add").value = "";
                    document.querySelector(".quantity-add").value = "";
                    loadData(receiptID);
                }
            },
            error: err => {
                console.log(err);
            },
        });
    }
};
const loadData = (receiptID) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=receipt&act=GetAllProductInReceipt',
        data: { receiptID },
        dataType: 'json',
        success: res => {
            var a = "";
            document.querySelector(".body_user").innerHTML = "";
            var receiptDetail = res.receiptDetail;
            receiptDetail.forEach(element => {
                a = `
                <td>${element.id}</td>
                <td>${element.name}</td>
                <td>${element.size}</td>
                <td>${element.color}</td>
                <td>${element.quantity}</td>
                <td>${element.price}</td>
                <td class='td-action'>
                <span class='delete-product' onclick='deleteReceiptDetail(${element.id})'>
                <i class='fa-regular fa-trash-can prdmng-icon-trash'></i>
                </span>
                </td>
                `;
                document.querySelector(".body_user").innerHTML += a;
            })
        },
        error: err => {
            console.log(err);
        },
    });
};
const deleteReceiptDetail = (variantID) => {
    receiptID = document.querySelector(".add-user-overlay").getAttribute("receiptID");
    console.log(variantID, receiptID);
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=receipt&act=DeleteProductInReceipt',
        data: { variantID, receiptID },
        dataType: 'json',
        success: res => {
            if (res.check) {
                toast({
                    title: 'Thông báo!',
                    message: 'Đã xóa thành công 😊',
                    type: 'success',
                    duration: 2000,
                });
                loadData(receiptID);
            }
        },
        error: err => {
            console.log(err);
        },
    });
};
const UpdateByReceipt = () => {
    receiptID = document.querySelector(".add-user-overlay").getAttribute("receiptID");
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=receipt&act=UpdateVariantByReceiptDetail',
        data: { receiptID },
        dataType: 'json',
        success: res => {
            if (res.check) {
                console.log(res.check);
                if (res.check == true) {
                     toast({
                        title: 'Thông báo!',
                        message: 'Đã cập nhật thành công 😊',
                        type: 'success',
                        duration: 2000,
                    });
                } else if (res.check == false) {
                    toast({
                        title: 'Thông báo!',
                        message: 'Update thất bại 😐',
                        type: 'warning',
                        duration: 2000,
                    });
                } else {
                    toast({
                        title: 'Thông báo!',
                        message: 'Chưa có giá trí để cập nhật 😐',
                        type: 'warning',
                        duration: 2000,
                    });
                }
                loadData(receiptID);
            }
        },
        error: err => {
            console.log(err);
        },
    });
};