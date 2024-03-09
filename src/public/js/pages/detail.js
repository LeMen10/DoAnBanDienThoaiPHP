var phoneInfo = {phoneID: 0, sizeID: 0, colorID: 0, quantity: 0};
$(document).ready(() => {
    phoneInfo.phoneID = document.querySelector(`.product-desc`).getAttribute('data-id');
    phoneInfo.sizeID = document.getElementById("sizeSelect").value;
    phoneInfo.colorID = document.getElementById("colorSelect").value;
    document.getElementById("sizeSelect").addEventListener("change", handleSizeChange);
    document.getElementById("colorSelect").addEventListener("change", handleColorChange);
    document.getElementById("moreInfoBtn").addEventListener('click', handleMoreInformation);
    document.addEventListener("DOMContentLoaded", addSliderEvent);
    addSliderEvent();
})

function handleSizeChange() {
    phoneInfo.sizeID = document.getElementById("sizeSelect").value;
    loadAllColor(phoneInfo.phoneID, phoneInfo.sizeID);
}
function handleColorChange() {
    phoneInfo.sizeID = document.getElementById("sizeSelect").value;
    phoneInfo.colorID = document.getElementById("colorSelect").value;
    loadVariant(phoneInfo.phoneID, phoneInfo.sizeID, phoneInfo.colorID);

}
function handleMoreInformation() {
    var productDesc = document.querySelector('.product-desc');
    var moreInfoBtn = document.getElementById('moreInfoBtn');
    if (moreInfoBtn.textContent === 'Xem thêm') {
        productDesc.style.maxHeight = 'none';
        moreInfoBtn.textContent = 'Ẩn bớt';
    } else {
        productDesc.style.maxHeight = '10em';
        moreInfoBtn.textContent = 'Xem thêm';
    }
}
function handleIncreaseQuantity()
{
    var quantityInput = document.querySelector(".cart-plus-minus-box");
    if(quantityInput.value > phoneInfo.quantity) return;
    quantityInput.value += 1;
}


const loadAllColor = (phoneID, sizeID) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=detail&act=getAllColor',
        data: { phoneID, sizeID },
        dataType: 'json',
        success: res => {
            changeVariant(res.variant);
            changeColorSelect(res.colors);
        },
        error: err => {
            console.log(err);
        }
    })
}
const loadVariant = (phoneID, sizeID, colorID) => {
    return $.ajax({
        type: 'post',
        url: 'index.php?ctrl=detail&act=getVariant',
        data: { phoneID, sizeID, colorID },
        dataType: 'json',
        success: res => {
            changeVariant(res.variant);
        },
        error: err => {
            console.log(err);
        }
    })
}
const changeColorSelect = (Colors) => {
    var colorSelect = document.getElementById('colorSelect');
    if (colorSelect != null) {
        clearSelect(colorSelect);
        Colors.forEach(color => {
            var option = document.createElement('option');
            option.text = color["color"];
            option.value = color["colorID"];
            colorSelect.appendChild(option);
        });
    }
}

const changeVariant = (Variant) => {
    phoneInfo.quantity = Variant["quantity"];
    const priceElement = document.getElementById('price-value');
    const quantityElement = document.getElementById('quantity-value');
    if (priceElement != null) priceElement.innerHTML = "<span>đ</span>" + Variant["price"];
    if (quantityElement != null) quantityElement.innerHTML = "Quantity: " + Variant["quantity"];
}

function clearSelect(selectElement) {
    while (selectElement.options.length > 0) {
        selectElement.remove(0);
    }
}


function addSliderEvent()
{
    var currentSlide = 0;
    var slides = document.querySelectorAll('.lg-image');
    console.log(slides);
    var totalSlides = slides.length;

    // Hiển thị slide đầu tiên
    slides[currentSlide].classList.add('active');

    // Hàm chuyển đến slide tiếp theo
    function nextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % totalSlides;
        slides[currentSlide].classList.add('active');
    }

    // Hàm chuyển đến slide trước đó
    function prevSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        slides[currentSlide].classList.add('active');
    }

    // Thiết lập slider tự động
    var intervalId = setInterval(nextSlide, 10000);

    // Bắt sự kiện click cho nút Prev
    document.getElementById('prevBtn').addEventListener('click', function() {
        clearInterval(intervalId); // Dừng slider tự động khi người dùng nhấp vào nút
        prevSlide();
    });

    // Bắt sự kiện click cho nút Next
    document.getElementById('nextBtn').addEventListener('click', function() {
        clearInterval(intervalId);
        nextSlide();
    });
}