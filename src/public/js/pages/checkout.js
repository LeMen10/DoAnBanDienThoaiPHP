let modalShowAddress, recipientName, recipientPhone, provinceID, districtID, wardsID, detail, addressIdActive;
let selectDistrict,
    selectWards,
    selectProvince,
    heading,
    detailHeading,
    addressID,
    checkStateModal = false,
    checkBackModelAdd = false;

$(document).ready(() => {
    modalShowAddress = document.querySelector('.check-show-address');
    selectProvince = document.querySelector('#province');
    selectDistrict = document.querySelector('#district');
    detail = document.querySelector('input[name="detail"]');
    selectWards = document.querySelector('#wards');
    recipientName = document.querySelector('input[name="recipientName"]');
    recipientPhone = document.querySelector('input[name="recipientPhone"]');

    heading = document.querySelector('.heading-title');
    detailHeading = document.querySelector('.auth-form__switch-btn');

    const btnBackModalShowAddress = document.querySelector('.btn-back-modal-address');
    btnBackModalShowAddress.addEventListener('click', () => {
        modalShowAddress.style.display = 'none';
    });

    const btnBackModalAddOrEdit = document.querySelector('.btn-back-modal-add');
    btnBackModalAddOrEdit.addEventListener('click', () => {
        if (checkBackModelAdd) window.location.href = 'index.php?ctrl=cart';
        else {
            modalShowAddress.style.display = 'flex';
            document.querySelector('.check-show-modal').style.display = 'none';
            recipientName.value = '';
            recipientPhone.value = '';
            detail.value = '';
            provinceID = undefined;
            districtID = undefined;
            wardsID = undefined;
        }
    });

    getActiveAddress();

    const btnPayment = document.querySelector('.btn-payment');
    btnPayment.addEventListener('click', () => payment());
});

const getCheckoutData = dataID => {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: 'get',
            url: 'index.php?ctrl=checkout&act=get_checkout_data',
            data: { dataID },
            dataType: 'json',
            success: res => {
                if(res.status == 401) return navigationLogin();
                resolve(res.data);
            },
            error: err => {
                reject(err);
            },
        });
    });
};

const payment = async () => {
    const addressId = document.querySelector('.addressID').getAttribute('data-id');
    const totalPayment = document.querySelector('.total-price').textContent;
    const url = new URL(window.location.href);
    const dataID = url.searchParams.get('data_id');
    const orderStatus = 'Processing';

    try {
        const checkoutData = await getCheckoutData(dataID);
        return $.ajax({
            type: 'post',
            url: 'index.php?ctrl=checkout&act=save_order',
            data: { addressId, dataID: checkoutData, totalPayment, orderStatus },
            success: res => {
                if(res.status == 401) return navigationLogin();
                window.location.href = 'index.php?ctrl=purchase_order';
            },
            error: err => {
                console.log('Error Status:', err.status);
            },
        });
    } catch (error) {
        console.error('Error:', error);
    }
};

const showModalAddressEdit = data => {
    modalShowAddress.style.display = 'none';
    const tag = document.querySelector('.check-show-modal');
    tag.style.display = 'flex';
    heading.textContent = 'Cập nhật địa chỉ';
    detailHeading.textContent = '';
    selectDistrict.disabled = true;
    selectWards.disabled = true;

    recipientName.value = data[0].recipientName;
    recipientPhone.value = data[0].recipientPhone;
    detail.value = data[0].detail;
    provinceID = data[0].provinceID;
    districtID = data[0].districtID;
    wardsID = data[0].wardsID;
};

const getAddressEdit = id => {
    checkStateModal = true;
    return $.ajax({
        type: 'get',
        url: 'index.php?ctrl=checkout&act=get_address_editing',
        data: { id },
        dataType: 'json',
        success: res => {
            if(res.status == 401) return navigationLogin();
            showModalAddressEdit(res.address);
            addressID = res.address[0].id;
            getProvince()
                .done(response => {
                    if(response.status == 401) return navigationLogin();
                    showProvince(response.province, res.address[0].provinceID);
                })
                .fail(err => {
                    console.log('Error Status:', err.status);
                });

            getDistrict(res.address[0].provinceID)
                .done(response => {
                    if(response.status == 401) return navigationLogin();
                    showDistrict(response.district, res.address[0].districtID);
                })
                .fail(err => {
                    console.log('Error Status:', err.status);
                });

            getWards(res.address[0].districtID)
                .done(response => {
                    if(response.status == 401) return navigationLogin();
                    showWards(response.wards, res.address[0].wardsID);
                })
                .fail(err => {
                    console.log('Error Status:', err.status);
                });
        },
        error: err => {
            console.log('Error Status:', err.status);
        },
    });
};

