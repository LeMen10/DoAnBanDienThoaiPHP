$(document).ready(() => {
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
    onChangeCheckbox.forEach(element => {
        element.addEventListener('change', () => {
            updateTotalCart();
        });
    });

    const checkall = document.querySelector('.checkall');
    checkall.addEventListener('change', ()=>{
        onChangeCheckbox.forEach(element => {
            if (element.checked == true) element.checked = false;
            else if(element.checked == false) element.checked = true;
        });
        updateTotalCart();
    })
});

const removeItemCart = id => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=cart&act=remove_item',
        data: { id },
        success: res => {
            document.querySelector(`.wrap-product-item[data-id="${id}"]`).remove();
            updateTotalCart();
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
            console.log('Error Status:', err.status);
        },
    });
};

const increaseQuantity = (id, quantity) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=cart&act=update_quantity',
        data: { id, quantity },
        dataType: 'json',
        success: res => {
            if (res.message === 'Exceed the scope') return alert('Hết hàng');
            updateTotalItem(id, quantity);
        },
        error: err => {
            console.log('Error Status:', err.status);
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
            console.log(checkedNumber);
        }
    });
    console.log(checkboxCarts.length, checkedNumber);
    checkboxCarts.length === checkedNumber ? checkedArr.checked = true : checkedArr.checked = false;
    totalPrice.textContent = temp;
};
