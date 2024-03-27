var allALinkCategories;
var allInputCheckboxCategories;
var allInputCheckboxWeight;

$(document).ready(() => {
    allALinkCategories = document.querySelectorAll(".a-disabled");
    allInputCheckboxCategories = document.querySelectorAll(".checkbox-categories");
    allInputCheckboxWeight = document.querySelectorAll(".radio-weight");

    // bỏ trạng thái click của thẻ a
    for (let i = 0;i< allALinkCategories.length; i++) {
        allALinkCategories[i].addEventListener("click" , (e) => {
            e.preventDefault();
        })
    }

    filterByWeight();
    filterByBrand();
})

const filterByBrand = () => {
    // filter = categories
    for (let i = 0;i< allInputCheckboxCategories.length; i++) {
        allInputCheckboxCategories[i].addEventListener("change" , (e) => {
            const currentUrl = e.target.getAttribute("url");
            const selectedOption = e.target.getAttribute("name");
            
            // nếu check vào brand đó
            if(e.target.checked) {
                // nếu trên url đã có param brand thì thêm vô
                if(currentUrl.includes("&brand")) {
                    // cắt để lấy ra param filter đó theo dấu &
                    const arrCurUrl = currentUrl.split("&");
                    const newArrCurUrl = arrCurUrl.map((value) => {
                        // lấy cái param brand ra thêm
                        if(value.includes("brand=") && !value.includes(selectedOption)) {
                            // thêm các giá trị brand cần filter vô
                            const newValue = value + "+" + selectedOption;
                            return newValue;
                        }
                        return value;
                    }).join("&");

                    window.location.href = newArrCurUrl;
                } 
                else {
                    // nếu trên url ko có param brand thì thêm
                    window.location.href = currentUrl + "&brand=" + selectedOption;
                }

            } else {
                // nếu uncheck vào brand đó
                if(currentUrl.includes("&brand")) {
                    const arrCurUrl = currentUrl.split("&");
                    const newArrCurUrl = arrCurUrl.map((value) => {
                        // ktra và lấy param ra để xóa
                        if(value.includes("brand=") && value.includes(selectedOption)) {
                            const arrayValueAfterRemoveEqual = value.split("=")[1];

                            // nếu có nhiều value trong param đó thì tìm và xóa cái uncheck
                            if(value.includes("+")) {
                                const arrCurUrlAfterSpliting = arrayValueAfterRemoveEqual.split("+");
                                const removeValue = arrCurUrlAfterSpliting.map(v => v === selectedOption ? "" : v).join("+");
                                // vì khi xóa hoặc thêm value trong param sẽ dư ra 1 dấu + ở cuối.
                                // đổi 2 dấu ++ thành 1, xóa + ở cuối
                                // khi xóa value đầu tiên sẽ xuất hiện =+ ở đầu => xóa dấu +
                                const newValue = removeValue.replace(/\++/g, "+").replace(/\+$/, '').replace(/\=+/g, "=").replace(/^\+/g, "");

                                return "brand=" + newValue;
                            } else {
                                // nếu chỉ có 1 value trong param đó thì xóa luôn param brand
                                return "";
                            }
                            
                        }
                        return value;
                    }).join("&").replace(/\&&/g , "&").replace(/\&$/, '');
                        // vì khi xóa hoặc thêm param trong url sẽ dư ra 1 dấu & ở cuối.
                        // đổi 2 dấu && thành 1, xóa & ở cuối
                    window.location.href = newArrCurUrl;
                } 
            }
        })
    }
}

const filterByWeight = () => {
    // filter = weight
    for (let i = 0;i< allInputCheckboxWeight.length; i++) {
        allInputCheckboxWeight[i].addEventListener("change" , (e) => {
            const currentUrl = e.target.getAttribute("url");
            const selectedOption = e.target.getAttribute("name");
            if(e.target.checked) {
                const param = "weight";
                
                changeParamInUrl(param, selectedOption, currentUrl);
            }
        });
    };
}

// sắp xếp
const changeSortDropDown = (event) => {
    const selectedOption = event.target.value;
    const currentUrl = window.location.href;
    const param = "sort";

    changeParamInUrl(param, selectedOption, currentUrl);
};

//chuyển trang detail
function showDetail(phoneID)
{
    window.location.href = "index.php?ctrl=detail&phoneID="+ phoneID;
}