const showModalCreateAddress = () => {
    checkStateModal = false;
    modalShowAddress.style.display = 'none';
    const tag = document.querySelector('.check-show-modal');
    tag.style.display = 'flex';
    heading.textContent = 'Địa chỉ mới';
    detailHeading.textContent = 'Để đặt hàng, vui lòng thêm địa chỉ nhận hàng.';
    recipientName.value = '';
    recipientPhone.value = '';
    detail.value = '';
    provinceID = undefined;
    districtID = undefined;
    wardsID = undefined;

    getProvince()
        .done(res => {
            if(res.status == 401) return navigationLogin();
            showProvince(res.province, 0);
        })
        .fail(err => {
            console.log('Error Status:', err.status);
        });
    showDistrict([], 0);
    showWards([], 0);
};

const checkInputAddress = () => {
    let name = recipientName.value;
    let phone = recipientPhone.value;
    if (
        provinceID == undefined ||
        districtID == undefined ||
        wardsID == undefined ||
        name == '' ||
        phone == '' ||
        detail.value == ''
    ) {
        toast({
            title: 'Thông báo!',
            message: 'Vui lòng nhập đủ thông tin 😐',
            type: 'warning',
            duration: 2000,
        });
    } else {
        if (checkStateModal === false) saveAddress(provinceID, districtID, wardsID, name, phone, detail.value);
        else updateAddress(provinceID, districtID, wardsID, name, phone, detail.value, addressID);
    }
};

const updateAddress = (provinceID, districtID, wardsID, name, phone, detail, addressID) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=checkout&act=update_address',
        data: { provinceID, districtID, wardsID, name, phone, detail, addressID },
        success: res => {
            if(res.status == 401) return navigationLogin();
            document.querySelector('.check-show-modal').style.display = 'none';
            changeAddress();
        },
        error: err => {
            console.log('Error Status:', err.status);
        },
    });
};

const saveAddress = (provinceID, districtID, wardsID, name, phone, detail) => {
    let active = 0;
    if(checkBackModelAdd == true) active = 1;
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=checkout&act=save_address',
        data: { provinceID, districtID, wardsID, name, phone, detail, active },
        success: res => {
            if(res.status == 401) return navigationLogin();
            document.querySelector('.check-show-modal').style.display = 'none';
            if (checkBackModelAdd) getActiveAddress();
            else changeAddress();
        },
        error: err => {
            console.log('Error Status:', err.status);
        },
    });
};

const getProvince = () => {
    return $.ajax({
        type: 'get',
        url: 'index.php?ctrl=checkout&act=get_province',
        dataType: 'json',
    });
};

const showProvince = (province = [], index) => {
    const selectProvince = document.querySelector('#province');
    let html = '<option value="0">Chọn Tỉnh/TP</option>';
    province.forEach(item => {
        html += `<option value='${item.id}'>${item.name}</option>`;
    });
    selectProvince.innerHTML = html;
    selectProvince.value = index;
};

const getDistrict = id => {
    return $.ajax({
        type: 'get',
        url: 'index.php?ctrl=checkout&act=get_district',
        data: { id },
        dataType: 'json',
    });
};

const showDistrict = (district = [], index = 0) => {
    const selectProvince = document.querySelector('#district');
    let html = '<option value = "0">Chọn Quận/Huyện</option>';
    district.forEach(item => {
        html += `<option value='${item.id}'>${item.name}</option>`;
    });
    selectProvince.innerHTML = html;
    selectProvince.value = index;
};

const getWards = id => {
    return $.ajax({
        type: 'get',
        url: 'index.php?ctrl=checkout&act=get_wards',
        data: { id },
        dataType: 'json',
    });
};

