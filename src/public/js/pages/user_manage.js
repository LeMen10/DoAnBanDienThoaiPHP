$(document).ready(() => {

})
function deleteUser(id) {
    $.ajax({
        url: 'index.php?ctrl=user_manage&act=delete_user',
        type: 'POST',
        data: { id },
        success: function (response) {
            // loadData();
            window.location.reload();
            alert('Xóa thành công');
        },
        error: function (xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục user.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}
function loadData() {
    $.ajax({
        url: 'index.php?ctrl=user_manage&act=load_data',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            showData(response.users);
        },
        error: function (xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục user.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}
function showData(users) {
    const body_user = document.querySelector('.body_user')
    let html = "";
    users.forEach(element => {
        html += `<tr class='user-item'>
        <th scope='row'>
            <input type='checkbox' name='' class='child_checkbox' dataid='${element.id}'>
        </th>
        <td>${element.id}</td>
        <td>${element.name}</td>
        <td>${element.email}</td>
        <td>${element.phoneNumber}</td>
        <td>${element.Author}</td>
        <td class='td-action'>
            <span class='edit-product' onclick='handleOpen(${element.id})'>
                <i class='fa-solid fa-pen-to-square prdmng-icon-edit'></i>
            </span>
            <span class='delete-product' onclick='deleteProduct(${element.id})'>
                <i class='fa-regular fa-trash-can prdmng-icon-trash'></i>
            </span>
            </td>`
    });
    body_user.innerHTML = html;
}
function handleClose(isAdd) {
    if (isAdd) {
        document.querySelector(".add-user-overlay").classList.remove("active")
    } else {
        document.querySelector(".update-user-overlay").classList.remove("active")
    }
}
function handleOpen(id, isAdd) {
    if (isAdd) {
        document.querySelector(".add-user-overlay").classList.add("active")
        $.ajax({
            url: 'index.php?ctrl=user_manage&act=get_author',
            type: 'POST',
            data: {},
            dataType: 'json',
            success: function (response) {
                var select = document.querySelector(".author-add");
                select.innerHTML = "";
                var author = response.author
                author.forEach(function (brand) {
                    var option = document.createElement("option");
                    option.text = brand["name"];
                    option.value = brand["ID"]
                    select.appendChild(option);
                });
            },
            error: function (xhr, status, error) {
                alert('Đã xảy ra lỗi khi khôi phục user.');
                console.error('Đã xảy ra lỗi:', error);
            }
        });
    } else {
        document.querySelector(".update-user-overlay").classList.add("active")
        document.querySelector(".update-user-overlay").setAttribute("ID", id);
        console.log(id)
        detailUser(id);
    }
}
function detailUser(id) {
    $.ajax({
        url: 'index.php?ctrl=user_manage&act=get_user',
        type: 'POST',
        data: { id },
        dataType: 'json',
        success: function (response) {
            showDetailProduct(response.users, response.author);
        },
        error: function (xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục user.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}
function showDetailProduct(user, author) {
    var select = document.querySelector(".author");
    select.innerHTML = "";
    author.forEach(function (brand) {
        var option = document.createElement("option");
        option.text = brand["name"];
        option.value = brand["ID"]
        select.appendChild(option);
    });
    select.value = user["AuthorID"];
    document.querySelector(".name").value = user["name"];
    document.querySelector(".email").value = user["email"];
    document.querySelector(".password").value = user["password"];
}
function UpdateUser() {
    var id = (document.querySelector(".update-user-overlay").getAttribute("ID"));
    const name = document.querySelector(".name").value;
    const email = document.querySelector(".email").value;
    const author = document.querySelector(".author").value;
    console.log(id, author)
    $.ajax({
        url: 'index.php?ctrl=user_manage&act=update_user',
        type: 'post',
        data: { id, name, email, author },
        dataType: 'json',
        success: function (response) {
            window.location.reload();
            handleClose(0);
            alert('Sửa thành công');
        },
        error: function (xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục user.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}
function AddUser() {
    const name = document.querySelector(".name-add").value;
    const email = document.querySelector(".email-add").value;
    const password = document.querySelector(".password-add").value;
    const author = document.querySelector(".author-add").value;
    console.log(name, email, password, author)
    $.ajax({
        url: 'index.php?ctrl=user_manage&act=add_user',
        type: 'post',
        data: { name, email, password, author },
        dataType: 'json',
        success: function (response) {
            loadData();
            handleClose(1);
            alert('Thêm thành công');
        },
        error: function (xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục user.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}
function showAllCheckboxUser() {
    const parent_checkbox = document.querySelector('.parent_checkbox_user')
    const child_checkbox = document.querySelectorAll('.child_checkbox_user')
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
function checkDeleteUser() {
    var id_arr = "";
    const child_checkbox = document.querySelectorAll('.child_checkbox_user')
    child_checkbox.forEach((item) => {
        if (item.checked == true) {
            id_arr += item.getAttribute('dataid') + ",";
        }
    })

    if (deleteUserByCheckbox(id_arr.slice(0, -1))) {
        // loadData();
        window.location.reload();
        alert('Xóa thành công');
    } else {
        alert('Chưa chọn đối tượng xóa');
    }
}
function deleteUserByCheckbox(id) {
    console.log(id)
    $.ajax({
        url: 'index.php?ctrl=user_manage&act=delete_user_by_checkbox',
        type: 'POST',
        data: { id },
        dataType: 'json',
        success: res => {
            console.log(res)
            return 1;
        },
        error: err => {
            console.log(err)
            return 0;
        }
    });
    return 1;
}
function searchUser() {
    const name = document.querySelector('.searchUser').value;
    var inputValue = name.trim();
    if (inputValue != "") {
        window.location.href = "index.php?ctrl=user_manage&search=" + inputValue;
    } else {
        window.location.href = "index.php?ctrl=user_manage"
    }
}
