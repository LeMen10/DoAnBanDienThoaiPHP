function update(id,select){
    
    var value = select.value;

    updateStatus(id,value);
}
function handle(id, event){

    if (event.target.classList.contains("testOn")){
       
        return;
    }
    if(id){
        if(document.querySelector(`.empty-${id}`).innerHTML != "")
        {
            document.querySelector(`.empty-${id}`).innerHTML = "";
        }
        else   LoadOrderDetail(id);
    }
}
const updateStatus = (id,value) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=order_manage&act=UpdateOrderStatus',
        data: { id,value},
        dataType: 'json',
        success: res => {
            console.log(res.isSuccess);
            if(res.isSuccess){
                var select = document.querySelector(`.mySelect-${id}`);
                var va = select.value;
                var sta = document.querySelector(`.status-${id}`);
                sta.textContent = va;
                console.log(sta.textContent);
                
                // if(sta.textContent === "Completed") {
                    
                //     select.disabled = true;
                // }
                if(select.value === "Completed") {
                    select.disabled = true;
                }
                else{
                    select.disabled = false;
                }
            }
            else{
                alert("chuyển thất bại");
            }
        },
        error: err => {
            console.log(err);
        }
    })
}
function LoadOrderDetail(id) {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=order_manage&act=GetDetailProduct',
        data: { id },
        dataType: 'json',
        success: res => {
            
            if(res.order_detail) {
                
                var a = "<div class='detail_product'>"+
                                        "<div class='profile'>"+
                                            "<label  class='title_profile'>THÔNG TIN KHÁCH HÀNG:</label>"+
                                            "<div class='sub_profile'>"+
                                                "<label class='sub_profile'>Họ tên: </label>"+
                                                "<p>"+ res.order_detail[0]["nameCustomer"]+"</p>"+
                                            "</div>"+
                                            "<div class='sub_profile'>"+
                                                "<label >Địa chỉ: </label>"+
                                                "<p>"+ res.order_detail[0]["address"]+"</p>"+
                                            "</div>"+
                                            "<div class='sub_profile'>"+
                                                "<label >SĐT: </label>"+
                                                "<p>"+ res.order_detail[0]["phoneNumber"]+"</p>"+
                                            "</div>"+
                                        "</div>"+
                                        "<div class='order_product'>"+
                                            "<h5 class='title_order_product'> SẢN PHẨM ĐÃ ĐẶT</h5>";
                                            
                res.order_detail.forEach(element => {
                    a +=     "<div class='detail'>"+
                                                "<img class='img_pro' src='public/img/phone_image/"+ element["image"]+ "' >"+
                                                "<div class='sub_detail'>"+
                                                    "<label >Sản phẩm</label>"+
                                                    "<p>"+ element["namePhone"]+"</p>"+
                                                "</div>"+
                                                "<div class='sub_detail'>"+
                                                    "<label >Tổng tiền</label>"+
                                                    "<p>"+ element["totalPayment"]+"</p>"+
                                                "</div>"+
                                                "<div class='sub_detail'>"+
                                                    "<label >Số lượng</label>"+
                                                    "<p>"+ element["quantity"]+"</p>"+
                                                "</div>"+
                                            "</div>"+
                                        "</div>";
                });
                a += "</div>";
                document.querySelector(`.empty-${id}`).innerHTML = a;
            }
           
            
        },
        error: err => {
            console.log(err);
        }
    })
}