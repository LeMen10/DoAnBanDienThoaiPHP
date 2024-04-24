let btnCheckout;
$(document).ready(() => {
    let dataID = [];
    const qtyButtonAdds = document.querySelectorAll('.qtybutton-add');
    qtyButtonAdds.forEach(element => {
        element.addEventListener('click', () => {
            const quantity = element.parentNode.querySelector('.cart-plus-minus-box').value;
            const id = element.getAttribute('data-id');
            increaseQuantity(id, Number(quantity) + 1);
        });
    });

    const qtyButtonSubs = document.querySelectorAll('.qtybutton-sub');
    qtyButtonSubs.forEach(element => {
        element.addEventListener('click', () => {
            const quantity = element.parentNode.querySelector('.cart-plus-minus-box').value;
            const id = element.getAttribute('data-id');
            decreaseQuantity(id, Number(quantity) - 1);
        });
    });

    const buttonDeletes = document.querySelectorAll('.button-delete');
    buttonDeletes.forEach(element => {
        element.addEventListener('click', () => {
            const id = element.getAttribute('data-id');
            removeItemCart(id);
        });
    });

    const onChangeCheckbox = document.querySelectorAll('.checkbox-cart');
    onChangeCheckbox.forEach((e, index) => {
        e.addEventListener('change', () => {
            if (e.checked == true) dataID.push(Number(e.value));
            else if (e.checked == false) {
                dataID.splice(index, 1);
                const cartID = localStorage.getItem('cartID');
                if (cartID != null && Number(e.value) === Number(cartID)) {
                    localStorage.removeItem('cartID');
                }
            }
            checkAll(dataID, onChangeCheckbox.length);
            updateTotalCart();
        });
    });

    const cartID = localStorage.getItem('cartID');
    if (cartID != null) {
        const input = document.querySelector(`.checkbox-cart[value="${cartID}"]`);
        input.checked = true;
        dataID.push(Number(input.value));
        checkAll(dataID, onChangeCheckbox.length);
        updateTotalCart();
    }

    const checkall = document.querySelector('.checkall');
    checkall.addEventListener('change', () => {
        if (checkall.checked == false) {
            onChangeCheckbox.forEach(element => {
                if (element.checked == true) element.checked = false;
            });
            dataID = [];
        } else {
            dataID = [];
            onChangeCheckbox.forEach(element => {
                if (element.checked == false) element.checked = true;
                dataID.push(Number(element.value));
            });
        }
        updateTotalCart();
    });

    btnCheckout = document.querySelector('.btn-checkout');
    btnCheckout.addEventListener('click', () => checkout(dataID));

    window.addEventListener('beforeunload', (event) => {
        localStorage.removeItem('cartID');
        dataID = [];
    })
});

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

const checkAll = (dataID, quantityItem) => {
    const checkall = document.querySelector('.checkall');
    dataID.length === quantityItem ? (checkall.checked = true) : (checkall.checked = false);
    const cartID = localStorage.getItem('cartID');
    if (cartID != null) localStorage.removeItem('cartID');
};

const checkout = dataID => {
    console.log(dataID)
    if (dataID.length > 0) window.location.href = 'index.php?ctrl=checkout&data_id=' + encodeURIComponent(dataID);
    else {
        toast({
            title: 'Thông báo!',
            message: 'Bạn chưa chọn sản phẩm 😐',
            type: 'warning',
            duration: 2000,
        });
    }
};

const removeItemCart = id => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=cart&act=remove_item',
        data: { id },
        success: res => {
            document.querySelector(`.wrap-product-item[data-id="${id}"]`).remove();
            updateTotalCart();
            getCountItemCart();
        },
        error: err => {
            console.log('Error Status:', err.status);
        },
    });
};

const decreaseQuantity = (id, quantity) => {
    if (quantity <= 0) quantity = 0;
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=cart&act=update_quantity',
        data: { quantity, id },
        success: res => {
            updateTotalItem(id, quantity);
        },
        error: err => {
            console.log('Error Status:', err);
        },
    });
};

const increaseQuantity = (id, quantity) => {
    console.log(id);
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=cart&act=update_quantity',
        data: { id, quantity },
        dataType: 'json',
        success: res => {
            if (res.message === 'Exceed the scope')
                toast({
                    title: 'Thông báo!',
                    message: 'Hàng trong kho đã hết 😐',
                    type: 'warning',
                    duration: 2000,
                });
            updateTotalItem(id, quantity);
        },
        error: err => {
            console.log('Error Status:', err);
        },
    });
};

const updateTotalItem = (id, newQuantity) => {
    const quantityInput = document.querySelector(`.ip-quantity[data-id="${id}"]`);
    const subtotalElement = document.querySelector(`.product-subtotal-value[data-id="${id}"]`);
    const productPrice = document.querySelector(`.currency-price[data-id="${id}"]`);

    quantityInput.value = newQuantity;
    subtotalElement.textContent = Number(newQuantity) * Number(productPrice.innerHTML);
    updateTotalCart();
};

const updateTotalCart = () => {
    // const totalTags = document.querySelectorAll('.product-subtotal-value');
    const checkedArr = document.querySelector('.checkall');
    const totalPrice = document.querySelector('.total-price');
    const checkboxCarts = document.querySelectorAll('.checkbox-cart');
    let temp = 0;
    let checkedNumber = 0;
    checkboxCarts.forEach(e => {
        let totalItem = Number(e.parentNode.parentNode.querySelector('.product-subtotal-value').innerHTML);
        if (e.checked) {
            temp += totalItem;
            checkedNumber += 1;
        }
    });
    checkboxCarts.length === checkedNumber ? (checkedArr.checked = true) : (checkedArr.checked = false);
    totalPrice.textContent = temp;
};

const getCountCart = () => {
    const tag = document.querySelector('.cart-item-count');
    return $.ajax({
        type: 'get',
        url: 'index.php?ctrl=cart&a',
        dataType: 'json',
        success: res => {
            console.log(res)
            tag.textContent = res.count || 0;
        },
        error: err => {
            console.log('Error Status:', err.status);
        },
    });
}