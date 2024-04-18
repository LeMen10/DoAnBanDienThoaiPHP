$(document).ready(() => {
    var currentURL = new URL(window.location.href);
    if (currentURL.searchParams.get("orderID") == null) {
        var select = currentURL.searchParams.get("sl");
        currentSelect = document.getElementById((select == null ? "status-All" : "status-" + select));
        currentSelect.classList.add('status-active');
    }

})
function handleChangeStatusList(selectName) {
    var currentURL = new URL(window.location.href);
    if (selectName == "All") {
        if (currentURL.searchParams.get("sl") != null) {
            currentURL.searchParams.delete("sl");
        }

    }
    else currentURL.searchParams.set("sl", selectName);
    window.location.href = currentURL.href;
}
function closeCancelForm() {
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
function cancelOrder(orderID) {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=purchase_order&act=cancelOrder',
        data: { orderID },
        dataType: 'json',
        success: res => {
            console.log(res)
            if(res.result)
            {
                console.log(1);
                location.reload();
            }
        },
        error: err => {
            console.log(err);
        }
    })
}

function CreateOrderStatus(orderStatus) {
    if (orderStatus == "Completed") return "The order has been delivered successfully.";
    else if (orderStatus == "Canceled") return "The order has been cancelled.";
    else if (orderStatus == "Delivering") return "Your order is being delivered to you.";
    else return "Your order is being processed and will be delivered to you soon.";
}
function handleChangeInfo(orderID) {
    console.log(orderID);
}
function handleOnClickItemOrderList(orderID) {
    window.location.href += '&orderID=' + orderID;
}
function showEmpty() {
    document.querySelector(".purchase-order-container").innerHTML = `<div class="empty-list">No orders</div>`;
}
