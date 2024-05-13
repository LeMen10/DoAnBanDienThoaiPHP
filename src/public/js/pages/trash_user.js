$(document).ready(() => {
    const buttonRestores = document.querySelectorAll('.button-restore');
    buttonRestores.forEach(element => {
        element.addEventListener('click', () => {
            const id = element.getAttribute('data-id');
            restoreCustomer(id);
        });
    });

    const onChangeCheckbox = document.querySelectorAll('.checkItem');

    const checkall = document.querySelector('.checkall');
    let arrID = [];
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
    });

    onChangeCheckbox.forEach((element, index) => {
        element.addEventListener('change', () => {
            if (element.checked == true) arrID.push(element.value);
            else if (element.checked == false) arrID.splice(index, 1);
            checkAll(arrID, onChangeCheckbox.length);
        });
    });

    const btnMultipleRestore = document.querySelector('.btn-multiple-restore');
    btnMultipleRestore.addEventListener('click', () => {
        restoreMultipleCustomer(arrID);
    });
});

const checkAll = (arrID, quantityItem) => {
    const checkall = document.querySelector('.checkall');
    arrID.length === quantityItem ? (checkall.checked = true) : (checkall.checked = false);
};

const restoreCustomer = id => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=trash_user&act=restore_customer',
        data: { id },
        success: res => {
            console.log(res);
            document.querySelector(`.wrap-product-item[data-id="${id}"]`).remove();
        },
        error: err => {
            console.log('Error Status:', err.status);
        },
    });
};

const restoreMultipleCustomer = arrID => {
    console.log(arrID);
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=trash_user&act=restore_multiple_customer',
        data: { arrID },
        success: res => {
            console.log(res);
            document.querySelector(`.wrap-product-item[data-id="${id}"]`).remove();
        },
        error: err => {
            console.log('Error Status:', err.status);
        },
    });
};
