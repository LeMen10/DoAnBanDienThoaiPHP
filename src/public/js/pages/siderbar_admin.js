$(document).ready(() => {

    selectedSiderbar();
});
const selectedSiderbar = () => {
    const url = new URL(window.location.href);
    const ctrl = url.searchParams.get("ctrl");
    const navPageAdmin = document.getElementById('page-admin');
    const navPageProduct = document.getElementById('page-product');
    const navPageUser = document.getElementById('page-user');
    const navPageOrder = document.getElementById('page-order');
    const navPageReceipt = document.getElementById('page-receipt');
    const navPageRole = document.getElementById('page-role');
    ctrl == 'admin' ? navPageAdmin.classList.add('active') : navPageAdmin.classList.remove('active');
    ctrl == 'product_manage' ? navPageProduct.classList.add('active') : navPageProduct.classList.remove('active');
    ctrl == 'user_manage' ? navPageUser.classList.add('active') : navPageUser.classList.remove('active');
    ctrl == 'order_manage' ? navPageOrder.classList.add('active') : navPageOrder.classList.remove('active');
    ctrl == 'receipt' ? navPageReceipt.classList.add('active') : navPageReceipt.classList.remove('active');
    ctrl == 'role' ? navPageRole.classList.add('active') : navPageRole.classList.remove('active');
}