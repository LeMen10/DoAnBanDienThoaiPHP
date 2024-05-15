
$(document).ready(() => {

})
function editProduct() {
    console.log(13312);
}

function deleteProduct(id) {
    $.ajax({
        url: 'index.php?ctrl=product_manage&act=delete_phone',
        type: 'POST',
        data: { id },
        success: function (response) {
            window.location.reload();
            alert('Xóa thành công');
        },
        error: function (xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục điện thoại.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}
function deleteProductByCheckbox(id) {
    $.ajax({
        url: 'index.php?ctrl=product_manage&act=delete_phone_by_checkbox',
        type: 'POST',
        data: { id },
        dataType: 'json',
        success: res => {
            return 1;
        },
        error: err => {
            console.log(err)
            return 0;
        }
    });
    return 1;
}
function checkDeleteProduct() {
    var id_arr = "";
    const child_checkbox = document.querySelectorAll('.child_checkbox_user');
    var check = 0;
    child_checkbox.forEach((item) => {
        if (item.checked == true) {
            id_arr += item.getAttribute('dataid') + ",";
            check = 1;
        }
    })

    if (check == 1 && deleteProductByCheckbox(id_arr.slice(0, -1))) {
        window.location.reload();
        alert('Xóa thành công');
    } else {
        alert('Chưa chọn đối tượng xóa');
    }
}
function loadData() {
    $.ajax({
        url: 'index.php?ctrl=product_manage&act=load_data',
        type: 'GET',
        dataType: 'json',
        success: function (response) {

            showData(response.products);
        },
        error: function (xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục điện thoại.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}
function showData(products) {
    const body_product = document.querySelector('.body_product')
    let html = "";
    products.forEach(element => {
        const ramRom = element.size.split(" ");
        const size = ramRom.join("/");
        html += `<tr class='product-item'>
        <th scope='row'>
            <input type='checkbox' name='' class='child_checkbox' dataid='${element.variantid}'>
        </th>
        <td>${element.variantid}</td>
        <td class='td-img-product'>
            <img class='img-product' src='public/img/phone_image/${element.image}' alt='' class='image_product'>
            
        </td>
        <td>${element.phonename}</td>
        <td>${element.category}</td>
        <td>${formatMoney(element.price)} VNĐ</td>
        <td>${size}</td>
        <td>${element.color}</td>
        <td>${element.quantity}</td>
        <td class='td-action'>
            <span class='edit-product' onclick='handleOpen(${element.variantid})'>
                <i class='fa-solid fa-pen-to-square prdmng-icon-edit'></i>
            </span>
            <span class='delete-product' onclick='deleteProduct(${element.variantid})'>
                <i class='fa-regular fa-trash-can prdmng-icon-trash'></i>
            </span>
            </td>`
    });
    body_product.innerHTML = html;
}
function showAllCheckbox() {
    const parent_checkbox = document.querySelector('.parent_checkbox')
    const child_checkbox = document.querySelectorAll('.child_checkbox')
    if (parent_checkbox.checked == true) {
        child_checkbox.forEach((item) => {
            item.checked = true
        })
    } else {
        child_checkbox.forEach((item) => {
            item.checked = false
        })
    }
}

function formatMoney(price) {
    let newPrice = "";
    const length = price.toString().length;
    // Duyệt từ dưới lên trên
    let count = 1;
    for (let i = length - 1; i >= 0; i--) {
        if (count === 3) {
            newPrice = "." + price.toString()[i] + newPrice;
            count = 1;
        } else {
            // Thêm số hiện tại vào newPrice
            newPrice = price.toString()[i] + newPrice;
            count++;
        }
    }
    // xóa dấu . ở đầu câu và cuối câu
    newPrice = newPrice.replace(/^\.+|\.+$/g, '');
    return newPrice;
}
function handleClose(isAdd) {
    if (isAdd) {
        document.querySelector(".add-product-overlay").classList.remove("active")
    } else {
        document.querySelector(".update-product-overlay").classList.remove("active")
    }
}
function handleOpen(id, isAdd) {
    if (isAdd) {
        document.querySelector(".add-product-overlay").classList.add("active")
        $.ajax({
            url: 'index.php?ctrl=product_manage&act=get_category',
            type: 'post',
            data: {},
            dataType: 'json',
            success: function (response) {
                var select = document.querySelector(".category-add");
                select.innerHTML = "";
                var category = response.categorys;
                category.forEach(function (brand) {
                    var option = document.createElement("option");
                    option.text = brand["name"];
                    option.value = brand["id"]
                    select.appendChild(option);
                });
            },
            error: function (xhr, status, error) {
                alert('Đã xảy ra lỗi khi load category.');
                console.error('Đã xảy ra lỗi:', error);
            }
        });
    } else {
        document.querySelector(".update-product-overlay").classList.add("active")
        document.querySelector(".update-product-overlay").setAttribute("variantID", id);
        detailProduct(id)
    }
}
function detailProduct(id) {
    $.ajax({
        url: 'index.php?ctrl=product_manage&act=show_update_phone',
        type: 'post',
        data: { id },
        dataType: 'json',
        success: function (response) {

            showDetailProduct(response.products, response.categorys);
        },
        error: function (xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục điện thoại.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}
function showDetailProduct(product, categorys) {
    const ramRom = product["size"].split(" ");
    const size = ramRom.join("/");

    document.querySelector(".title").value = product["phonename"];

    var select = document.querySelector(".category");
    select.innerHTML = "";
    categorys.forEach(function (brand) {
        var option = document.createElement("option");
        option.text = brand["name"];
        option.value = brand["id"]
        select.appendChild(option);
    });
    select.value = product["categoryid"]
    document.querySelector(".ramrom").value = size;
    document.querySelector(".color").value = product["color"];
    document.querySelector(".quantity").value = product["quantity"];
    document.querySelector(".price").value = product["price"];
    document.querySelector(".chip").value = product["chipset"];
    document.querySelector(".cpu").value = product["cpuType"];
    document.querySelector(".bodysize").value = product["bodySize"];
    document.querySelector(".bodyweight").value = product["bodyWeight"];
    document.querySelector(".screentech").value = product["screenTech"];
    document.querySelector(".screensize").value = product["screenSize"];
    document.querySelector(".screenresolution").value = product["screenResolution"];
    document.querySelector(".screenfeature").value = product["screenFeature"];
    document.querySelector(".cameraback").value = product["cameraBack"];
    document.querySelector(".camerafront").value = product["cameraFront"];
    document.querySelector(".camerafeature").value = product["cameraFeature"];
    document.querySelector(".videocapture").value = product["videoCapture"];
    document.querySelector(".battery").value = product["battery"];
    document.querySelector(".sim").value = product["sim"];
    document.querySelector(".networksupport").value = product["networkSupport"];
    document.querySelector(".wifi").value = product["wifi"];
    document.querySelector(".os").value = product["os"];
    document.querySelector(".misc").value = product["misc"];

    document.querySelector(".image_product").src = "public/img/phone_image/" + product["image"];
}
function updateImage() {
    var variantID = (document.querySelector(".update-product-overlay").getAttribute("variantID"));
    if (file != null) {
        var image = file.name;
    }
    console.log(image);
    $.ajax({
        url: 'index.php?ctrl=product_manage&act=update_imagephone',
        type: 'post',
        data: { variantID, image },
        dataType: 'json',
        success: function (response) {
            alert('Sửa thành công image.');
            // loadData();
            window.location.reload();
            handleClose();
        },
        error: function (xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục điện thoại.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}
// function updateColor() {
//     var variantID = (document.querySelector(".update-product-overlay").getAttribute("variantID"));
//     const color = document.querySelector(".color").value;
//     $.ajax({
//         url: 'index.php?ctrl=product_manage&act=update_color',
//         type: 'post',
//         data: { variantID, color },
//         dataType: 'json',
//         success: function (response) {
//             alert('Sửa thành công.');
//             loadData();
//             handleClose();
//         },
//         error: function (xhr, status, error) {
//             alert('Đã xảy ra lỗi khi khôi phục điện thoại.');
//             console.error('Đã xảy ra lỗi:', error);
//         }
//     });
// }
function updateNamePhone() {
    var variantID = (document.querySelector(".update-product-overlay").getAttribute("variantID"));
    const name = document.querySelector(".title").value;
    var category = document.querySelector(".category").value;
    $.ajax({
        url: 'index.php?ctrl=product_manage&act=update_namephone',
        type: 'post',
        data: { variantID, name, category },
        dataType: 'json',
        success: function (response) {
            console.log(response)
            alert('Sửa thành công phone.');
            // loadData();
            window.location.reload();
            handleClose();
        },
        error: function (xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục điện thoại.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}
function updateVariant() {
    var variantID = (document.querySelector(".update-product-overlay").getAttribute("variantID"));
    const price = document.querySelector(".price").value;
    const quantity = document.querySelector(".quantity").value;
    const size = document.querySelector(".ramrom").value;
    $.ajax({
        url: 'index.php?ctrl=product_manage&act=update_variant',
        type: 'post',
        data: { variantID, price, quantity, size },
        dataType: 'json',
        success: function (response) {
            console.log("variant")
            alert('Sửa thành công variant.');
            // loadData();
            window.location.reload();
            handleClose();
        },
        error: function (xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục điện thoại.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}
function updateSpec() {
    var variantID = (document.querySelector(".update-product-overlay").getAttribute("variantID"));
    const chipset = document.querySelector(".chip").value;
    const cpuType = document.querySelector(".cpu").value;
    const bodySize = document.querySelector(".bodysize").value;
    const bodyWeight = document.querySelector(".bodyweight").value;
    const screenFeature = document.querySelector(".screenfeature").value;
    const screenResolution = document.querySelector(".screenresolution").value;
    const screenSize = document.querySelector(".screensize").value;
    const screenTech = document.querySelector(".screentech").value;
    const os = document.querySelector(".os").value;
    const videoCapture = document.querySelector(".videocapture").value;
    const cameraFront = document.querySelector(".camerafront").value;
    const cameraBack = document.querySelector(".cameraback").value;
    const cameraFeature = document.querySelector(".camerafeature").value;
    const battery = document.querySelector(".battery").value;
    const sim = document.querySelector(".sim").value;
    const networkSupport = document.querySelector(".networksupport").value;
    const wifi = document.querySelector(".wifi").value;
    const misc = document.querySelector(".misc").value;
    $.ajax({
        url: 'index.php?ctrl=product_manage&act=update_spec',
        type: 'post',
        data: {
            variantID, chipset, cpuType, bodySize,
            bodyWeight, screenFeature, screenResolution, screenSize, screenTech,
            os, videoCapture, cameraFront, cameraBack, cameraFeature, battery, sim,
            networkSupport, wifi, misc
        },
        dataType: 'json',
        success: function (response) {
            alert('Sửa thành công spec.');
            // loadData();
            window.location.reload();
            handleClose();
        },
        error: function (xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục điện thoại.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}
function updateColor() {
    var variantID = (document.querySelector(".update-product-overlay").getAttribute("variantID"));
    const color = document.querySelector(".color").value;
    console.log(color);
    $.ajax({
        url: 'index.php?ctrl=product_manage&act=update_colorphone',
        type: 'post',
        data: { variantID, color },
        dataType: 'json',
        success: function (response) {
            if (response.check > 0) {
                alert('Màu đã tồn tại.');
            } else {
                console.log(response)
                alert('Sửa thành công color.');
                // loadData();
                window.location.reload();
                handleClose();
            }
        },
        error: function (xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục điện thoại.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}
function UpdatePhone() {
    var id = (document.querySelector(".update-product-overlay").getAttribute("variantID"));
    $.ajax({
        url: 'index.php?ctrl=product_manage&act=show_update_phone',
        type: 'post',
        data: { id },
        dataType: 'json',
        success: function (response) {
            const price = document.querySelector(".price").value;
            const quantity = document.querySelector(".quantity").value;
            const size = document.querySelector(".ramrom").value;
            const color = document.querySelector(".color").value;
            const name = document.querySelector(".title").value;
            const categoryid = document.querySelector(".category").value;
            var imagephone = document.querySelector(".image_product").src;
            var image = imagephone.substring(64)
            if (price <= 0) {
                alert("Giá bán phải lớn hơn 0");
                return;
            }
            if (file != null) {
                if (imagephone != file.name) {
                    updateImage();
                }
            }
            console.log(checkInputs(response.products).length)
            if (checkInputs(response.products).length != 0) {
                checkInputs(response.products).forEach(function (item) {
                    console.log(item)
                    if (item == 3) {
                        updateColor();
                    } if (item == 2 || item == 4 || item == 5) {
                        updateVariant()
                    } if (item == 0 || item == 1) {
                        updateNamePhone()
                    }
                    if (item >= 6) {
                        updateSpec()
                    }

                });
            }
        },
        error: function (xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục điện thoại.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}
var fileInput;
var file;
function OpenFileUpdate() {
    fileInput = document.getElementById('fileInput');
    fileInput.click();
}
function updateFile() {
    file = fileInput.files[0]; // Lấy tệp từ input
    document.querySelector(".image_product").src = "public/img/phone_image/" + file.name
}

function checkInputs(product) {

    var inputs = document.querySelectorAll('.iput');
    var hasEmptyInput = false;
    var hasChangedInput = false;
    // console.log(inputs[6].value)
    var valuesArray = Object.values(product);
    var indexUpdate = [];
    inputs.forEach(function (input, index) {
        // Kiểm tra nếu có ô input rỗng
        if (input.value.length == 0) {
            hasEmptyInput = true;
            return
        }
        // Kiểm tra xem giá trị hiện tại có thay đổi so với giá trị ban đầu không
        if (index == 2) {
            input.value = input.value.replace("/", " ");
        }
        if (input.value != valuesArray[index + 4]) {

            hasChangedInput = true;
            indexUpdate.push(index);
        }
    });
    // Nếu có ô input rỗng hoặc không có sự thay đổi giá trị so với giá trị ban đầu, trả về 0, ngược lại trả về 1
    return (!hasEmptyInput && hasChangedInput) ? indexUpdate : [];
}
function AddPhone() {
    var name = document.querySelector(".name-add").value;
    var color = document.querySelector(".color-add").value;
    var categoryid = document.querySelector(".category-add").value;
    var size = document.querySelector(".ramrom-add").value;
    if (name.trim() ==="" || color.trim() === "" || size.trim() === "") {
        toast({
            title: 'Thông báo!',
            message: 'Vui lòng điền đầy đủ thông tin!',
            type: 'warning',
            duration: 2000,
        });
        return;
    }
    console.log(categoryid);
    $.ajax({
        url: 'index.php?ctrl=product_manage&act=insert_phone',
        type: 'post',
        data: { name, color, categoryid, size },
        dataType: 'json',
        success: function (response) {
            if (response.mess) {
                toast({
                    title: 'Chúc mừng!',
                    message: response.mess,
                    type: 'success',
                    duration: 2000,
                });
            }
            if(response.duplicate)
            {
                toast({
                    title: 'Thông báo!',
                    message: response.duplicate,
                    type: 'warning',
                    duration: 2000,
                });
            }
        },
        error: function (xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục điện thoại.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}
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
}
