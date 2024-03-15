// sắp xếp
const changeSortDropDown = (event) => {
    const selectedOption = event.target.value;
    const currentUrl = window.location.href;
    if(currentUrl.includes("&sort")) {
        const arrCurUrl = currentUrl.split("&");
        const newArrCurUrl = arrCurUrl.map((value) => {
            if(value.includes("sort=")) {
                const newValue = "sort=" + selectedOption;
                return newValue;
            }
            return value;
        }).join("&");

        window.location.href = newArrCurUrl;
    } 
    else {
        window.location.href = currentUrl + "&sort=" + selectedOption;
    }
};

//chuyển trang detail
function showDetail(phoneID)
{
    window.location.href = "index.php?ctrl=detail&phoneID="+ phoneID;
}