var elementSearch;
$(document).ready(() => {
    elementSearch = document.querySelector(".searchInput");
    elementSearch.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            handleEnterKeyPress();
        }
    });
})
const handleSearch = () => {
    var inputValue = searchInput.value.trim(); // Lấy giá trị nhập vào và loại bỏ các khoảng trắng ở đầu và cuối chuỗi
    if (inputValue === "") {
        suggestionBox.innerHTML = ""; // Nếu ô input trống, xóa danh sách đề xuất
        return;
    }

    // Gửi yêu cầu Ajax để lấy danh sách tên đề xuất từ máy chủ
    // Ví dụ:
    fetch("suggestion.php?key=" + inputValue)
        .then(response => response.json())
        .then(data => {
            // Hiển thị danh sách tên đề xuất
            suggestionBox.innerHTML = "";
            data.forEach(name => {
                suggestionBox.innerHTML += "<div>" + name + "</div>";
            });
        })
        .catch(error => {
            console.error("Error fetching suggestion:", error);
        });

}
const loadAllName = (stringSearch) => {
    return new Promise((resolve, reject) => {
        let phoneID = elementPhoneID.getAttribute('data-id');
        let sizeID = elementSizeID.value;
        let colorID = elementColorID.value;
        $.ajax({
            type: 'post',
            url: 'index.php?ctrl=detail&act=getVariant',
            data: { stringSearch },
            dataType: 'json',
            success: res => {
                resolve(res.variant["quantity"]);

            },
            error: err => {
                reject(err);
            }
        });
    });
};