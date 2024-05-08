var searchInput;
var buttonSubmitSearchInput;
var allCheckBoxs;
var checkAll;
var btnRestoreAll;

$(document).ready(() => {
    btnRestoreAll = document.getElementById('btnRestoreAll');
    searchInput = document.getElementById('searchInput');
    buttonSubmitSearchInput = document.getElementById('btnSubmitSearchInput');
    allCheckBoxs = document.querySelectorAll("#checkboxToRestore");
    checkAll = document.querySelector("#checkAll");
    
    searchInput.addEventListener("keypress" , (e) => {
        // nhấn enter
        if(e.keyCode === 13) {
            buttonSubmitSearchInput.click()
        }
    })

    buttonSubmitSearchInput.addEventListener("click" , (e) => {
        const currentUrl = e.target.getAttribute("url");
        const inputValue = searchInput.value;
        const param = "query";

        changeParamInUrl(param, inputValue, currentUrl);
    });

    handleCheckAll();

    btnRestoreAll.addEventListener("click", (e) => {
        allCheckBoxs.forEach((c) => {
            if(c.checked == true) {
                const variantID = c.getAttribute("variantID");
                restoreProduct(variantID);
            }
        });
    });
})

function handleCheckAll() {
    // nếu check vào nút check all thì check hết các checkbox
    checkAll.addEventListener("click", (e) => {
        if(e.target.checked) {
            allCheckBoxs.forEach(checkbox => {
                if(!checkbox.checked) {
                    checkbox.checked = true;
                }
            });
        } else {
            allCheckBoxs.forEach(checkbox => {
                if(checkbox.checked) {
                    checkbox.checked = false;
                }
            });
        }
    })

    // nếu bỏ check thì kiểm tra để bỏ check nút check all
    allCheckBoxs.forEach(checkbox => {
        checkbox.addEventListener("click", (e) => {
            if(!e.target.checked) {
                checkAll.checked = false;
            } else {
                let allChecked = true;
                allCheckBoxs.forEach((checkbox) => {
                    if (!checkbox.checked) {
                        allChecked = false;
                    }
                });
                // Nếu tất cả các checkbox thường được chọn, chọn checkbox all
                if (allChecked) {
                    checkAll.checked = true;
                }
            }
        })
    });
}

var countRestore = 0;
function restoreProduct(variantID) {
    $.ajax({
        url: 'index.php?ctrl=trash_product&act=restore_product',
        type: 'POST',
        data: { variantID: variantID},
        success: function(response){
            if(response.status == 401) return navigationLogin();
            // để chỉ xuất ra alert 1 lần khi dùng check all sau đó restore
            if(countRestore == 0) {
                alert('Khôi phục điện thoại thành công!');
                countRestore++;
            }
            location.reload(); // Tải lại trang để cập nhật danh sách điện thoại
        },
        error: function(xhr, status, error) {
            alert('Đã xảy ra lỗi khi khôi phục điện thoại.');
            console.error('Đã xảy ra lỗi:', error);
        }
    });
}