const showWards = (wards, index = 0) => {
    const selectWards = document.querySelector('#wards');
    let html = '<option value = "0">Chọn Xã/Phường</option>';
    wards.forEach(item => {
        html += `<option value='${item.id}'>${item.name}</option>`;
    });
    selectWards.innerHTML = html;
    selectWards.value = index;
};

const changeAddress = () => {
    return $.ajax({
        type: 'get',
        url: 'index.php?ctrl=checkout&act=get_address',
        dataType: 'json',
        success: res => {
            if(res.status == 401) return navigationLogin();
            showAddresses(res.address);
        },
        error: err => {
            console.log('Error Status:', err.status);
        },
    });
};

const onChangeProvince = obj => {
    provinceID = Number(obj.value);
    districtID = undefined;
    wardsID = undefined;
    if (Number(obj.value) > 0) selectDistrict.disabled = false;
    else {
        selectDistrict.disabled = true;
        selectWards.disabled = true;
        // getWards(Number(obj.value));
    }
    const listdistrict = getDistrict(Number(obj.value));
    listdistrict
        .done(res => {
            if(res.status == 401) return navigationLogin();
            var district = res.district;
            showDistrict(district);
        })
        .fail(err => {
            console.log('Error Status:', err.status);
        });
};

const onChangeDistrict = obj => {
    console.log(obj.value);
    districtID = Number(obj.value);
    if (Number(obj.value) > 0) selectWards.disabled = false;
    else selectWards.disabled = true;
    const listwards = getWards(Number(obj.value));
    listwards
        .done(res => {
            if(res.status == 401) return navigationLogin();
            var wards = res.wards;
            showWards(wards);
        })
        .fail(err => {
            console.log('Error Status:', err.status);
        });
};

const onChangeWards = obj => {
    wardsID = Number(obj.value);
};

const changeAddressID = id => {
    addressIdActive = id;
};

const saveShippingAddress = () => {
    return $.ajax({
        type: 'get',
        url: 'index.php?ctrl=checkout&act=change_active_address',
        data: { addressIdActive },
        dataType: 'json',
        success: res => {
            if(res.status == 401) return navigationLogin();
            modalShowAddress.style.display = 'none';
            getActiveAddress();
        },
        error: err => {
            console.log('Error Status:', err.status);
        },
    });
};

const getActiveAddress = () => {
    const addressCheckout = document.querySelector('.address-checkout');
    let html = '';
    return $.ajax({
        type: 'get',
        url: 'index.php?ctrl=checkout&act=get_active_address',
        dataType: 'json',
        success: res => {
            if(res.status == 401) return navigationLogin();
            if (res.address[0] == undefined) {
                showModalCreateAddress();
                checkBackModelAdd = true;
            } else {
                checkBackModelAdd = false;
                const data = res.address[0];
                html += `<div class='addressID' data-id=${data.id}>
                        <span>${data.recipientName}</span>
                        <span>${data.recipientPhone}</span>, 
                        <span>${data.detail}</span>, 
                        <span>${data.wards}</span>, 
                        <span>${data.district}</span>, 
                        <span>${data.province}</span>.
                    </div>`;
                addressCheckout.innerHTML = html;
            }
        },
        error: err => {
            console.log('Error Status:', err.status);
        },
    });
};

const showAddresses = address => {
    const addressesWr = document.querySelector('.address-list-wrap');
    modalShowAddress.style.display = 'flex';
    let html = '';
    address.forEach(item => {
        html += `<div class='address-item-wrap'> 
                        <div class='input-check-address'>
                            <input onchange="changeAddressID(${item.id})" type="radio" 
                            name="address-radio" value=${item.id} ${Number(item.active) == 1 ? 'checked' : ''} />
                        </div>
                        <div class='address-item'>
                            <div class='address-item-header'>
                                <p>
                                    <span>${item.recipientName}</span>
                                    <span>${item.recipientPhone}</span>
                                </p>
                                <p class='btn-update-address' onclick="getAddressEdit(${item.id})">Cập nhật</p>
                            </div>
                            <div >

                                <p>
                                    ${item.detail}, ${item.wards},
                                </p>
                                <p>
                                    ${item.district}, ${item.province}
                                </p>
                            </div>
                            
                        </div>
                    </div>`;
    });
    addressesWr.innerHTML = html;
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
